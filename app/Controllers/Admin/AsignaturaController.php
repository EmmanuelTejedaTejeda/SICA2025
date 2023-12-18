<?php

namespace App\Controllers\Admin;

use App\Models\AsignaturaModel;
use CodeIgniter\RESTful\ResourceController;

class AsignaturaController extends ResourceController
{

    private $estudiante;
    private $db;

    public function __construct()
    {
        helper(['url', 'form', 'session']);
        $this->db = \Config\Database::connect();
        $this->asignatura = new AsignaturaModel();
        $this->session = \Config\Services::session();
    }





    public function index()
    {
        $asignaturas = $this->asignatura->orderBy('id', 'desc')->findAll();

        $data = [
            'asignaturas'   => $asignaturas
        ];

        return view('admin/asignaturas/index', $data);
    }





    public function show($id = null)
    {
        $asignatura = $this->asignatura->find($id);

        if ($asignatura) {
            return view('admin/asignaturas/show', compact('asignatura'));
        } else {
            return redirect()->to('admin/asignaturas');
        }
    }






    public function new()
    {
        return view('admin/asignaturas/create');
    }






    public function create()
    {
        $inputs = $this->validate([
            'clave'         => 'required|min_length[1]|max_length[10]',
            'nombre'        => 'required|min_length[2]|max_length[255]',
            'creditos'      => 'required',
            'horasSemana'   => 'required'
        ]);

        if (!$inputs) {
            return view('admin/asignaturas/create', ['validation' => $this->validator]);
        }

        $this->asignatura->save([
            'clave'             => $this->request->getVar('clave'),
            'nombre'            => $this->request->getVar('nombre'),
            'descripcion'       => $this->request->getVar('descripcion'),
            'creditos'          => $this->request->getVar('creditos'),
            'horasSemana'       => $this->request->getVar('horasSemana'),
            'temario'           => $this->request->getVar('temario'),
            'temarioArchivo'    => $this->request->getVar('temarioArchivo')
        ]);

        return redirect()->to(site_url('/admin/asignaturas'));
        session()->setFlashdata("success", "Asignatura registrada con éxito");
    }





    public function edit($id = null)
    {
        $asignatura = $this->asignatura->find($id);
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
            'clave'         => 'required|min_length[1]|max_length[10]',
            'nombre'        => 'required|min_length[2]|max_length[255]',
            'creditos'      => 'required',
            'horasSemana'   => 'required'
        ]);

        if (!$inputs) {
            return view('admin/asignaturas/create', [
                'validation' => $this->validator
            ]);
        }

        $this->asignatura->save([
            'id'                => $id,
            'clave'             => $this->request->getVar('clave'),
            'nombre'            => $this->request->getVar('nombre'),
            'descripcion'       => $this->request->getVar('descripcion'),
            'creditos'          => $this->request->getVar('creditos'),
            'horasSemana'       => $this->request->getVar('horasSemana'),
            'temario'           => $this->request->getVar('temario'),
            'temarioArchivo'    => $this->request->getVar('temarioArchivo')
        ]);
        session()->setFlashdata('success', 'Datos actualizados con éxito.');
        return redirect()->to(base_url('/admin/asignaturas'));
    }





    public function delete($id = null)
    {
        $this->asignatura->delete($id);

        session()->setFlashdata('success', 'Registro borrado de la base de datos');

        return redirect()->to(base_url('/admin/asignaturas'));
    }



}
