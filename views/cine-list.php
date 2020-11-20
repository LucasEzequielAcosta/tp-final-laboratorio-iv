<?php
require_once(VIEWS_PATH."header.php");
if(isset($_SESSION))
{
    
    $currentUser= $_SESSION['loggedUser'];
    if($currentUser->getType() == 'admin')
    {
        require_once('admin-nav.php');
        require_once('cine-nav.php');
?>
<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container">
                    <?php if ($message) { ?>
                        <h3 style="color: red;"><?php echo $message ?></h3>
                    <?php } ?>
            <h2 class="mb-4">Listado de cines</h2>
            <table class="table bg-light-alpha table-striped">
                <thead>
                    <th>Nombre</th>
                    <th>Capacidad</th>
                    <th>Direccion</th>                    
                    <th>Opciones</th>
                </thead>
                <tbody>
                    <?php
                    foreach ($cineList as $cine) {
                    ?>
                        <tr>
                            <td><?php echo $cine->getName() ?></td>
                            <td><?php echo ($capacidad[$cine->getName()] == null) ? 'N/A' : ($capacidad[$cine->getName()]);  ?></td>
                            <td><?php echo $cine->getadress() ?></td>                                                       
                            <td>
                            
                                <form action="<?php echo FRONT_ROOT ?>cine/Delete" method="post">
                                    <button type="submit" name="<?php echo $cine->getName(); ?>" value="<?php echo $cine->getName(); ?>">
                                        <img width="20" height="20" src="<?php echo IMG_PATH ?>delete.png" alt="Eliminar_Cine">
                                    </button>
                                </form>
                                
                                    <button onclick="openNav<?php echo $cine->getName(); ?>()">
                                        <img width="20" height="20" src="<?php echo IMG_PATH ?>modify.png" alt="Modificar_Cine">
                                    </button>

                                    <div id="myNav<?php echo $cine->getName(); ?>" class="overlay">
                                        <a href="javascript:void(0)" class="closebtn" onclick="closeNav<?php echo $cine->getName(); ?>()">&times;</a>
                                        <div class="overlay-content">
                                        <h1 style="color:white"><strong>Modificar <?php echo $cine->getName(); ?></strong></h1>
                                            <form action="<?php echo FRONT_ROOT ?>cine/Modify" method="post">
                                            <section id="listado" class="mb-5">
                                            <div class="container">
                                                <input type="hidden" name="idName" value="<?php echo $cine->getName(); ?>">

                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label style="color:white" for="">Nombre</label>
                                                            <input type="text" name="name" value="<?php echo $cine->getName(); ?>" class="form-control" required>
                                                        </div>
                                                    </div>                                                    
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label style="color:white" for="">Direccion</label>
                                                            <input type="text" name="adress" value="<?php echo $cine->getadress() ?>" class="form-control" required>
                                                        </div>
                                                    </div>                                                    
                                                </div>
                                                <button type="submit" name="button" class="btn btn-dark ml-auto d-block" onclick="closeNav<?php echo $cine->getName(); ?>()" href="javascript:void(0)">Modificar</button>
                                            </div>
                                            </section>
                                            </form>
                                        </div>
                                    </div>

                                    <script>
                                        function openNav<?php echo $cine->getName(); ?>() {
                                            document.getElementById("myNav<?php echo $cine->getName(); ?>").style.width = "100%";
                                        }

                                        function closeNav<?php echo $cine->getName(); ?>() {
                                            document.getElementById("myNav<?php echo $cine->getName(); ?>").style.width = "0%";
                                        }
                                    </script>                                
                            </td>                            
                        </tr>
                    <?php
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

    else
    {
        require_once(VIEWS_PATH.'nav.php');
        require_once(VIEWS_PATH.'login.php');
    }
}
require_once(VIEWS_PATH."footer.php");
?>