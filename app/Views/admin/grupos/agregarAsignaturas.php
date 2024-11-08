<?= $this->extend('template/main'); ?>

<?= $this->section('content') ?>

<div class="row py-2">
    <?php $validation = \Config\Services::validation(); ?>
</div>


<form method="POST" action="<?= base_url('admin/grupos/guardarAsignaturas') ?>" enctype="multipart/form-data">
    <?= csrf_field() ?>

    <div class="card primary">
        <div class="card-header">
            <h1 >Agregar asignaturas al grupo: <?= $nombreGrupo ?></h1>
        </div>


        <div class="card-body">
            <div class="row">
                <div class="">
                    <input type="hidden" value="<?= $grupo['id'] ?>" name="grupo_id">
                    <div class="form-group mb-3 has-validation">
                        <label class="form-label">Seleccione las asignaturas:</label>
                        <ul name="atributos" id="">
                            <?php foreach ($asignaturas as $asignatura): ?>
                                <li class="mb-3">
                                    <input type="checkbox" name="asignatura_id[]" value="<?= $asignatura['id'] ?>">
                                    <?= $asignatura['nombre'] ?>
                                </li>
                            <?php endforeach ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-3 d-grid gap-2 d-md-flex justify-content-md-end mb-3">
            <input class="btn btn-primary" type="submit" value="Guardar">
            <a href="<?= base_url('admin/grupos') ?>" class="btn btn-default float-right">Cancelar y regresar</a>
        </div>
    </div>
</form>
<?= $this->endSection() ?>