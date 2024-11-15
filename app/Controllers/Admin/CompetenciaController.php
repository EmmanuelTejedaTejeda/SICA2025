<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AtributosModel;
use App\Models\AsignaturaModel;
use App\Models\CompetenciaAtributoModel;
use App\Models\CarreraAsignatura;
use App\Models\GrupoModel;
use App\Models\EvaluaionAtributo;
use App\Models\UsuarioModel;


class CompetenciaController extends BaseController
{
    private $atributoModel;
    private $asignaturaModel;
    private $competenciaAtributoModel;
    private $carreraAsignaturaModel;
    private $matriculacionModel;
    private $grupoModel;
    private $evaluacionAtributoModel;
    private $usuarioModel;


    public function __construct()
    {
        helper('form');
        $this->atributoModel = new AtributosModel();
        $this->asignaturaModel = new AsignaturaModel();
        $this->competenciaAtributoModel = new CompetenciaAtributoModel();
        //$this->matriculacionModel = new MatriculacionModel();
        $this->carreraAsignaturaModel = new CarreraAsignatura();
        $this->grupoModel = new GrupoModel();
        $this->evaluacionAtributoModel = new EvaluaionAtributo();
        $this->usuarioModel = new UsuarioModel();
    }

    public function consulta()
    {
        $conexion = \Config\Database::connect();
        return $conexion->query(
            'SELECT
        atri.id as atributoId,
        atri.nombre_atributo,
        com.tipo as tipo_competencia,
        com.clave as clave_competencia,
        com.nombre as nombre_competencia,
        atricom.competencia_id,
        atricom.atributo_id,
        asigatri.atributo_id,
        asigatri.asignatura_id,
        asig.clave as clave_asignatura,
        asig.nombre as nombre_asignatura,
        carasig.asignatura_id,
        carasig.grupocpe_id,
        gcpe.carrera,
        gcpe.periodoEscolar,
        gcpe.grupos,
        g.grupo  as nombre_grupo,
        c.clave as clave_carrera,
        p.clave as clave_periodo,
        m.grupo,
        m.estudiante,
        u.id as estudianteId,
        u.nombre as nombre_usuario,
        u.apaterno as apaterno_usuario,
        u.amaterno as amaterno_usuario,
        ev.atributo_id,
        ev.estudiante_id,
        ev.fase,
        ev.calificacion 
        from atributos as atri
        left join atributo_competencia as atricom on atricom.atributo_id = atri.id 
        left join competencia as com on atricom.competencia_id = com.id
        left join asignaturas_atributos as asigatri on asigatri.atributo_id = atri.id
        left join asignaturas as asig on asigatri.asignatura_id = asig.id
        left join carrera_asignatura as carasig on carasig.asignatura_id = asig.id
        left join grupocpe as gcpe on carasig.grupocpe_id = gcpe.id 
        left join grupos as g on gcpe.grupos = g.id
        left join carreras as c on gcpe.carrera = c.id
        left join periodo_academico as p on gcpe.periodoEscolar = p.id
        left join matriculacion as m on m.grupo = gcpe.id
        left join usuarios as u on m.estudiante  = u.id
        left join evaluacion_atributo as ev on ev.estudiante_id  = u.id
        group BY atri.id
        '
        )->getResultArray();
    }




    public function index()
    {
        $consulta = $this->consulta();

        $data = [
            'atricom' => $consulta
        ];

        if (session()->get('perfil') == 1) {
            return view('admin/competencias/index', $data);
        } else if (session()->get('perfil') == 2) {
            return view('asesor/competencias/index', $data);
        } elseif (session()->get('perfil') == 3) {
            return view('estudiante/dashboard', $data);
        }
    }

    public function new()
    {
        $asignaturas = $this->asignaturaModel->findAll();
        return view('admin/competencias/create', compact('asignaturas'));
    }

    public function create()
    {

        $inputs = [
            'nombre' => 'required'
        ];

        if (!$this->validate($inputs)) {
            $validationErrors = $this->validator->listErrors();
            return redirect()->back()->with('failed', 'Datos no válidos: ' . $validationErrors)->withInput();
        }



        $atributoData = [
            'nombre_atributo' => $this->request->getVar('nombre'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $this->atributoModel->insert($atributoData);
        return redirect()->to('/admin/competencias')->with('success', 'Atributo agregado correctamente');
    }


    public function edit($id = null)
    {
        $competencia = $this->atributoModel->find($id);
        if ($competencia) {
            return view('admin/competencias/edit', compact('competencia'));
        } else {
            session()->setFlashdata('failed', 'Atributo no encontrado.');
            return redirect()->to('/admin/competencias');
        }
    }


    public function update($id = null)
    {
        $inputs = $this->validate([
            'nombre' => 'required'
        ]);

        if (!$inputs) {
            return view('admin/competencias/edit', [
                'validation' => $this->validator,
                'competencia' => $this->atributoModel->find($id)
            ]);
        }

        $competenciaData = [
            'id' => $id,
            'nombre_atributo' => $this->request->getVar('nombre')
        ];

        $this->atributoModel->save($competenciaData);
        return redirect()->to(base_url('/admin/competencias'))->with('success', 'Datos actualizados con exito');
    }

    public function delete($id)
    {
        // Eliminar competencias y atributos relacionados
        $this->atributoModel->delete($id);
        return redirect()->to('admin/competencias')->with('eliminado', 'Atributo eliminado con exito');
    }

    public function guardarCalificacion()
    {
        $atributo_id = $this->request->getVar('atributo_id');
        $estudiante_ids = $this->request->getVar('estudiante_id');
        $fases = $this->request->getVar('fase');
        $calificaciones = $this->request->getVar('calificacion');
        $nombres = $this->request->getVar('nombre_estudiante');

        if (!$calificaciones) {
            return redirect()->back()->with('error', 'Datos no válidos: Faltan algunos campos.')->withInput();
        } else {
            $estudiantes_con_max_calificaciones = [];
            $estudiantes_con_fase_duplicada = [];

            foreach ($estudiante_ids as $index => $estudiante_id) {
                $fase = $fases[$index];
                $calificacion = $calificaciones[$index];
                $nombre = $nombres[$index];

                $numCalificaciones = $this->evaluacionAtributoModel
                    ->where('atributo_id', $atributo_id)
                    ->where('estudiante_id', $estudiante_id)
                    ->countAllResults();

                if ($numCalificaciones < 3) {
                    $calificacionExistente = $this->evaluacionAtributoModel
                        ->where('atributo_id', $atributo_id)
                        ->where('estudiante_id', $estudiante_id)
                        ->where('fase', $fase)
                        ->first();

                    if ($calificacionExistente) {
                        $estudiantes_con_fase_duplicada[] = $nombre;
                    } else {
                        $data = [
                            'atributo_id' => $atributo_id,
                            'estudiante_id' => $estudiante_id,
                            'fase' => $fase,
                            'calificacion' => $calificacion
                        ];
                        $this->evaluacionAtributoModel->insert($data);
                    }
                } else {
                    $estudiantes_con_max_calificaciones[] = $nombre;
                }
            }
            $mensaje_error = '';
            if (!empty($estudiantes_con_max_calificaciones)) {
                $nombres_con_max_calificaciones = implode(', ', $estudiantes_con_max_calificaciones);
                $mensaje_error .= 'Los siguientes estudiantes ya tienen 3 calificaciones: ' . $nombres_con_max_calificaciones . '. Por lo que no se agregaran las calificaciones.';
            }
            if (!empty($estudiantes_con_fase_duplicada)) {
                $nombres_con_fase_duplicada = implode(', ', $estudiantes_con_fase_duplicada);
                $mensaje_error .= 'Los siguientes estudiantes ya tienen calificación en la misma fase: ' . $nombres_con_fase_duplicada . '. Por lo que no se agregaran las calificaciones.';
            }

            if ($mensaje_error) {
                return redirect()->to(base_url('/admin/competencias/' . $atributo_id . '/mostrarCalificaciones'))
                    ->with('error', $mensaje_error);
            }

            return redirect()->to(base_url('/admin/competencias/' . $atributo_id . '/mostrarCalificaciones'))
                ->with('success', 'Datos agregados con éxito');
        }
    }


    public function mostrarCalificaciones($id = null)
    {
        $atributo = $this->atributoModel->find($id);
        if (!$atributo) {
            return redirect()->to('admin/competencias')->with('error', 'Atributo no encontrado, verifique la informacion');
        } else {
            $usuarios = $this->usuarios($id);
            foreach ($usuarios as &$usuario) {
                $usuario['calificaciones'] = $this->calificacionesPorUsuario($usuario['estudiante_id'], $id);
            }
            return view('admin/competencias/mostrarCalificaciones', compact('atributo', 'usuarios'));
        }
    }


    public function usuarios($id)
    {
        $conexion = \Config\Database::connect();
        $query =
            'SELECT
            u.id as estudiante_id,
            u.nombre as nombre_usuario, 
            u.apaterno as apaterno_usuario,
            u.amaterno as amaterno_usuario,
            m.grupo,
            gcpe.id as grupocpe_id,
            carasig.asignatura_id,
            atri.id as atributo_id
        FROM usuarios as u
        LEFT JOIN matriculacion as m ON m.estudiante = u.id 
        LEFT JOIN grupocpe as gcpe ON m.grupo = gcpe.id
        LEFT JOIN carrera_asignatura as carasig ON carasig.grupocpe_id = gcpe.id
        LEFT JOIN asignaturas as asig ON carasig.asignatura_id = asig.id 
        LEFT JOIN asignaturas_atributos as asigatri ON asigatri.asignatura_id = asig.id 
        LEFT JOIN atributos as atri ON asigatri.atributo_id = atri.id
        WHERE atri.id = ?
        GROUP BY u.id';
        return $conexion->query($query, [$id])->getResultArray();
    }
    public function calificacionesPorUsuario($usuarioId, $atributoId)
    {
        $conexion = \Config\Database::connect();
        $query =
            'SELECT
            ev.id as evaluacion_id,
            ev.fase,
            ev.calificacion
        FROM evaluacion_atributo as ev
        WHERE ev.estudiante_id = ? AND ev.atributo_id = ?';
        return $conexion->query($query, [$usuarioId, $atributoId])->getResultArray();
    }
    

}
