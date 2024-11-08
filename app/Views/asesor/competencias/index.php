<?= $this->extend('template/mainAsesor'); ?>

<?= $this->section('content'); ?>

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script type="text/javascript" language="javascript"
    src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col">
                        <h5 class="card-title">
                            Competencias
                        </h5>
                    </div>
                    <div class="col">
                    </div>
                    <div class="col d-grid-2 d-md-flex justify-content-md-end">

                    </div>
                </div>
            </div>
            <div class="card-body">
                <table id="example" class="table table-striped">
                    <thead>
                        <tr>
                            <th>Tipo</th>
                            <th>Competencia</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (count($competencias) > 0):
                            foreach ($competencias as $competencia):
                                if ($competencia['estado'] == 1):
                                    ?>
                                    <tr>
                                        <td>
                                            <?= $competencia['tipo'] ?>
                                        </td>
                                        <td>
                                            <?= $competencia['clave'] . '-' . $competencia['nombre']; ?>
                                        </td>
                                    </tr>
                                    <?php
                                endif;
                            endforeach;
                        else: ?>
                            <tr rowspan="1">
                                <td colspan="5">
                                    <h6 class="text-danger text-center">No hay información de competencias registradas</h6>
                                </td>
                            </tr>
                        <?php endif ?>
                    </tbody>

                    <tfoot>
                        <tr>
                            <th>Tipo</th>
                            <th>Competencia</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>