<?= $this->extend('template/main'); ?>
<?= $this->section('content'); ?>
<div class="">
    <div class="row">
        <div class="text-end">
            <a href="<?= base_url('admin/asignaturas') ?>" class="btn btn-default">Regresar</a>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h1><?php echo trim($asignatura['clave']) ?> <?php echo trim($asignatura['nombre']) ?></h1>
        </div>
        <div class="card-body">
            <h5 class="card-title mb-3">Atributos asignados</h5>
            <ul>
                <?php if ($atributosAsignados): ?>
                    <?php foreach ($atributosAsignados as $atributo): ?>
                        <li class="mb-3"><?= $atributo['nombre_atributo'] ?></li>
                    <?php endforeach; ?>
                <?php else: ?>
                    <li>No se han asignado atributos a esta asignatura.</li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</div>

<?= $this->endSection() ?>