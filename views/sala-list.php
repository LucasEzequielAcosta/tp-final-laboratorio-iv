<?php
if(isset($_SESSION))
{
    
    $currentUser= $_SESSION['loggedUser'];
    if($currentUser->getType() == 'admin')
    {
        require_once('admin-nav.php');
        require_once('cine-nav.php');
?>
<main class="py-5">
    <h1>Administración de Salas</h1>
    
    <?php foreach($cineList as $cine) { ?>
    
    <section id="listado" class="mb-5">
        <div class="container">
            <h3 class="mb-4"><?php echo $cine->getName(); ?>
            <button onclick="openAddNav<?php echo $cine->getName(); ?>()">
                                        <img width="20" height="20" src="<?php echo IMG_PATH ?>add.png" alt="Agregar_Sala">
                                    </button>

                                    <div id="addNav<?php echo $cine->getName(); ?>" class="overlay">
                                        <a href="javascript:void(0)" class="closebtn" onclick="closeAddNav<?php echo $cine->getName(); ?>()">&times;</a>
                                        <div class="overlay-content">
                                        <h1 style="color:white"><strong>Agregar sala al cine  <?php echo $cine->getName(); ?></strong></h1>
                                            <form action="<?php echo FRONT_ROOT ?>sala/Add" method="post">
                                            <section id="listado" class="mb-5">
                                            <div class="container">
                                                <input type="hidden" name="cineName" value="<?php echo $cine->getName(); ?>">                                                

                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label style="color:white" for="">Nombre</label>
                                                            <input type="text" name="nombre" value="" class="form-control">
                                                        </div>
                                                    </div>                                                    
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label style="color:white" for="">Capacidad</label>
                                                            <input type="text" name="capacidad" value="" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label style="color:white" for="">Precio</label>
                                                            <input type="text" name="precio" value="" class="form-control">
                                                        </div>
                                                    </div>                                                   
                                                </div>
                                                <button type="submit" name="button" class="btn btn-dark ml-auto d-block" onclick="closeAddNav<?php echo $cine->getName(); ?>()" href="javascript:void(0)">Agregar</button>
                                            </div>
                                            </section>
                                            </form>
                                        </div>
                                    </div>

                                    <script>
                                        function openAddNav<?php echo $cine->getName(); ?>() {
                                            document.getElementById("addNav<?php echo $cine->getName(); ?>").style.width = "100%";
                                        }

                                        function closeAddNav<?php echo $cine->getName(); ?>() {
                                            document.getElementById("addNav<?php echo $cine->getName(); ?>").style.width = "0%";
                                        }
                                    </script>
            
            </h3>
                                  
            <table class="table bg-light-alpha">
                <thead>                    
                    <th>Nombre Sala</th>
                    <th>Capacidad</th>
                    <th>Precio</th>                    
                    <th>Opciones</th>
                </thead>
                <tbody>
                    <?php
                    foreach ($salaList as $sala) {
                        if($sala->getCine() == $cine->getName())
                        {
                            
                    ?>
                        <tr>
                            <td><?php echo $sala->getName(); ?></td>
                            <td><?php echo $sala->getCapacity();  ?></td>
                            <td><?php echo $sala->getPrice(); ?></td>                                                       
                            <td>
                            
                                <form action="<?php echo FRONT_ROOT ?>sala/Delete" method="post">
                                    <button type="submit" name="<?php echo $sala->getName(); ?>" value="<?php echo $sala->getName(); ?>">
                                        <img width="20" height="20" src="<?php echo IMG_PATH ?>delete.png" alt="Eliminar_Sala">
                                    </button>
                                </form>
                                
                                    <button onclick="openModNav<?php echo $sala->getName(); ?>()">
                                        <img width="20" height="20" src="<?php echo IMG_PATH ?>modify.png" alt="Modificar_Sala">
                                    </button>

                                    <div id="modNav<?php echo $sala->getName(); ?>" class="overlay">
                                        <a href="javascript:void(0)" class="closebtn" onclick="closeModNav<?php echo $sala->getName(); ?>()">&times;</a>
                                        <div class="overlay-content">
                                        <h1 style="color:white"><strong>Modificar Sala  <?php echo $sala->getName(); ?></strong></h1>
                                            <form action="<?php echo FRONT_ROOT ?>sala/Modify" method="post">
                                            <section id="listado" class="mb-5">
                                            <div class="container">
                                                <input type="hidden" name="idName" value="<?php echo $sala->getName(); ?>">

                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label style="color:white" for="">Nombre</label>
                                                            <input type="text" name="nombre" value="<?php echo $sala->getName(); ?>" class="form-control">
                                                        </div>
                                                    </div>                                                    
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label style="color:white" for="">Capacidad</label>
                                                            <input type="text" name="capacidad" value="<?php echo $sala->getCapacity() ?>" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label style="color:white" for="">Precio</label>
                                                            <input type="text" name="precio" value="<?php echo $sala->getPrice() ?>" class="form-control">
                                                        </div>
                                                    </div>                                                   
                                                </div>
                                                <button type="submit" name="button" class="btn btn-dark ml-auto d-block" onclick="closeModNav<?php echo $sala->getName(); ?>()" href="javascript:void(0)">Modificar</button>
                                            </div>
                                            </section>
                                            </form>
                                        </div>
                                    </div>

                                    <script>
                                        function openModNav<?php echo $sala->getName(); ?>() {
                                            document.getElementById("modNav<?php echo $sala->getName(); ?>").style.width = "100%";
                                        }

                                        function closeModNav<?php echo $sala->getName(); ?>() {
                                            document.getElementById("modNav<?php echo $sala->getName(); ?>").style.width = "0%";
                                        }
                                    </script>

                                                                   
                            </td>                            
                        </tr>
                    <?php
                        }
                    }
                    ?>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>
</main>

<?php
    }
}

    else
    {
        require_once(VIEWS_PATH.'nav.php');
        require_once(VIEWS_PATH.'login.php');
              
    }
}


?>