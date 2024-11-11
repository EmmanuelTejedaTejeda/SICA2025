<?= $this->extend('template/main');
use App\Database\Migrations\Usuario; ?>

<?= $this->section('content'); ?>

<div class="mb-4">
    <h5 class="card-title"><?= $atributo['nombre_atributo'] ?></h5>
</div>

<?php if (session()->get('error')): ?>
    <div class="alert alert-danger">
        <?= session()->get('error'); ?>
    </div>
<?php endif; ?>
<?php if (session()->get('success')): ?>
    <div class="alert alert-success">
        <?= session()->get('success'); ?>
    </div>
<?php endif; ?>

<form action="<?= base_url('admin/competencias/guardarCalificacion') ?>" method="POST">
    <table class="display table table-justify table-bordered table-hovered">
        <div class="card-body">
            <thead>
                <th>Estudiantes</th>
                <th>Calificaciones anteriores</th>
                <th>Calificar</th>
            </thead>
            <tbody>
                <input type="hidden" name="atributo_id" id="" value="<?= $atributo['id'] ?>">
                <?php if (!empty($usuarios)): ?>
                    <?php foreach ($usuarios as $usuario): ?>
                        <tr>
                            <input type="hidden" name="nombre_estudiante[]" value="<?= $usuario['nombre_usuario'] ?>">
                            <input type="hidden" name="estudiante_id[]" id="" value="<?= $usuario['estudiante_id'] ?>">
                            <td><?= $usuario['nombre_usuario'] . ' ' . $usuario['apaterno_usuario'] . ' ' . $usuario['amaterno_usuario'] ?>
                            </td>
                            <td>
                                <?php if (!empty($usuario['calificaciones'])): ?>
                                    <ul class="list-group list-group-flush">
                                        <?php foreach ($usuario['calificaciones'] as $calificacion): ?>
                                            <li class="d-inline d-flex justify-content-between">
                                                <?= $calificacion['calificacion'] . '% - ' . $calificacion['fase'] ?>
                                                <form method="post" action="">
                                                    <a href="<?= base_url('admin/competencias/eliminarCalificacion/' . $calificacion['evaluacion_id']) ?>"
                                                        class="text-danger">
                                                        <i class="fa-solid fa-trash"></i>
                                                    </a>
                                                </form>
                                                <form class=" display-none" method="post"
                                                    action="<?= base_url('admin/competencias/' . $competencia['atributoId']) ?>"
                                                    id="competenciaDeleteForm<?= $competencia['atributoId'] ?>">
                                                    <input type="hidden" name="_method" value="DELETE" />
                                                    <a href="javascript:void(0)"
                                                        onclick="eliminarElemento('competenciaDeleteForm<?= $competencia['atributoId'] ?>', '¿Desea eliminar la competencia seleccionada? Esta acción es irreversible.')"
                                                        class="btn btn-default 
                                                    title=" Eliminar"><i class="fas fa-trash text-danger"></i></a>
                                                </form>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                <?php else: ?>
                                    No hay calificaciones anteriores
                                <?php endif; ?>
                            </td>
                            <td class="d-flex">
                                <input class="form-control d-inline" name="calificacion[]" type="number" min="0" max="100"
                                    placeholder="Ingrese una calificación">
                                <select class="d-inline" name="fase[]">
                                    <option value="A">A</option>
                                    <option value="B">B</option>
                                    <option value="C">C</option>
                                </select>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="text-danger text-center">No se ha asignado esta competencia a una asignatura
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
            <tfoot>
                <tr>
                    <th>Estudiantes</th>
                    <th>Calificaciones anteriores</th>
                    <th>Calificar</th>
                </tr>
            </tfoot>
        </div>
    </table>
    <div class="col d-grid gap-2 d-md-flex justify-content-md-end">
        <a href="<?= base_url('admin/competencias') ?>" class="btn btn-danger">Regresar</a>
        <button type="submit" href="" class="btn btn-primary">Guardar califaciones</>
    </div>
</form>
<?= $this->endSection(); ?>;