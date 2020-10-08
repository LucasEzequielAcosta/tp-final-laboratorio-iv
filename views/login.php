<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
        require_once('nav.php');
    ?>
    <main class="py-5">
        <section id="listado" class="mb-5">
            <div class="container">
                <h2 class="mb-4">Agregar alumno</h2>
                <form action="<?php echo FRONT_ROOT ?>Student/Add" method="post" class="bg-light-alpha p-5">
                        <div class="row">                         
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="">Legajo</label>
                                    <input type="text" name="recordId" value="" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="">Nombre</label>
                                    <input type="text" name="firstName" value="" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="">Apellido</label>
                                    <input type="text" name="lastName" value="" class="form-control">
                                </div>
                            </div>
                        </div>
                        <button type="submit" name="button" class="btn btn-dark ml-auto d-block">Agregar</button>
                </form>
            </div>
        </section>
    </main>

</body>

</html>





<!-- 
El administrador (A) podrá realizar las siguientes actividades:

b)Administrar cines.Cada registro debe tener el nombre del cine,su capacidad total, dirección y valor único de entrada.

El cliente (C) podrá realizar las siguientes actividades:

a) Consultar películas por fecha y/o categoría.

Revisión
1.1 - Administrar Cines (A- Item b, con dao en memoria)
1.2 - Consulta de películas actuales (C- Item a - get de la api)
-->