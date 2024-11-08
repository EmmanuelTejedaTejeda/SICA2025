<?= $this->extend('template/main'); ?>

<?= $this->section('content'); ?>

<?php if (session()->get('success')): ?>
    <div class="alert alert-success">
        <?= session()->get('success'); ?>
    </div>
<?php endif; ?>

<?php if (session()->get('failed')): ?>
    <div class="alert alert-danger">
        <?= session()->get('failed'); ?>
    </div>
<?php endif; ?>

<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col d-flex ">
                        <h5 class="card-title">
                            GRUPOS
                        </h5>
                    </div>
                    <div class="col">
                    </div>
                    <div class="col d-grid-2 d-md-flex justify-content-md-end">
                        <a href="<?= base_url('admin/competencias') ?>"
                            class="btn btn-default float-right ml-2 me-md-2">Regresar</a>
                        <a href="<?= base_url('admin/grupos/new') ?>" class="btn btn-primary float-right">Nuevo
                            grupo</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table id="example" class="table table-striped">
                    <thead>
                        <tr>
                            <th>Grupo</th>
                            <th>Asignaturas</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (count($grupocpe) > 0):
                            foreach ($grupocpe as $grupo): ?>
                                <tr>
                                    <td>
                                        <?= $grupo['grupo'] ?>
                                    </td>
                                    <td>
                                        <a href="<?= base_url('admin/grupos/' . $grupo['id'] . '/agregarAsignaturas') ?>"
                                            class="btn btn-default" title="Agregar"><i
                                                class="fa-solid fa-plus text-primary"></i></a>
                                        <a href="<?= base_url('admin/grupos/' . $grupo['id'] . '/mostrarAsignaturas') ?>"
                                            class="btn btn-default" title="Ver"><i class="fas fa-eye"></i></a>
                                    </td>
                                    <td class="d-flex">
                                        <a href="<?= base_url('admin/grupos/' . $grupo['id'] . '/edit') ?>"
                                            class="btn btn-default" title="Editar">
                                            <i class="fas fa-edit text-primary"></i>
                                        </a>
                                        <a href="" class="btn btn-default">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <form class=" display-none" method="post"
                                            action="<?= base_url('admin/grupos/' . $grupo['id']) ?>"
                                            id="competenciaDeleteForm<?= $grupo['id'] ?>">
                                            <input type="hidden" name="_method" value="DELETE" />
                                            <a href="javascript:void(0)"
                                                onclick="eliminarElemento('competenciaDeleteForm<?= $grupo['id'] ?>', '¿Desea eliminar la competencia seleccionada? Esta acción es irreversible.')"
                                                class="btn btn-default 
                                                    title=" Eliminar"><i class="fas fa-trash text-danger"></i></a>
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
                            <th>Asignaturas</th>
                            <th>Acciones</th>
                        </tr>
                    </tfoot>
                </table>


            </div>
        </div>
        <div>

        </div>
    </div>
</div>
<?= $this->endSection(); ?>