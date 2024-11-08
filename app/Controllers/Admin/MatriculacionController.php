<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\MatriculacionModel;


class MatriculacionController extends BaseController
{
    private $matriculacionModel;
    private $db;
    private $matriculado;


    public function __construct()
    {
        helper(['url', 'form', 'session']);
        $this->db = \Config\Database::connect();
        $this->matriculacionModel = new MatriculacionModel();
        $this->session = \Config\Services::session();

    }

    public function consultaDB()
    {
        $conexion = \Config\Database::connect();
        $consultaMatriculacion = $conexion->query(
            'SELECT 
                m.id as id,
                m.grupo,
                GROUP_CONCAT(CONCAT(u.nombre, " ", u.apaterno, " ", u.amaterno) SEPARATOR ", ") as nombre_completo,
                COUNT(u.id) as cantidadEstudiantes,
                concat(c.clave, "-", pa.clave, "-", g.grupo) as grups,
                gcpe.id as id_grupo
            FROM 
                matriculacion AS m
            LEFT JOIN 
                usuarios AS u ON m.estudiante = u.id
            LEFT JOIN 
                grupocpe AS gcpe ON m.grupo = gcpe.id
            LEFT JOIN 
                carreras AS c ON gcpe.carrera = c.id
            LEFT JOIN 
                periodo_academico AS pa ON gcpe.periodoEscolar = pa.id
            LEFT JOIN 
                grupos AS g ON gcpe.grupos = g.id
            GROUP BY
                gcpe.id'
        )->getResultArray();
        $consultaGCPE = $conexion->query(
            'SELECT 
                    gcpe.id as id_grupo,
                    gcpe.id as grupo, 
                    GROUP_CONCAT(CONCAT(u.nombre, " ", u.apaterno, " ", u.amaterno) SEPARATOR ", ") as nombre_completo,
                    COUNT(m.estudiante) as cantidadEstudiantes,
                    concat(c.clave, "-", pa.clave, "-", g.grupo) as grups
                FROM 
                    grupocpe AS gcpe
                LEFT JOIN 
                    matriculacion AS m ON m.grupo = gcpe.id
                LEFT JOIN 
                    usuarios AS u ON m.estudiante = u.id
                LEFT JOIN 
                    carreras AS c ON gcpe.carrera = c.id
                LEFT JOIN 
                    periodo_academico AS pa ON gcpe.periodoEscolar = pa.id
                LEFT JOIN 
                    grupos AS g ON gcpe.grupos = g.id
                GROUP BY
                    gcpe.id'
        )->getResultArray();
        $consultaUsuariosTotales = $conexion->query(
            'SELECT
                u.id as id_usuario,
                CONCAT( u.nombre, " ", u.apaterno, " " ,u.amaterno ) AS nombre_alumnos,
                IFNULL(CONCAT(c.clave, "-", pa.clave, "-", g.grupo), "No asignado") as nombre_grupo,
                gcpe.id as grupocpe_id,
                CONCAT(c.clave, "-", pa.clave, "-", g.grupo) as grupo
            FROM 
                usuarios AS u
            LEFT JOIN
                matriculacion m on u.id = m.estudiante
            LEFT JOIN
                grupocpe gcpe on m.grupo = gcpe.id
            LEFT JOIN
                grupos g on gcpe.grupos = g.id
            left join 
                carreras AS c ON gcpe.carrera = c.id
            left join 
                periodo_academico AS pa ON gcpe.periodoEscolar = pa.id
            where 
                perfil = 3'
        )->getResultArray();
        $resultados = [
            'matriculacion' => $consultaMatriculacion,
            'usuarios' => $consultaUsuariosTotales,
            'grupos' => $consultaGCPE
        ];
        return $resultados;
    }

    public function index()
    {
        $matriculaciones = $this->consultaDB();
        $data = [
            'matriculaciones' => $matriculaciones['matriculacion']
        ];
        return view('admin/matriculaciones/index', $data);
    }
    public function edit($id)
    {
        $grupoAlumnos = $this->consultaDB();
        $estudiantes = $grupoAlumnos['matriculacion'];
        $matriculado = null;
        foreach ($estudiantes as $grupo) {
            if ($grupo['id'] == $id) {
                $matriculado = $grupo;
                break;
            }
        }

        if ($matriculado === null) {
            return redirect()->back()->with('error', 'Matriculación no encontrada');
        }
        $data = [
            'matriculado' => $matriculado,
            'usuarios' => $grupoAlumnos['usuarios'],
        ];

        return view('admin/matriculaciones/edit', $data);
    }

    public function deleteGroup($id)
    {
        $matriculado = $this->matriculacionModel->find($id);

        if (!$matriculado) {
            return redirect()->back()->with('error', 'Grupo no encontrado');
        }

        $this->matriculacionModel->where('grupo', $matriculado['grupo'])->delete();

        return redirect()->to('admin/matriculaciones')->with('success', 'Matriculaciones del grupo eliminadas con éxito');
    }
    public function agregarEstudiantes()
    {
        $grupo = $this->request->getVar('grupo_id');
        $estudiantes = $this->request->getVar('estudiantes');
        if (empty($grupo)) {
            return redirect()->back()->with('error', 'El grupo es requerido. Por favor, seleccione un grupo.');
        }

        if (empty($estudiantes)) {
            return redirect()->back()->with('error', 'Debe seleccionar al menos un estudiante para agregar al grupo.');
        }
        foreach ($estudiantes as $estudiante) {
            $data = [
                'grupo' => $grupo,
                'estudiante' => $estudiante
            ];
            $this->matriculacionModel->insert($data);
        }
        return redirect()->back()->with('success', 'Matriculacion actualizada con exito');


        /*if ($this->request->isAJAX()) {
            $grupo = $this->request->getVar('grupo');
            $estudiantes = $this->request->getVar('estudiantes');

            if (!empty($grupo) && !empty($estudiantes)) {
                foreach ($estudiantes as $idEstudiante) {
                    // Insertar cada estudiante en la tabla de matriculaciones
                    $this->matriculacionModel->save([
                        'grupo' => $grupo,
                        'estudiante' => $idEstudiante
                    ]);
                }
                return $this->response->setJSON(['success' => true]);
            } else {
                return $this->response->setJSON(['success' => false, 'message' => 'Datos incompletos']);
            }
        }*/
    }


    public function deleteAlumno($id)
    {
        $this->matriculacionModel->delete($id);
        return redirect()->to('admin/matriculaciones')->with('succes', 'Matriculacion eliminada con exito');
    }


    public function update($id = null)
    {
        $inputs = $this->validate([
            'grupo' => 'required',
            'estudiante' => 'required',
        ]);

        $this->matriculacionModel->save([
            'id' => $id,
            'grupo' => $this->request->getVar('grupo'),
            'estudiante' => $this->request->getVar('estudiante')
        ]);
        session()->setFlashdata('success', 'Datos actualizados con éxito.');
        return redirect()->to(base_url('/admin/matriculaciones'));
    }

    public function new()
    {
        $consulta = $this->consultaDB();
        $alumnos = $consulta['usuarios'];
        $grupos = $consulta['grupos'];
        return view('admin/matriculaciones/createGrupo', compact('alumnos', 'grupos'));
    }
    public function create()
    {
        $grupo = $this->request->getPost('grupo');
        $estudiantes = $this->request->getPost('estudiantes');

        if (empty($grupo) || empty($estudiantes)) {
            return redirect()->back()->with('failed', 'Seleccione un grupo y al menos un estudiante.');
        }

        foreach ($estudiantes as $idEstudiante) {
            $this->matriculacionModel->insert([
                'grupo' => $grupo,
                'estudiante' => $idEstudiante,
                'created_at' => date('Y-m-d H:i:s'), // Fecha de creación
                'updated_at' => date('Y-m-d H:i:s')  // Fecha de actualización
            ]);
        }

        return redirect()->to('admin/matriculaciones')->with('success', 'Estudiantes matriculados con éxito en el grupo seleccionado.');
    }

}
