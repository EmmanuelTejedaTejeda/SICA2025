<?= $this->extend('template/main'); ?>

<?= $this->section('content'); ?>
<?php $validation = \Config\Services::validation(); ?>


<form method="POST" action="<?= base_url('admin/matriculaciones/update/' . $matriculado['id']); ?>"
    enctype="multipart/form-data">
    <?= csrf_field() ?>

    <?php if (session()->get('error')): ?>
        <div class="alert alert-danger alert-dismissible">
            <?= session()->get('error') ?>
        </div>
    <?php endif; ?>
    <?php if (session()->get('success')): ?>
        <div class="alert alert-success">
            <?= session()->get('success'); ?>
        </div>
    <?php endif; ?>

    <div class="card primary">
        <div class="card-header d-flex">
            <h5 class="card-title d-inline">Actualizar datos del grupo: <p class="d-inline"><?= $matriculado['grups'] ?>
                </p>
            </h5>

        </div>
        <div class="card-body">
            <table id="ejample" class="table table-striped table-hovered table-bordered">
                <thead>
                    <th>Lista de estudiantes</th>
                    <th class="d-flex justify-content-center">Acciones</th>
                </thead>
                <tbody>
                    <?php $estudiantes = explode(', ', $matriculado['nombre_completo']); ?>
                    <?php foreach ($estudiantes as $alumno): ?>
                        <tr>
                            <td>
                                <?= $alumno ?>
                            </td>
                            <td class="d-flex justify-content-center">
                                <form class="display-none" method="post"
                                    action="<?= base_url('admin/matriculaciones/deleteAlumno/' . $matriculado['id']) ?>"
                                    id="matriculacionDeleteForm<?= $matriculado['id'] ?>">
                                    <input type="hidden" />
                                    <a href="javascript:void(0)"
                                        onclick="eliminarElemento('matriculacionDeleteForm<?= $matriculado['id'] ?>', '¿Desea eliminar al alumno del grupo seleccionado? Esta acción es irreversible.')"
                                        class="btn btn-default" title="Eliminar">
                                        <i class="fas fa-trash text-danger"></i></a>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <th>Lista de estudiantes</th>
                    <th class="d-flex justify-content-center">Acciones</th>
                </tfoot>
            </table>

            <div class="card-footer text-end">
                <a class="btn btn-primary" title="Ver" data-bs-toggle="modal" data-bs-target="#modalAgregarEstudiantes"
                    data-grupo="<?= htmlspecialchars($matriculado['grups']) ?>">
                    Agregar estudiantes
                </a>
                <a href="<?= base_url('admin/matriculaciones') ?>" class="btn btn-danger">Regresar</a>
            </div>

        </div>
</form>

<!--MODAL-->
<div class="modal fade modal-lg modal-dialog-scrollable" id="modalAgregarEstudiantes" data-bs-backdrop="static"
    data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalAgregarEstudiantes" aria-hidden="true">
    <div class="modal-dialog">
        <form action="<?= base_url('admin/matriculaciones/agregarEstudiantes') ?>" method="POST">

            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 d-inline" id="staticBackdropLabel">Agregar alumnos al grupo
                        <p class="d-inline fw-bold" id="nombre_grupo">
                        </p>
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="grupo_id" id="" value="<?= $matriculado['id_grupo'] ?>">
                    <div class="row align-items-start">
                        <div class="col">
                            <p class="fs-6 fw-bold">Estudiantes:</p>
                            <?php foreach ($usuarios as $usuario): ?>
                                <div>
                                    <ul>
                                        <li>
                                            <input type="checkbox" name="estudiantes[]"
                                                value="<?= $usuario['id_usuario'] ?>">
                                            <?= $usuario['nombre_alumnos'] ?>
                                        </li>
                                    </ul>
                                </div>

                            <?php endforeach; ?>
                        </div>
                        <div class="col">
                            <p class="fs-6 fw-bold">Grupo al que pertenecen:</p>
                            <?php foreach ($usuarios as $usuario): ?>
                                <div>
                                    <?php if ($usuario['nombre_grupo'] != 'No asignado'): ?>
                                        <p><?= $usuario['nombre_grupo'] ?></p>
                                    <?php else: ?>
                                        <p>Este estudiante no pertenece a ningún grupo.</p>
                                    <?php endif; ?>
                                </div>

                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary" id="guardarCambios">Guardar cambios</>
                </div>



            </div>
        </form>
    </div>
</div>

<?= $this->endSection(); ?>