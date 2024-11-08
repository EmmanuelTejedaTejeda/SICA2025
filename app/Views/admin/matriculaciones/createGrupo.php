<?= $this->extend('template/main'); ?>

<?= $this->section('content'); ?>


<div class="row py-2">
    <?php $validation = \Config\Services::validation(); ?>
</div>

<?php if (session()->get('failed')): ?>
    <div class="alert alert-danger">
        <?= session()->get('failed'); ?>
    </div>
<?php endif; ?>

<?php if (session()->get('success')): ?>
    <div class="alert alert-success">
        <?= session()->get('success'); ?>
    </div>
<?php endif; ?>


<form method="POST" action="<?= base_url('admin/matriculaciones') ?>" enctype="multipart/form-data">
    <?= csrf_field() ?>

    <div class="card primary">
        <div class="card-header">
            <h5 class="card-title">Crear grupo</h5>
        </div>

        <div class="card-body">
            <select class="form-select" name="grupo" id="grupo">
                <?php foreach ($grupos as $grupo): ?>
                    <option value="<?= $grupo['id_grupo'] ?>">
                        <?= $grupo['grups'] ?>
                        <?= $grupo['id_grupo']?>
                    </option>
                <?php endforeach; ?>
            </select>


            <div class="row mt-3">
                <div class="col">
                    <div class="form-group">
                        <label class="form-label">Selecciona a los estudiantes:</label>
                        <?php foreach ($alumnos as $alumno): ?>
                            <div>
                                <ul>
                                    <li>
                                        <input id="estudiante" type="checkbox" name="estudiantes[]"
                                            value="<?= $alumno['id_usuario'] ?>">
                                        <?= $alumno['nombre_alumnos'] ?>
                                        <?= $alumno['id_usuario']?>
                                    </li>
                                </ul>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

            </div>
        </div>

        <div class="card-footer text-end">
            <input class="btn btn-primary" type="submit" value="Guardar">
            <a href="<?= base_url('admin/matriculaciones') ?>" class="btn btn-default float-right">Cancelar y
                regresar</a>
        </div>
    </div>
</form>




<?= $this->endSection(); ?>