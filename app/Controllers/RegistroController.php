<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsuarioModel;

class RegistroController extends BaseController
{


    private $usuarioModel;
    private $email;


    public function __construct()
    {
        $this->usuarioModel = new UsuarioModel();
        $this->email = \Config\Services::email();
    }



    // FUNCIONES PARA EL REGISTRO DEL ESTUDIANTE

    // CARGAR FORMULARIO DE REGISTRO
    public function new()
    {
        return view('pages/registro');
    }


    // GUARDAR REGISTRO DE ESTUDIANTE
    public function create()
    {

        $data = [
            'perfil' => 3,
            'identificador' => $this->request->getVar('identificador'),
            'nombre' => $this->request->getVar('nombre'),
            'apaterno' => $this->request->getVar('apaterno'),
            'amaterno' => $this->request->getVar('amaterno'),
            'email' => $this->request->getVar('email'),
            'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
            'status' => 1,
            'verification_token' => bin2hex(random_bytes(16)),
            'is_verified' => false,
        ];

        $rules = [
            'identificador' => 'required|is_unique[usuarios.identificador]',
            'password' => 'required|min_length[8]|max_length[30]',
            'email' => 'required|valid_email|is_unique[usuarios.email]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->to('registro')->withInput()->with('errors', $this->validator->getErrors());
        }

        $allowedDomain = 'teziutlan.tecnm.mx';
        $emailDomain = explode('@', $data['email'])[1];

        if ($emailDomain !== $allowedDomain) {
            return redirect()->to('registro')->withInput()->with('error', 'El correo electrónico debe ser del dominio institucional teziutlan.tecnm.mx');
        }

        $this->usuarioModel->insert($data);
        $emailSent = $this->sendVerificationEmail($data['email'], $data['verification_token']);
        if ($emailSent) {
            return redirect()->to('/login')->with('success', 'Por favor revisa tu correo electrónico para verificar tu cuenta');
        } else {
            return redirect()->to('/login')->with('error', 'No se pudo enviar el correo de verificación. Intenta nuevamente.');
        }

    }

    private function sendVerificationEmail($email, $token)
    {
        $link = base_url("verify_token/$token");


        $this->email->setFrom('edgardegantea@yahoo.com', 'Sistema SICAC');
        $this->email->setTo($email);
        $this->email->setSubject('Verifica tu cuenta');
        $this->email->setMessage("Haz clic en el siguiente enlace para verificar tu cuenta: <a href='$link'>Verificar cuenta</a>");

        if ($this->email->send()) {
            return true; // Correo enviado con éxito
        } else {
            // Manejo de errores al enviar el correo
            log_message('error', 'No se pudo enviar el correo de verificación: ' . $this->email->printDebugger());
            return false; // Fallo en el envío del correo
        }
    }
    


}
