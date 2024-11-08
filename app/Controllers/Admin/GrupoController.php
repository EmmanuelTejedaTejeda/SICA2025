<?php

namespace App\Controllers\Admin;

use CodeIgniter\RESTful\ResourceController;
use App\Models\GrupoModel;
use App\Models\GrupocpeModel;
use App\Models\AsignaturaModel;
use App\Models\CarreraAsignatura;

class GrupoController extends ResourceController
{
    private $GrupoModel;
    private $grupocpe;
    private $asignaturaModel;
    private $carreraAsignaturaModel;

    public function __construct()
    {
        helper('form');
        $this->grupoModel = new GrupoModel();
        $this->grupocpe = new GrupocpeModel();
        $this->asignaturaModel = new AsignaturaModel();
        $this->carreraAsignaturaModel= new CarreraAsignatura();
    }
    
    public function consulta(){
        $conexion = \Config\Database::connect();
        return $conexion->query('
            SELECT gcpe.id,
            concat(pa.clave,"-", substring(c.clave, 1, 4),"-",g.grupo) as grupo
            from grupocpe as gcpe
            join grupos as g on gcpe.grupos = g.id 
            join periodo_academico as pa on pa.id = gcpe.periodoEscolar  
            join carreras as c on gcpe.carrera = c.id'
        )->getResultArray();
    }

    public function index()
    {

        $conexion = \Config\Database::connect();
        $grupos = $conexion->query(
            'SELECT gcpe.id,
            concat(pa.clave,"-", substring(c.clave, 1, 4),"-",g.grupo) as grupo
            from grupocpe as gcpe
            join grupos as g on gcpe.grupos = g.id 
            join periodo_academico as pa on pa.id = gcpe.periodoEscolar  
            join carreras as c on gcpe.carrera = c.id'
            )->getResultArray();
            

        $data = [
            'grupocpe' => $grupos
        ];
        if (session()->get('perfil') == 1) {
            return view('admin/grupos/index', $data);
        } else if (session()->get('perfil') == 2) {
            return view('asesor/grupos/index', $data);
        } elseif (session()->get('perfil') == 3) {
            return view('estudiante/grupos/index', $data);
        }
    }


    

    public function show($id = null)
    {
        //
    }


    

    public function new()
    {
        //
    }


    

    public function create()
    {
        //
    }


    

    public function edit($id = null)
    {
        //
    }


    

    public function update($id = null)
    {
        //
    }


    

    public function delete($id = null)
    {
        //
    }
    private function obtenerGrupoPorId($grupoId, $consulta) {
        foreach ($consulta as $item) {
            if ($item['id'] === $grupoId) {
                return $item['grupo'];
            }
        }
        return null; // Retorna null si no se encuentra
    }
    
    public function agregarAsignaturas($id = null){
        $grupo = $this->grupocpe->find($id);
        $asignaturas = $this->asignaturaModel->findAll();
        $consulta = $this->consulta();
    
        $nombreGrupo = null;
        foreach ($consulta as $item) {
            if ($item['id'] === $grupo['id']) {
                $nombreGrupo = $item['grupo'];
                break;
            }
        }
        return view('admin/grupos/agregarAsignaturas', compact('grupo', 'asignaturas', 'nombreGrupo'));
    }

    public function guardarAsignaturas(){
        $asignaturaId = $this->request->getVar('asignatura_id');
        $grupoId = $this->request->getVar('grupo_id');
        if ($asignaturaId && $grupoId) {
            foreach ($asignaturaId as $asignatura) {
                $data = [
                    'asignatura_id' =>$asignatura,
                    'grupocpe_id'=>$grupoId
                ];
                $this->carreraAsignaturaModel->insert($data);
            }
            return redirect()->to('/admin/grupos')->with('success', 'Asignaturas agregadas exitosamente');
        } else {
            return redirect()->to('/admin/grupos')->with('failed', 'Debe seleccionar al menos una asignatura');
        }
    }
    public function mostrarAsignaturas($id = null)
    {
        $grupo = $this->grupocpe->find($id);
        $consulta = $this->consulta();
    
        $nombre = null;
        foreach ($consulta as $item) {
            if ($item['id'] === $grupo['id']) {
                $nombre = $item['grupo'];
                break;
            }
        }

        if (!$grupo) {
            return redirect()->to('/admin/grupos')->with('failed', 'Asignaturas no encontradas.');
        }

        $asignatura = $this->carreraAsignaturaModel
            ->join('asignaturas', 'asignaturas.id = carrera_asignatura.asignatura_id')
            ->where('carrera_asignatura.grupocpe_id', $id)
            ->findAll();

        return view('admin/grupos/mostrarAsignaturas', compact('asignatura', 'nombre'));
    }
    
}
