<?= $this->extend('template/main'); ?>

<?= $this->section('content'); ?>

<div class="">
    <div class="row">
        <div class="col-xl-12">
            <?php
            if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success alert-dismissible" id="success-alert">
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    <?php echo session()->getFlashdata('success') ?>
                </div>
            <?php elseif (session()->getFlashdata('failed')): ?>
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="btn-close" data-bs-dismiss="alert">&times;</button>
                    <?php echo session()->getFlashdata('failed') ?>
                </div>
            <?php endif; ?>
            <?php if (session()->get('eliminado')): ?>
                <div class="alert alert-success">
                    <?= session()->get('eliminado'); ?>
                </div>
            <?php endif; ?>


            <div class="card">
                <div class="card-header ">
                    <div class="row">
                        <div class="col">
                            <h5 class="card-title text-uppercase">Atributos por competencia</h5>

                        </div>
                        <div class="col d-grid gap-2 d-md-flex justify-content-md-end">

                            <a href="<?= base_url('admin/') ?>"
                                class="btn btn-default float-right ml-2 me-md-2">Regresar</a>
                            <a href="<?= base_url('admin/competencias/new') ?>"
                                class="btn btn-primary float-right">Nuevo
                                atributo</a>
                        </div>
                    </div>

                </div>
                <div class="card-body">
                    <table id="example" class="display table table-justify table-bordered table-hovered"
                        style="width:'100%">
                        <thead>
                            <tr>
                                <th>TIPO</th>
                                <th>Grupo</th>
                                <th>Asignatura</th>
                                <th>Competencia</th>
                                <th>Atributo</th>
                                <th>ACCIONES</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (count($atricom) > 0): ?>
                                <?php foreach ($atricom as $competencia): ?>
                                    <tr>
                                        <td>
                                            <span class="text-uppercase">
                                                <?= !empty($competencia['tipo_competencia']) ? $competencia['tipo_competencia'] : 'No asignado' ?>
                                            </span>
                                        </td>
                                        <td class="text-uppercase">
                                            <?= !empty($competencia['clave_carrera']) ? $competencia['clave_carrera'] . '-' . $competencia['clave_periodo'] . '-' . $competencia['nombre_grupo'] : 'No asignado'; ?>
                                        </td>
                                        <td class="text-uppercase">
                                            <?= !empty($competencia['nombre_asignatura']) ? $competencia['nombre_asignatura'] : 'No asignado' ?>
                                        </td>
                                        <td class="text-uppercase">
                                            <?= !empty($competencia['clave_competencia']) ?$competencia['clave_competencia']. '-' . $competencia['nombre_competencia'] : 'No asignado' ?>
                                        </td>
                                        <td>
                                            <ul>
                                                <li><?= $competencia['nombre_atributo']; ?><?=$competencia['atributoId']?></li>
                                            </ul>
                                        </td>
                                        <td class="d-flex">
                                            <a href="<?= base_url('admin/competencias/' . $competencia['atributoId'] . '/edit') ?>"
                                                class="btn btn-default" title="Editar">
                                                <i class="fas fa-edit text-primary"></i>
                                            </a>
                                            <a href="" class="btn btn-default" data-bs-toggle="modal"
                                                data-bs-target="#modalCompetencias"
                                                data-clave="<?= htmlspecialchars($competencia['nombre_atributo']) ?>"
                                                data-nombre-estudiante="<?= htmlspecialchars($competencia['nombre_usuario']) ?>"
                                                data-apaterno-estudiante="<?= htmlspecialchars($competencia['apaterno_usuario']) ?>"
                                                data-amaterno-estudiante="<?= htmlspecialchars($competencia['amaterno_usuario']) ?>"
                                                data-estudiante-id="<?= htmlspecialchars($competencia['estudianteId']) ?>"
                                                data-calificacion="<?= htmlspecialchars($competencia['calificacion']) ?>"
                                                data-fase="<?= htmlspecialchars($competencia['fase']) ?>"
                                                data-atributo_id="<?=htmlspecialchars($competencia['atributoId'])?>">
                                                <i class="fas fa-eye"></i>
                                            </a>


                                            <form class=" display-none" method="post"
                                                action="<?= base_url('admin/competencias/' . $competencia['atributoId']) ?>"
                                                id="competenciaDeleteForm<?= $competencia['atributoId'] ?>">
                                                <input type="hidden" name="_method" value="DELETE" />
                                                <a href="javascript:void(0)"
                                                    onclick="eliminarElemento('competenciaDeleteForm<?= $competencia['atributoId'] ?>', '¿Desea eliminar la competencia seleccionada? Esta acción es irreversible.')"
                                                    class="btn btn-default 
                                                    title=" Eliminar"><i class="fas fa-trash text-danger"></i></a>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr rowspan="1">
                                    <td colspan="6">
                                        <h6 class="text-danger text-center">No hay información de competencias registradas
                                        </h6>
                                    </td>
                                </tr>
                            <?php endif ?>
                        </tbody>

                        <tfoot>
                            <tr>
                                <th>TIPO</th>
                                <th>Grupo</th>
                                <th>Asignatura</th>
                                <th>Competencia</th>
                                <th>Atributo</th>
                                <th>ACCIONES</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>

<div class="modal fade modal-lg" id="modalCompetencias" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="modalCompetencias" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header ">
                <h1 class="modal-title fs-5 fw-bold" id="staticBackdropLabel">Atributos</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="<?= base_url('admin/competencias/guardarCalificacion') ?>">
                    <div>
                        <label class="form-label fw-bold">Nombre del Atributo:</label>
                        <ul id="atributoLista"></ul> <!-- Cambié el <ul> a un id específico -->
                    </div>
                    <div class="row">
                        <div class="col">
                            <label class="form-label fw-bold">Estudiantes:</label>
                            <ul id="estudiantesLista"></ul> <!-- Cambié el <ul> a un id específico -->
                        </div>
                        <div class="col">
                            <label for="" class="form-label fw-bold">Calificaciones anteriores:</label>
                            <ul id="calificacionesAnteriores"></ul>
                        </div>
                        <div class="col">
                            <label class="form-label fw-bold">Calificar:</label>
                            <ul id="calificacionesLista"></ul>
                        </div>

                    </div>

                    <button class="btn btn-primary mt-3">Guardar Calificaciones</button>
                </form>
            </div>
        </div>
    </div>
</div>



<!--MODAL-->
<div class="modal fade modal-sm" id="AgregarAtributos" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="AgregarAtributos" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Agregar atributos</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('admin/competencias/agregarAtributo') ?>" method="POST">
                <input type="hidden" name="competencia_id" id="competencia_id"
                    value="<?= isset($competencia['id']) ? $competencia['id'] : '' ?>">
                <div class="mb-3">
                    <label class="form-label">Atributo:</label>
                    <input class="form-control" type="text" name="atributo" id="atributo" required
                        value="<?php echo set_value('atributo'); ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">Porcentaje:</label>
                    <input class="form-control" type="number" name="porcentaje" id="porcentaje" required
                        value="<?php echo set_value('porcentaje'); ?>">
                </div>
                <div class="mb-3">
                    <label for="">Evaluación:</label>
                    <select class="form-select" name="evaluacion" id="evaluacion" required>
                        <option value="A">A</option>
                        <option value="B">B</option>
                        <option value="C">C</option>
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Agregar Atributo</button>
                </div>
            </form>
        </div>
    </div>
</div>



<?= $this->endSection(); ?>