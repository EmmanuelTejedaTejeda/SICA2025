<?= $this->extend('template/main'); ?>


<?= $this->section('content'); ?>
<div class="">
    <div class="row">
        <div class="text-end">
            <a href="<?= base_url('admin/grupos') ?>" class="btn btn-default">Regresar</a>
        </div>
    </div>

    <div class="card">

        <div class="card-header">
            <h1><?=$nombre?></h1>
        </div>

        <div class="card-body">


            
                <h5 class="card-title mb-3">Asignaturas asignadas</h5>
            

                <ul>
                    <?php if ($asignatura): ?>
                        <?php foreach ($asignatura as $asig): ?>
                            <li class="mb-3"><?= $asig['nombre'] ?></li>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <li>No se han asignado atributos a esta asignatura.</li>
                    <?php endif; ?>
                </ul>
            



        </div>

    </div>

</div>

<?= $this->endSection() ?>