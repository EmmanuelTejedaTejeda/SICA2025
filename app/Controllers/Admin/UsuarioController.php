<?php

namespace App\Controllers\Admin;

use CodeIgniter\RESTful\ResourceController;
use App\Models\UsuarioModel;
use App\Models\PerfilModel;

class UsuarioController extends ResourceController
{
    private $usuario;
    private $perfil;

    public function __construct()
    {
        helper(['form', 'url', 'session']);
        $this->session = \Config\Services::session();
        $this->usuario = new UsuarioModel();
        $this->perfil = new PerfilModel();
    }


    public function index()
    {
        $usuarios = $this->usuario->findAll();


        $data = [
            'usuarios' => $usuarios,
            'perfiles'  => $this->perfil->findAll()
        ];

        return view('admin/usuarios/index', $data);
    }


    public function show($id = null)
    {
        //
    }



    public function create()
    {

        $oldData = $this->request->getPost();

        if ($this->request->getMethod() === 'post') {
            $validationRules = [
                'identificador' => 'required|is_unique[usuarios.identificador]',
                'password'      => 'required|min_length[8]|max_length[30]'
            ];

            if ($this->validate($validationRules)) {
                $perfil = $this->request->getPost('perfil');
                $identificador = $this->request->getPost('identificador');
                $nombre = $this->request->getPost('nombre');
                $apaterno = $this->request->getPost('apaterno');
                $amaterno = $this->request->getPost('amaterno');
                $email = $this->request->getPost('email');
                $password = $this->request->getPost('password');
                $sexo = $this->request->getPost('sexo');
                $status = $this->request->getPost('status');
                $fecha_nacimiento = $this->request->getPost('fecha_nacimiento');


                $this->usuario->save([
                    'perfil' => $perfil,
                    'identificador' => $identificador,
                    'nombre' => $nombre,
                    'apaterno' => $apaterno,
                    'amaterno' => $amaterno,
                    'email' => $email,
                    'password' => password_hash($password, PASSWORD_DEFAULT),
                    'sexo' => $sexo,
                    'status'    => $status,
                    'fecha_nacimiento' => $fecha_nacimiento
                ]);

                return redirect()->to('/admin/usuarios')->with('success', 'Usuario registrada exitosamente.');
            } 
            
            /* 
            else {
                
                $data = [
                    'usuarios'  => $this->usuario->findAll(),
                    'perfiles'  => $this->perfil->findAll(),
                    'validation' => isset($this->validator) ? $this->validator : null,
                    'oldData' => isset($oldData) ? $oldData : null,
                    'stayInCreateModal' => true,
                ];
                return view('admin/usuarios/index', $data);
            }
            */
        }

        $data = [
            'usuarios'  => $this->usuario->findAll(),
            'perfiles'  => $this->perfil->findAll(),
            'validation' => isset($this->validator) ? $this->validator : null,
            'oldData' => isset($oldData) ? $oldData : null,
            'stayInCreateModal' => true,
        ];

        return view('admin/usuarios/index', $data);
        // return redirect()->to('admin/usuarios', $data);
    }



    /*
    public function create()
    {
        if ($this->request->getMethod() === 'post' && $this->validate([
                'identificador' => 'required|is_unique[usuarios.identificador]',
                'password'      => 'required|min_length[8]|max_length[30]'
            ])) {
            $this->usuario->save([
                'perfil' => $this->request->getVar('perfil'),
                'identificador' => $this->request->getVar('identificador'),
                'nombre' => $this->request->getVar('nombre'),
                'apaterno' => $this->request->getVar('apaterno'),
                'amaterno' => $this->request->getVar('amaterno'),
                'email' => $this->request->getVar('email'),
                'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
                'sexo' => $this->request->getVar('sexo'),
                'status'    => $this->request->getVar('status'),
                'fecha_nacimiento' => $this->request->getVar('fecha_nacimiento')
            ]);

            return redirect()->to('/admin/usuarios');
        }

        // return view('admin/usuarios/index');


        $data = [
            'usuarios'  => $this->usuario->findAll(),
            'perfiles'  => $this->perfil->findAll()
        ];

        return redirect()->to('/admin/usuarios', $data);
    }
    */


/*
    public function new()
    {
        $data = [
            'perfiles'  => $this->perfil->findAll()
        ];

        return view('admin/usuarios/index', $data);
    }
    */


/*
    public function create()
    {
        $usuario = new UsuarioModel();

        $data = [
            'perfil' => $this->request->getVar('perfil'),
            'identificador' => $this->request->getVar('identificador'),
            'nombre' => $this->request->getVar('nombre'),
            'apaterno' => $this->request->getVar('apaterno'),
            'amaterno' => $this->request->getVar('amaterno'),
            'email' => $this->request->getVar('email'),
            'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
            'sexo' => $this->request->getVar('sexo'),
            'status'    => $this->request->getVar('status'),
            'fecha_nacimiento' => $this->request->getVar('fecha_nacimiento')
        ];

        $rules = [
            'identificador' => 'required|is_unique[usuarios.identificador]',
            'password'      => 'required|min_length[8]|max_length[30]'
        ];

        if ($this->validate($rules)) {
            $usuario->insert($data);
            return redirect()->to(site_url('/admin/usuarios'));
            session()->setFlashdata("success", "Usuario registrado con éxito");
        } else {
            $data['usernameDuplicado'] = lang('El nombre de usuario ya se encuentra registrado.');
            $data['emailDuplicado'] = lang('El e-mail ya se encuentra registrado.');
            $data['usuarios'] = $this->usuario->findAll();
            $data['perfiles'] = $this->perfil->findAll();
            return view('admin/usuarios/index', $data);
        }

    }
    */





    public function edit($id = null)
    {
        $usuario = new UsuarioModel();
        $data['usuario'] = $usuario->find($id);

        return view('admin/usuarios/edit', $data);
    }


    public function update($id = null)
    {
        $usuario = new UsuarioModel();
        $data = [
            'rol' => $this->request->getVar('rol'),
            'nombre' => $this->request->getVar('nombre'),
            'apaterno' => $this->request->getVar('apaterno'),
            'amaterno' => $this->request->getVar('amaterno'),
            'username' => $this->request->getVar('username'),
            'email' => $this->request->getVar('email'),
            // 'password' => password_hash($this->request->getVar('password'), PASSWORD_BCRYPT),
            'sexo' => $this->request->getVar('sexo'),
            'fechaNacimiento' => $this->request->getVar('fechaNacimiento'),
            'status' => $this->request->getVar('status'),
            'estatusDD' => $this->request->getVar('estatusDD'),
            'condicion' => $this->request->getVar('condicion'),
            'numHoras' => $this->request->getVar('numHoras')
        ];

        $usuario->update($id, $data);

        return redirect()->to('/admin/usuarios');
    }


    public function delete($id = null)
    {
        $usuario = new UsuarioModel();
        $usuario->delete($id);

        return redirect()->to('/admin/usuarios');
    }


    public function usuariosDocentes()
    {
        $usuariosDocentes = $this->usuario->join('expedientes', 'usuarios.id = expedientes.docente', 'left')->where('rol', 'docente')->orderBy('nombre', 'asc')->findAll();

        $data = [
            'usuariosDocentes' => $usuariosDocentes
        ];

        return view('admin/docentes/index', $data);
    }


    public function showDocente($id)
    {
        $usuario = $this->usuario->join('expedientes', 'usuarios.id = expedientes.docente', 'left')->find($id);

        $data = [
            'usuario' => $usuario
        ];

        return view('admin/docentes/showDocente', $data);
    }


    public function editPassword($id)
    {
        $usuarioModel = new UsuarioModel();
        $data['usuario'] = $usuarioModel->find($id);

        if (!$data['usuario']) {
            return redirect()->to('/admin/usuarios')->with('error', 'Usuario no encontrado.');
        }

        return view('admin/usuarios/edit_password', $data);
    }


    public function updatePassword($id)
    {
        $usuarioModel = new UsuarioModel();
        $usuario = $usuarioModel->find($id);

        if (!$usuario) {
            return redirect()->to('/admin/usuarios')->with('error', 'Usuario no encontrado.');
        }

        $newPassword = $this->request->getPost('new_password');
        if (empty($newPassword)) {
            return redirect()->back()->with('error', 'La nueva contraseña no debe estar vacía.');
        }

        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        $usuarioModel->update($id, ['password' => $hashedPassword]);

        return redirect()->to('/admin/usuarios')->with('success', 'Contraseña actualizada exitosamente.');
    }


    public function crearCoordinador()
    {
        $carreras = $this->carreraModel->orderBy('nombre', 'asc')->findAll();
        $data = [
            'carreras' => $carreras
        ];
        return view('admin/usuarios/crearCoordinador', $data);
    }


    public function storeCoordinador()
    {
        $data = [
            'rol' => $this->request->getVar('rol'),
            'nombre' => $this->request->getVar('nombre'),
            'apaterno' => $this->request->getVar('apaterno'),
            'amaterno' => $this->request->getVar('amaterno'),
            'username' => $this->request->getVar('username'),
            'email' => $this->request->getVar('email'),
            'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
            'sexo' => $this->request->getVar('sexo'),
            'fechaNacimiento' => $this->request->getVar('fechaNacimiento'),
            'numHoras' => $this->request->getVar('numHoras'),
            'carrera' => $this->request->getVar('carrera')
        ];

        $rules = [
            'username' => 'required|is_unique[usuarios.username]'
        ];

        if ($this->validate($rules)) {
            $this->usuario->insert($data);
            return redirect()->to(site_url('/admin/usuarios'));
            session()->setFlashdata("success", "COORDINADOR registrado con éxito");
        } else {
            $data['usernameDuplicado'] = lang('El nombre de usuario ya se encuentra registrado.');
            $data['emailDuplicado'] = lang('El e-mail ya se encuentra registrado.');
            return view('admin/usuarios/crearCoordinador', $data);
        }

    }

}
