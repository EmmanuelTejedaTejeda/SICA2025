<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\CarreraModel;

class CarreraController extends BaseController
{

    protected $carreraModel;


    public function __construct()
    {
        $this->carreraModel = new CarreraModel();
    }


    public function index()
    {
        $carreras = $this->carreraModel->findAll();

        $data = [
            'carreras'  => $carreras
        ];

        return view('admin/carreras/index', $data);
    }


    public function new()
    {
        return view('admin/carreras/create');
    }


    public function store()
    {
        $data = [
            'clave' => $this->request->getPost('clave'),
            'nombre' => $this->request->getPost('nombre')
        ];

        $this->carreraModel->insert($data);

        return redirect()->to('admin/carreras');
    }



    public function edit($id)
    {
        $carrera = $this->carreraModel->find($id);

        $data = [
            'carrera' => $carrera
        ];

        return view('admin/carreras/edit', $data);
    }




    public function udpate($id)
    {
        $data = [
            'clave' => $this->request->getPost('clave'),
            'nombre' => $this->request->getPost('nombre')
        ];

        $this->carreraModel->update($id, $data);

        return redirect()->to('admin/carreras');
    }
}
