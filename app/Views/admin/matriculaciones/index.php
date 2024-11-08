<?= $this->extend('template/main'); ?>

<?= $this->section('content'); ?>


<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col">
                        <h5 class="card-title text-uppercase">
                            Matriculación
                        </h5>
                    </div>
                    <div class="col d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="<?= base_url('admin/') ?>"
                            class="btn btn-default float-right ml-2 me-md-2">Regresar</a>
                        <a href="<?= base_url('admin/matriculaciones/new') ?>" class="btn btn-primary float-right">
                            Crear grupo
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table id="example" class="table table-striped">
                    <thead>
                        <tr>
                            <th>Grupo</th>
                            <th>Estudiantes por grupo</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (count($matriculaciones) > 0):
                            foreach ($matriculaciones as $matriculado): ?>
                                <tr>
                                    <td>
                                        <?= $matriculado['grups'] ?>
                                    </td>
                                    <td>
                                        <?= $matriculado['cantidadEstudiantes'] ?>
                                    </td>
                                    <td class="d-flex">
                                        <a href="<?= base_url('admin/matriculaciones/edit/' . $matriculado['id']) ?>"
                                            class="btn btn-default" title="Editar">
                                            <i class="fas fa-edit text-primary"></i>
                                        </a>
                                        <a class="btn btn-default" title="Ver" 
                                            data-bs-toggle="modal"
                                            data-bs-target="#staticBackdrop"
                                            data-grupo="<?= htmlspecialchars($matriculado['grups']) ?>"
                                            data-estudiantes="<?= htmlspecialchars($matriculado['nombre_completo']) ?>">
                                            <i class="fas fa-eye" style="color: black"></i>
                                        </a>

                                        <form class="display-none" method="post"
                                            action="<?= base_url('admin/matriculaciones/deleteGroup/' . $matriculado['id']) ?>"
                                            id="matriculacionesDeleteForm<?= $matriculado['id'] ?>">
                                            <input type="hidden">
                                            <a href="javascript:void(0)"
                                                onclick="eliminarElemento('matriculacionesDeleteForm<?= $matriculado['id'] ?>', '¿Desea eliminar el siguiente grupo? Esta  accion es irreversible')"
                                                class="btn btn-default" title="Eliminar">
                                                <i class="fas fa-trash text-danger"></i>
                                            </a>
                                        </form>
                                    </td>
                                </tr>
                                <?php
                            endforeach;
                        else: ?>
                            <tr rowspan="1">
                                <td colspan="5">
                                    <h6 class="text-danger text-center">No hay información de alumnos registrados</h6>
                                </td>
                            </tr>
                        <?php endif ?>
                    </tbody>

                    <tfoot>
                        <tr>
                            <th>Grupo</th>
                            <th>Estudiante</th>
                            <th>Acciones</th>
                        </tr>
                    </tfoot>
                </table>

            </div>
        </div>
        <div>

        </div>
    </div>



    <!--MODAL-->
    <div class="modal fade modal-sm" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 fw-bold" id="staticBackdropLabel">Matriculaciones</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div>
                        <label class="form-label fw-bold">Grupo:</label>
                        <ul>
                        </ul>
                    </div>
                    <div>
                        <label class="form-label fw-bold">Estudiantes:</label>
                        <ul>
                            <li></li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <?= $this->endSection(); ?>