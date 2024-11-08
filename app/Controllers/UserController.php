<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsuarioModel;

class UserController extends BaseController
{
    private $UsuarioModel;

    public function __construct()
    {
        $this->UsuarioModel = new UsuarioModel();

    }

    public function login()
    {
        $data = [];

        if ($this->request->getMethod() == 'post') {

            $rules = [
                'identificador' => 'required|min_length[1]|max_length[20]',
                'password' => 'required|min_length[8]|max_length[255]|validateUser[identificador,password]',
            ];

            $errors = [
                'password' => [
                    'validateUser' => "Nombre de usuario o contraseña incorrecta",
                ],
            ];

            if (!$this->validate($rules, $errors)) {
                return view('login', [
                    "validation" => $this->validator,
                ]);

            } else {
                $model = new UsuarioModel();
                $user = $model->where('identificador', $this->request->getVar('identificador'))->first();

                // Verificar si el usuario ha confirmado su correo electrónico
                if ($user['is_verified'] == 0) {
                    // Redirigir al login con un mensaje de advertencia si no está verificado
                    return redirect()->to(('login'))->with('error', 'No has verificado tu correo');
                }

                $this->setUserSession($user);

                // Redirigir al panel correspondiente según el perfil
                if (($user['perfil'] == 1) && ($user['status'] == 1)) {
                    return redirect()->to(base_url('admin'));
                }

                if (($user['perfil'] == 2) && ($user['status'] == 1)) {
                    return redirect()->to(base_url('asesor'));
                }

                if (($user['perfil'] == 3) && ($user['status'] == 1)) {
                    return redirect()->to(base_url('estudiante'));
                }
            }
        }
        return view('login');
    }

    private function setUserSession($user)
    {
        $data = [
            'id' => $user['id'],
            'identificador' => $user['identificador'],
            'nombre' => $user['nombre'],
            'apaterno' => $user['apaterno'],
            'amaterno' => $user['amaterno'],
            'email' => $user['email'],
            'isLoggedIn' => true,
            'perfil' => $user['perfil'],
        ];

        session()->set($data);
        return true;
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('login');
    }
    /*public function verifyAccount($token = null)
    {
        $data = [];

        return redirect()->to((base_url('verify')));
        /*if (is_null($token)) {
            $token = $this->request->getPost('token'); 
        }

        $identificador = $this->request->getPost('identificador'); // Obtener el identificador del formulario
        if (empty($token) || empty($identificador)) {
            return redirect()->to('login')->with('error', 'Token o identificador no válidos.');
        }

        $usuarioModel = new UsuarioModel();
        $usuario = $usuarioModel->where('identificador', $identificador)->first();

        // Verificar que el usuario existe y que el token coincide
        if ($usuario && $usuario['verification_token'] === $token) {
            // Actualizar la columna `is_verified` a true
            $usuarioModel->update($usuario['id'], ['is_verified' => true]);
            return redirect()->to('login')->with('success', 'Cuenta verificada exitosamente. Ya puedes iniciar sesión.');
        }

        // Mensaje de error si el token o identificador no son válidos
        return redirect()->to('login')->with('error', 'Token o identificador incorrectos.');
    }*/

    public function verify($token = null)
    {
        if (is_null($token)) {
            return redirect()->to('login')->with('error', 'Identificador o token no válidos.');
        }

        return view('verify', ['token' => $token]);
    }
    public function is_verified()
    {
        $model = new UsuarioModel();
        $token = $this->request->getPost('token');
        $usuarioToken = $model->where('verification_token', $token)->first();
        if ($usuarioToken) {
            $model->update($usuarioToken['id'], [
                'token' => null,
                'is_verified' => true
            ]);
            return redirect()->to('/login')->with('message', 'Cuenta verificada con exito.');
        }
    }


}