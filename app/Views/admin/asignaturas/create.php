<?= $this->extend('template/main'); ?>

<?= $this->section('content') ?>

    <div class="row py-2">
        <?php $validation = \Config\Services::validation(); ?>
    </div>


    <form method="POST" action="<?= base_url('admin/asignaturas') ?>" enctype="multipart/form-data">
        <?= csrf_field() ?>

        <div class="card primary">
            <div class="card-header">
                <h5 class="card-title">Crear asignatura</h5>
                <a href="<?= base_url('admin/asignaturas') ?>" class="btn btn-danger float-right">Cancelar y regresar</a>
            </div>


            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group mb-3 has-validation">
                            <label class="form-label">Clave de la asignatura:</label>
                            <input type="text"
                                   class="form-control <?php if ($validation->getError('clave')): ?>is-invalid<?php endif ?>"
                                   name="clave" placeholder="AA02X" value="<?php echo set_value('clave'); ?>"/>
                            <?php if ($validation->getError('clave')): ?>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('clave') ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-3 has-validation">
                            <label class="form-label">Créditos:</label>
                            <!-- Aumento de intervalo -->
                            <input type="number" max="100" min="0"
                                   class="form-control <?php if ($validation->getError('creditos')): ?>is-invalid<?php endif ?>"
                                   name="creditos" placeholder="3" value="<?php echo set_value('creditos'); ?>"/>
                            <?php if ($validation->getError('creditos')): ?>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('creditos') ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-3 has-validation">
                            <label class="form-label">Horas S/D/M:</label>
                            <input type="number" min="0" max="50"
                                   class="form-control <?php if ($validation->getError('horasSemana')): ?>is-invalid<?php endif ?>"
                                   name="horasSemana" placeholder="3" value="<?php echo set_value('horasSemana'); ?>"/>
                            <?php if ($validation->getError('horasSemana')): ?>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('horasSemana') ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="col">
                        <div class="form-group mb-3 has-validation">
                            <label class="form-label">Asignatura:</label>
                            <input type="text"
                                   class="form-control <?php if ($validation->getError('nombre')): ?>is-invalid<?php endif ?>"
                                   name="nombre" placeholder="Tu nombre" value="<?php echo set_value('nombre'); ?>"/>
                            <?php if ($validation->getError('nombre')): ?>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('nombre') ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label class="form-label">Descripción:</label>
                            <textarea
                                class="form-control <?php if ($validation->getError('descripcion')): ?>is-invalid<?php endif ?>"
                                name="descripcion" placeholder="Resumen de la asignatura"><?php echo set_value('descripcion'); ?></textarea>
                            <?php if ($validation->getError('descripcion')): ?>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('descripcion') ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label class="form-label">Temario de la asignatura:</label>
                            <textarea
                                class="form-control <?php if ($validation->getError('temario')): ?>is-invalid<?php endif ?>"
                                name="temario" placeholder="Temario de la asignatura"><?php echo set_value('temario'); ?></textarea>
                            <?php if ($validation->getError('temario')): ?>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('temario') ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <div class="form-group mb-3 has-validation">
                            <label class="form-label">Archivo del temario de la asignatura:</label>
                            <input type="file" accept="application/pdf"
                                   class="form-control <?php if ($validation->getError('temarioArchivo')): ?>is-invalid<?php endif ?>"
                                   name="temarioArchivo" placeholder="Temario de la asignatura" value="<?php echo set_value('temarioArchivo'); ?>"/>
                            <?php if ($validation->getError('temarioArchivo')): ?>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('temarioArchivo') ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="card-footer">
            <input type="reset" value="Restablecer" class="btn btn-default">
            <button type="submit" class="btn btn-primary float-right">Guardar</button>
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