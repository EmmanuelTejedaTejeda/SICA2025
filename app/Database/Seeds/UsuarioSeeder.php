<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use App\Models\UsuarioModel;

class UsuarioSeeder extends Seeder
{
    public function run()
    {
        $usuarios = new UsuarioModel();

        $usuarios->insertBatch([
            [
                'perfil'            => 1,
                'identificador'     => '84216',
                'nombre'            => 'Edgar',
                'apaterno'          => 'Degante',
                'amaterno'          => 'Aguilar',
                'email'             => 'edgar.degante.a@gmail.com',
                'password'          => password_hash('12345678', PASSWORD_DEFAULT),
                'sexo'              => 'm',
                'fecha_nacimiento'   => '1988/06/18',
                'created_at'        => '2023-12-27 12:00:00'
            ]            
        ]);
    }
}
