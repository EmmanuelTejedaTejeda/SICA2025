<?= $this->extend('template/main'); ?>

<?= $this->section('content') ?>

<div class="row py-2">
    <?php $validation = \Config\Services::validation(); ?>
</div>


<form method="POST" action="<?= base_url('admin/asignaturas/guardarAtributos') ?>" enctype="multipart/form-data">
    <?= csrf_field() ?>

    <div class="card primary">
        <div class="card-header">
            <h5 class="card-title">Agregar atributos a <?= $asignatura['nombre'] ?></h5>
        </div>

        


        <div class="card-body">
            <div class="row">
                <div class="">
                    <input type="hidden" value="<?=$asignatura['id']?>" name="asignatura_id">
                    <div class="form-group mb-3 has-validation">
                        <label class="form-label">Seleccione los atributos:</label>
                        <ul name="atributos" id="">
                            <?php foreach ($atributo as $atri): ?>
                                <li class="mb-3">
                                <input type="checkbox" name="atributos[]" value="<?= $atri['id'] ?>" id="atributo_<?= $atri['id'] ?>">
                                <?= $atri['nombre_atributo'] ?>
                                </li>
                            <?php endforeach ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-3 d-grid gap-2 d-md-flex justify-content-md-end mb-3">
            <input class="btn btn-primary" type="submit" value="Guardar">
            <a href="<?= base_url('admin/asignaturas') ?>" class="btn btn-default float-right">Cancelar y regresar</a>
        </div>
    </div>
</form>
<?= $this->endSection() ?>