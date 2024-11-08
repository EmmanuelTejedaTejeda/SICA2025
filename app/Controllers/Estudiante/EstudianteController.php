<?php

namespace App\Controllers\Estudiante;

use App\Controllers\BaseController;
use App\Models\CompetenciaModel;
use App\Models\MatriculacionModel;
use App\Models\CompetenciaAtributoModel;

class EstudianteController extends BaseController
{
    private $competenciasModel;
    private $matriculacionesModel;
    private $atributosModel;

    public function __construct()
    {
        $this->competenciasModel = new CompetenciaModel();
        $this->matriculacionesModel = new MatriculacionModel();
        $this->atributosModel = new CompetenciaAtributoModel();
    }

    public function index()
    {
        $conexion = \Config\Database::connect();

        $usuarioId = session()->get('id');

        $ConsultaCompetencia = $conexion->query(
            'SELECT
                m.id AS id_matriculacion,
                m.grupo AS grupo_matriculacion,
                m.estudiante AS estudiante_matriculacion,

                cpe1.id AS cpe_id,
                cpe1.carrera AS cpe_carrera,
                cpe1.periodoEscolar AS cpe_periodoEscolar,
                cpe1.grupos AS cpe_grupos,

                cpe2.carrera AS cpe_carrera1,
                cpe2.periodoEscolar AS cpe_periodoEscolar1,
                cpe2.grupos AS cpe_grupos1,

                g.grupo AS nombre_grupo,

                c.clave AS clave_grupo,

                pa.clave AS clave_periodoAcademico,

                asig2.clave AS clave_asignatura_fk,
                asig2.nombre AS nombre_asignatura_fk,

                carasig.asignatura_id AS asignaturaId,
                carasig.grupocpe_id AS grupoCPE_id,

                atributos.asignatura_id as asignaturaId,
                atributos.nombre_atributo as nombreAtributo,
                atributos.porcentaje_atributo as porcentajeAtributo,
                atributos.etapa_atributo  as etapaAtributo,

                atricom.competencia_id,
                atricom.atributo_id,

                com.tipo   as tipo_competencia,
                com.clave as clave_competencia,
                com.nombre as nombre_competencia
            FROM 
                matriculacion m
            INNER JOIN
                grupocpe cpe1 ON m.grupo = cpe1.id
            INNER JOIN
                grupos g ON cpe1.grupos = g.id
            INNER JOIN
                carreras c ON cpe1.carrera = c.id
            INNER JOIN 
                periodo_academico pa ON cpe1.periodoEscolar = pa.id
            INNER JOIN 
                carrera_asignatura carasig ON cpe1.id = carasig.grupocpe_id
            INNER JOIN 
                asignaturas asig2 ON carasig.asignatura_id = asig2.id
            INNER JOIN 
                grupocpe cpe2 ON carasig.grupocpe_id = cpe2.id
            LEFT JOIN
                atributos as atributos on atributos.asignatura_id = asig2.id
            LEFT JOIN
                atributo_competencia as atricom on atricom.atributo_id = atributos.id

            LEFT JOIN
                competencia as com on atricom.competencia_id = com.id
            WHERE 
                m.estudiante =  ?',
                        [$usuarioId]
                    )->getResultArray();
            $data['atributos'] = $ConsultaCompetencia;
            return view('estudiante/dashboard', $data);
    }
}