<?= $this->extend('template/mainEstudiante'); ?>

<?= $this->section('content'); ?>

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script type="text/javascript" language="javascript"
    src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>

<div class="row">
    <div class="col-xl-12">
        <?php
        if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success alert-dismissible" id="success-alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                <?php echo session()->getFlashdata('success') ?>
            </div>
        <?php elseif (session()->getFlashdata('failed')): ?>
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="btn-close" data-bs-dismiss="alert">&times;</button>
                <?php echo session()->getFlashdata('failed') ?>
            </div>
        <?php endif; ?>
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col">
                        <h5 class="card-title">
                            Atributos por competencia
                        </h5>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table id="example" class="table table-striped">
                    <thead>
                        <tr>
                            <th>Asignatura</th>
                            <th>Competencia</th>
                            <th>Atributo</th>
                            <th>Porcentaje</th>
                            <th>Etapa</th>

                            <!--<th>Ver atributos</th>-->
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (count($atributos) > 0): ?>
                            <?php foreach ($atributos as $competencia): ?>
                                <tr>
                                    <th><?= esc($competencia['nombre_asignatura_fk']) ?></th>
                                    <th><?= esc($competencia['clave_competencia']) . '-' . esc($competencia['tipo_competencia']) . '-' . esc($competencia['nombre_competencia']) ?>
                                    </th>

                                    <td><?= esc($competencia['nombreAtributo']) ?></td>
                                    <td><?= esc($competencia['porcentajeAtributo']) ?></td>
                                    <td><?= esc($competencia['etapaAtributo']) ?></td>
                                    <!--<td><?php //esc($competencia['clave_grupo']) . '-' . esc($competencia['clave_periodoAcademico']) . '-' . esc($competencia['nombre_grupo']) ?>
                                    </td>-->
                                    <!--<td>
                                        <a class="btn btn-default" href="#" data-bs-toggle="modal"
                                            data-bs-target="#atributosModal">
                                            <i class="fas fa-eye"></i></a>
                                    </td>-->
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr class="text-center">
                                <td></td>
                                <td colspan="4" class=" text-danger">No hay competencias en tu grupo o no estas asignado a un grupo</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>

                    <tfoot>
                        <tr>
                            <th>Asignatura</th>
                            <th>Competencia</th>
                            <th>atributo</th>
                            <th>porcentaje</th>
                            <th>etapa</th>

                            <!--<th>Ver atributos</th>-->
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>


<!-- Modal para ver atributos -->
<div class="modal fade" id="atributosModal" tabindex="-1" aria-labelledby="atributosModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="atributosModalLabel">Atributos de la competencia:
                    <?= isset($atributoos['id']) ? $atributos['nombre'] : '' ?>
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Atributo</th>
                            <th>Porcentaje</th>
                            <th>Evaluación</th>
                        </tr>
                    </thead>
                    <tbody id="atributosBody">
                        <?php foreach ($atributos as $atributo): ?>
                            <tr>
                                <td><?php // $atributo['nombre_atributo'] ?></td>
                                <td><?php // $atributo['porcentaje_atributo'] ?></td>
                                <td><?php // $atributo['evaluacion_atributo'] ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('#atributosModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var modal = $(this);
        });
    });
</script>


<?= $this->endSection(); ?>