<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Competencias</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/ae360af17e.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/dash.css') ?>">


    <style {csp-style-nonce}>
        body {
            background-color: #10312B;
        }
    </style>

</head>

<body>
    <div class="wrapper">
        <aside id="sidebar" class="js-sidebar">
            <!-- Content For Sidebar -->
            <div class="h-100">
                <div class="sidebar-logo">
                    <a href="#">COMPETENCIAS</a>
                </div>
                <ul class="sidebar-nav">
                    <li class="sidebar-header">
                        Principal
                    </li>
                    <li class="sidebar-item">
                        <a href="<?= base_url('admin/competencias') ?>" class="sidebar-link">
                            <i class="fa-solid fa-person-chalkboard pe-2"></i>
                            Atributos
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="<?= base_url('admin/asignaturas') ?>" class="sidebar-link">
                            <i class="fa-solid fa-book pe-2"></i>
                            Asignaturas</a>
                    </li>
                    <li class="sidebar-item">
                        <a href="<?= base_url('admin/grupos') ?>" class="sidebar-link">
                            <i class="fa-solid fa-chalkboard pe-2"></i>
                            Grupos</a>
                    </li>
                    <li class="pe-3 sidebar-item">
                        <a href="<?= base_url('admin/matriculaciones') ?>" class="sidebar-link">
                            <i class="fa-solid fa-school pe-2"></i>
                            Matriculacion</a>
                    </li>

                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link collapsed" data-bs-target="#auth" data-bs-toggle="collapse"
                            aria-expanded="false"><i class="fa-solid fa-sliders pe-2"></i>
                            Módulos
                        </a>
                        <ul id="auth" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                            <li class="sidebar-item">
                                <a href="<?= base_url('admin/carreras') ?>" class="sidebar-link">
                                    <i class="fa-solid fa-building-columns pe-2"></i>
                                    Carreras</a>
                            </li>

                            <li class="sidebar-item">
                                <a href="<?= base_url('admin/usuarios') ?>" class="sidebar-link">
                                    <i class="fa-solid fa-users pe-2"></i>
                                    Usuarios
                                </a>
                            </li>


                        </ul>
                    </li>

            </div>
        </aside>
        <div class="main">
            <nav class="navbar navbar-expand px-3 border-bottom">
                <button class="btn" id="sidebar-toggle" type="button">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="navbar-collapse navbar">


                    <ul class="navbar-nav ml-auto">


                        <li class="nav-item">
                            <a class="nav-link" data-toggle="dropdown" href="#">
                                <i class="fas fa-user"></i> <?= session()->get('nombre') ?>
                            </a>

                        </li>

                        <li class="nav-item">
                            <a href="<?= base_url('logout'); ?>" class="nav-link">
                                <i class="fas fa-sign-out-alt"></i> Cerrar sesión
                            </a>
                        </li>

                    </ul>
                </div>
            </nav>
            <main class="content px-3 py-2">
                <div class="container-fluid">
                    <div class="mb-3">

                    </div>


                    <div>
                        <?= $this->renderSection('content') ?>
                    </div>


                </div>
            </main>
            <a href="#" class="theme-toggle">
                <i class="fa-regular fa-moon"></i>
                <i class="fa-regular fa-sun"></i>
            </a>
            <footer class="footer">
                <div class="container-fluid">
                    <div class="row text-muted">
                        <div class="col-6 text-start">
                            <p class="mb-0">
                                <a href="#" class="text-muted">
                                    Developed for Ingeniería Informática ITST. <?= date('Y') . '.'; ?>
                                </a>
                            </p>
                        </div>
                        <div class="col-6 text-end">
                            <ul class="list-inline">
                                <li class="list-inline-item">
                                    <a href="#" class="text-muted"><i class="fas fa-phone"></i> Contacto</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>



    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <script type="text/javascript" src="<?= base_url('assets/js/dash.js') ?>"></script>
    <script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script type="text/javascript" language="javascript"
        src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>

    <script type="text/javascript" class="init">
        $(document).ready(function () {
            if (!$.fn.DataTable.isDataTable('#example')) {
                $('#example').DataTable({
                    language: {
                        url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/es-MX.json',
                    },
                    dom: 'Bfrtip',
                    buttons: [
                        'copy', 'csv', 'excel', 'pdf', 'print'
                    ]
                });
            }
        });
    </script>


    <?php echo base_url('assets/adminlte/js/jquery.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/adminlte/js/bootstrap.bundle.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/adminlte/js/dashboard2.js'); ?>"></script>
    <script src="<?php echo base_url('assets/adminlte/js/adminlte.js'); ?>"></script>
    <script src="<?php echo base_url('assets/adminlte/js/overlay.js'); ?>"></script>

    <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function () {
            $('#staticBackdrop').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget);
                var grupo = button.data('grupo');
                var estudiantes = button.data('estudiantes');
                var modal = $(this);
                modal.find('.modal-body ul').eq(0).text(grupo);
                modal.find('.modal-body li').eq(0).html('<li>' + estudiantes.split(', ').join('</li><li>') + '</li>');
            });
        });
    </script>
    <script>
        $(document).ready(function () {
            $('#AgregarAtributos').on('show.bs.modal', function (event) {
                vvar agregarAtributosModal = document.getElementById('AgregarAtributos');
                agregarAtributosModal.addEventListener('show.bs.modal', function (event) {
                    var button = event.relatedTarget; // Botón que activó el modal
                    var competenciaId = button.getAttribute('data_id'); // Extraer datos del botón
                    var competenciaNombre = button.getAttribute('data-nombre');
                    var competenciaClave = button.getAttribute('data-clave');

                    // Asignar valores a los campos del modal
                    var modalTitle = agregarAtributosModal.querySelector('.modal-title');
                    modalTitle.textContent = 'Agregar atributos para ' + competenciaNombre + ' (' + competenciaClave + ')';

                    var competenciaIdInput = agregarAtributosModal.querySelector('#competencia_id');
                    competenciaIdInput.value = competenciaId;
                });
            });

        });
    </script>
    <script>
        $(document).ready(function () {
            $('#modalCompetencias').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget); // Botón que activó el modal
                var estudianteId = button.data('estudiante-id'); // Obtener estudiante ID desde data-estudiante-id
                var clave = button.data('clave'); // Clave del atributo
                var nombreEstudiante = button.data('nombre-estudiante'); // Nombre del estudiante
                var apaternoEstudiante = button.data('apaterno-estudiante');
                var amaternoEstudiante = button.data('amaterno-estudiante');
                var fase = button.data('fase'); // Fase previa (opcional)
                var calificacion = button.data('calificacion'); // Calificación previa (opcional)
                var atributo_id = button.data('atributo_id');

                var modal = $(this);

                // Limpiar listas antes de agregar contenido nuevo
                modal.find('#atributoLista').empty();
                modal.find('#estudiantesLista').empty();
                modal.find('#calificacionesLista').empty();
                modal.find('#calificacionesAnteriores').empty();


                // Verificar y mostrar el ID del estudiante
                if (estudianteId) {
                    modal.find('#estudiantesLista').append('<input name="estudiante_id" type="hidden" value="' + estudianteId + '"><input name="atributo_id" type="hidden" value="' + atributo_id + '">');
                } else {
                    alert('No se ha asignado a ningun grupo');
                }

                // Mostrar el nombre del atributo (clave)
                if (clave) {
                    modal.find('#atributoLista').append('<li>' + clave + '</li>');
                }

                // Crear el nombre completo del estudiante
                var nombreCompleto = nombreEstudiante + ' ' + apaternoEstudiante + ' ' + amaternoEstudiante;

                // Si hay nombre del estudiante, añadir sus datos a la lista
                if (nombreCompleto) {
                    var calificacionInput = '<input type="number" name="calificacion[]" required placeholder="Calificación" value="' + (calificacion || '') + '">';
                    var selectFase = '<select name="fase[]" required>' +
                        '<option value="">Seleccionar</option>' +
                        '<option value="A" ' + (fase === 'A' ? 'selected' : '') + '>A</option>' +
                        '<option value="B" ' + (fase === 'B' ? 'selected' : '') + '>B</option>' +
                        '<option value="C" ' + (fase === 'C' ? 'selected' : '') + '>C</option>' +
                        '</select>';

                    // Mostrar el nombre del estudiante en el modal
                    modal.find('#estudiantesLista').append('<li>' + nombreCompleto + '</li>');

                    // Agregar input para calificación y select para fase
                    modal.find('#calificacionesLista').append('<li>' + calificacionInput + ' ' + selectFase + '</li>');

                    // Mostrar calificación y fase anteriores
                    if (calificacion && fase) {
                        var calificacionAntigua = '<li>' + calificacion + ' (' + fase + ')</li>';
                        modal.find('#calificacionesAnteriores').append(calificacionAntigua);
                    } else {
                        modal.find('#calificacionesAnteriores').append('<li>No hay calificaciones anteriores</li>');
                    }
                } else {
                    modal.find('#estudiantesLista').append('<li>No hay estudiantes asignados.</li>');
                }
            });

            // Limpiar el modal cuando se cierra
            $('#modalCompetencias').on('hidden.bs.modal', function () {
                $(this).find('#atributoLista').empty();
                $(this).find('#estudiantesLista').empty();
                $(this).find('#calificacionesLista').empty();
                $(this).find('#calificacionesAnteriores').empty();
            });
        });
    </script>






    <script>
        $(document).ready(function () {
            $('#modalAgregarEstudiantes').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget);
                var grupo = button.data('grupo');

                var modal = $(this);

                modal.find('#nombre_grupo').eq(0).text(grupo);


            });
        });
    </script>


    <script>
        function eliminarElemento(formId, mensaje) {
            var confirm = window.confirm(mensaje);
            if (confirm == true) {
                document.getElementById(formId).submit();
            }
        }
    </script>
</body>

</html>