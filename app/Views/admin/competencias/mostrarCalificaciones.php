<?= $this->extend('template/main'); ?>

<?= $this->section('content'); ?>

<div class="mb-4">
    <h5 class="card-title"><?= $atributo['nombre_atributo'] ?></h5>
</div>

<table class="display table table-justify table-bordered table-hovered">
    <div class="card-body">
        <thead>
            <th>Estudiantes</th>
            <th>Calificaciones anteriores</th>
            <th>Calificar</th>
        </thead>
        <tbody>
            <?php foreach ($consulta as $datos): ?>
                <?php if (!empty($datos['nombre_usuario'])): ?>
                    <tr>
                        <td><?= $datos['nombre_usuario'] ?></td>
                        <td><?= !empty($datos['calificacion']) ? $datos['calificacion'] . '-' . $datos['fase'] : 'No hay califaciones anteriores' ?>
                        </td>
                        <td class="d-flex">
                            <input class="form-control d-inline" name="calificacion" type="number"placeholder="Ingrese una calificación">
                            <select class="d-inline" name="fase" id="">
                                <option value="A">A</option>
                                <option value="B">B</option>
                                <option value="C">C</option>
                            </select>
                        </td>
                    </tr>
                <?php endif; ?>
            <?php endforeach; ?>

        </tbody>
        <tfoot>
            <tr>
                <th>Estudiantes</th>
                <th>Calificaciones anteriores</th>
                <th>Calificar</th>
            </tr>
        </tfoot>

    </div>
</table>

<?= $this->endSection(); ?>;