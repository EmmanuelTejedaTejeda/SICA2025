<?= $this->extend('template/main');
$this->section('title') ?>Editar asignatura<?= $this->endSection();
?>

<?= $this->section('content') ?>
<?php $validation = \Config\Services::validation(); ?>


    


    <form method="POST" action="<?= base_url('admin/competencias/' . $competencia['id']); ?>" enctype="multipart/form-data">
        <?= csrf_field() ?>

        <div class="card primary">
            <div class="card-header">
                <h5 class="card-title">Actualizar datos del atributo <?= $competencia['id']?></h5>
            </div>

            <input type="hidden" name="_method" value="PUT">

            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <div class="form-group mb-3 has-validation">
                            <label class="form-label">Nombre:</label>
                            <input type="text"
                                   class="form-control <?php if ($validation->getError('nombre')): ?>is-invalid<?php endif ?>"
                                   name="nombre" placeholder="Nombre del atributo"
                                   value="<?php if ($competencia['nombre_atributo']): echo $competencia['nombre_atributo']; else: set_value('nombre'); endif; ?>"/>
                            <?php if ($validation->getError('nombre')): ?>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('nombre') ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>



        <div class="card-footer text-end">
            <button type="submit" class="btn btn-primary float-right">Actualizar</button>
            <a href="<?= base_url('admin/competencias') ?>" class="btn btn-danger">Cancelar y regresar</a>

        </div>

        </div>
    </form>

    


    <script>
        $(function () {
            <?php if (session()->has('success')) { ?>
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Registro realizado con éxito',
                text: '<?= session('success'); ?>'
                showConfirmButton: false,
                timer: 1500
            })
            <?php } ?>

        });
    </script>

<?= $this->endSection() ?>