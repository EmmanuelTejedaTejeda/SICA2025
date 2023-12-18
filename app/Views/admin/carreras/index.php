<div>
	<a class="btn btn-primary" href="<?= base_url('admin/carreras/new') ?>">Agregar</a>
</div>


<?php foreach ($carreras as $carrera): ?>
	<div>
		<p><?= $carrera['clave'] . ' - ' . $carrera['nombre'] ?></p>
		<a href="<?= base_url('admin/carreras/edit/' . $carrera['id']) ?>">Editar</a>
	</div>
	<br>
<?php endforeach; ?>