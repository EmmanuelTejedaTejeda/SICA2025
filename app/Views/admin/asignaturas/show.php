<?= $this->extend('admin/template/layout');

$this->section('title') ?> Ver asignatura <?= $this->endSection();

$this->section('encabezado') ?><p class="text-uppercase">Información de la asignatura
    seleccionado</p><?= $this->endSection();

?>



<?= $this->section('content'); ?>
    <div class="">
        <div class="row py-4">
            <div class="text-end">
                <a href="<?= base_url('admin/asignaturas') ?>" class="btn btn-default">Regresar</a>
            </div>
        </div>

        <div class="card">

            <div class="card-header"><h1><?php echo trim($asignatura['clave']) ?> <?php echo trim($asignatura['nombre']) ?></h1></div>

            <div class="card-body">

                <div class="row">
                    <div class="col">
                        <label for="">Asignatura:</label>
                        <?php echo trim($asignatura['clave']) ?> <?php echo trim($asignatura['nombre']) ?>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <label>Créditos: </label>
                        <?php echo trim($asignatura['creditos']) ?>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <label>Horas D/S/M: </label>
                        <?php echo trim($asignatura['horasSemana']) ?>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <label>Resumen de la asignatura: </label>
                        <?php echo trim($asignatura['descripcion']) ?>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <label>Temario: </label>
                        <?php echo trim($asignatura['temario']) ?>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <label>Archivo del temario: </label>
                        <?php echo trim($asignatura['temarioArchivo']) ?>
                    </div>
                </div>

            </div>

        </div>

    </div>
    </div>

<?= $this->endSection() ?>