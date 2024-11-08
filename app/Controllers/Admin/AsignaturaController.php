<?php

namespace App\Controllers\Admin;

use App\Models\AsignaturaModel;
use App\Models\AtributosModel;
use App\Models\AsignaturaAtributosModel;
use CodeIgniter\RESTful\ResourceController;

class AsignaturaController extends ResourceController
{

    private $asignaturaModel;
    private $atributoModel;
    private $asignaturaAtributoModel;
    private $db;

    public function __construct()
    {
        helper(['url', 'form', 'session']);
        $this->db = \Config\Database::connect();
        $this->asignaturaModel = new AsignaturaModel();
        $this->atributoModel = new AtributosModel();
        $this->asignaturaAtributoModel = new AsignaturaAtributosModel();
        $this->session = \Config\Services::session();
    }





    public function index()
    {
        $asignaturas = $this->asignaturaModel->orderBy('id', 'desc')->findAll();

        $data = [
            'asignaturas' => $asignaturas
        ];
        if (session()->get('perfil') == 1) {
            return view('admin/asignaturas/index', $data);
        } else if (session()->get('perfil') == 2) {
            return view('asesor/asignaturas/index', $data);
        }
    }





    public function show($id = null)
    {
        $asignatura = $this->asignaturaModel->find($id);

        if ($asignatura) {
            return view('admin/asignaturas/show', compact('asignatura'));
        } else {
            return redirect()->to('admin/asignaturas');
        }
    }
    public function agregarAtributos($id = null)
    {
        $asignatura = $this->asignaturaModel->find($id);
        $atributo = $this->atributoModel->findAll();

        return view('admin/asignaturas/agregarAtributos', compact('asignatura', 'atributo'));
    }
    public function guardarAtributos()
    {
        $atributosSeleccionados = $this->request->getVar('atributos');  
        $asignaturaId = $this->request->getVar('asignatura_id');  

        if ($atributosSeleccionados && $asignaturaId) {
            foreach ($atributosSeleccionados as $atributoId) {
                $data = [
                    'asignatura_id' => $asignaturaId,
                    'atributo_id' => $atributoId
                ];

                $this->asignaturaAtributoModel->insert($data);
            }
            return redirect()->to('/admin/asignaturas')->with('success', 'Atributos asignados exitosamente.');
        } else {
            return redirect()->to('/admin/asignaturas')->with('failed', 'Debe seleccionar al menos un atributo.');
        }
    }
    public function mostrarAtributos($id = null)
    {
        // Obtener los detalles de la asignatura
        $asignatura = $this->asignaturaModel->find($id);

        // Verificar si la asignatura existe
        if (!$asignatura) {
            // Si la asignatura no existe, redirigir o mostrar un mensaje de error
            return redirect()->to('/admin/asignaturas')->with('failed', 'Asignatura no encontrada.');
        }

        // Obtener los atributos asociados a la asignatura usando un join entre asignaturas_atributos y atributos
        $atributosAsignados = $this->asignaturaAtributoModel
            ->join('atributos', 'atributos.id = asignaturas_atributos.atributo_id') // Hacer el join con la tabla atributos
            ->where('asignaturas_atributos.asignatura_id', $id) // Filtrar por asignatura_id
            ->findAll(); // Obtener todos los registros correspondientes

        // Pasar los datos a la vista
        return view('admin/asignaturas/mostrarAtributos', compact('asignatura', 'atributosAsignados'));
    }


    public function new()
    {
        // Recuperar la información de grupocpe y sus uniones
        $grupocpeQuery = $this->db->table('grupocpe')
            ->select('grupocpe.id as grupocpe_id, 
                  carreras.clave as nombre_carrera, 
                  periodo_academico.clave as nombre_periodo,
                  grupos.grupo as nombre_grupo')
            ->join('carreras', 'grupocpe.carrera = carreras.id')
            ->join('periodo_academico', 'grupocpe.periodoEscolar = periodo_academico.id')
            ->join('grupos', 'grupocpe.grupos = grupos.id')
            ->get()
            ->getResultArray();

        $data = [
            'grupocpe' => $grupocpeQuery
        ];

        return view('admin/asignaturas/create', $data);
    }





    public function create()
    {
        $data = [
            'clave' => $this->request->getVar('clave'),
            'nombre' => $this->request->getVar('nombre'),
            'creditos' => $this->request->getVar('creditos'),
            'horas_teoricas' => $this->request->getVar('horas_teoricas'),
            'horas_practicas' => $this->request->getVar('horas_practicas'),
            'tipo_asignatura' => $this->request->getVar('tipo_asignatura'),
            'descripcion' => $this->request->getVar('descripcion'),
            'temario_asignatura' => $this->request->getVar('temario_asignatura'),
            'activo' => 1
        ];
        $rules = [
            'clave' => 'required|is_unique[asignaturas.clave]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->to('/admin/asignaturas/new')->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->asignaturaModel->insert($data);

        return redirect()->to('/admin/asignaturas')->with('success', 'Asignatura registrada exitosamente.');
    }




    public function edit($id = null)
    {
        $asignatura = $this->asignaturaModel->find($id);
        if ($asignatura) {
            return view('admin/asignaturas/edit', compact('asignatura'));
        } else {
            session()->setFlashdata('failed', 'Asignatura no encontrada.');
            return redirect()->to('/admin/asignaturas');
        }
    }






    public function update($id = null)
    {
        $inputs = $this->validate([
            'clave' => 'required|min_length[1]|max_length[10]',
            'nombre' => 'required|min_length[2]|max_length[255]',
            'creditos' => 'required',
            'horasSemana' => 'required'
        ]);

        if (!$inputs) {
            return view('admin/asignaturas/create', [
                'validation' => $this->validator
            ]);
        }

        $this->asignatura->save([
            'id' => $id,
            'clave' => $this->request->getVar('clave'),
            'nombre' => $this->request->getVar('nombre'),
            'descripcion' => $this->request->getVar('descripcion'),
            'creditos' => $this->request->getVar('creditos'),
            'horasSemana' => $this->request->getVar('horasSemana'),
            'temario' => $this->request->getVar('temario'),
            'temarioArchivo' => $this->request->getVar('temarioArchivo')
        ]);
        session()->setFlashdata('success', 'Datos actualizados con éxito.');
        return redirect()->to(base_url('/admin/asignaturas'));
    }





    public function delete($id = null)
    {
        $this->asignaturaModel->delete($id);

        session()->setFlashdata('success', 'Registro borrado de la base de datos');

        return redirect()->to(base_url('/admin/asignaturas'));
    }



}
