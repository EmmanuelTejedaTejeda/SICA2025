<?= $this->extend('template/main'); ?>

<?= $this->section('content') ?>

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


<form method="POST" action="<?= base_url('admin/competencias') ?>" enctype="multipart/form-data">
    <?= csrf_field() ?>

    <div class="card primary">
        <div class="card-header">
            <h5 class="card-title">Crear atributo</h5>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col">
                    <div class="form-group mb-3 has-validation">
                        <label class="form-label">Nombre:</label>
                        <input type="text" required maxlength="255"
                            class="form-control <?php if ($validation->getError('nombre')): ?>is-invalid<?php endif ?>"
                            name="nombre" placeholder="Nombre del atributo"
                            value="<?php echo set_value('nombre'); ?>" />
                        <?php if ($validation->getError('nombre')): ?>
                            <div class="invalid-feedback">
                                <?= $validation->getError('nombre') ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <!--
            <div class="row mt-3">

                <div class="col">
                    <div class="form-group">
                        <label class="form-label">Asignatura para la competencia:</label>
                        <select class="form-select" name="asignatura_id">
                            <?php foreach ($asignaturas as $asignatura): ?>
                                <option value="<?= $asignatura['id'] ?>">
                                    <?= $asignatura['nombre'] ?>
                                </option>

                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>
                            -->
        </div>

        <div class="card-footer text-end">
            <input class="btn btn-primary" type="submit" value="Guardar">
            <a href="<?= base_url('admin/competencias') ?>" class="btn btn-default float-right">Cancelar y regresar</a>
        </div>
    </div>
</form>



<?= $this->endSection() ?>