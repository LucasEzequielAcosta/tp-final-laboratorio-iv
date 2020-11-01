<?php
if(isset($_SESSION))
{
    
    $currentUser= $_SESSION['loggedUser'];
    if($currentUser->getType() == 'admin')
    {
        require_once('admin-nav.php');
?>
<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container">
            <h2 class="mb-4">Listado de cines</h2>
            <table class="table bg-light-alpha">
                <thead>
                    <th>Nombre</th>
                    <th>Capacidad</th>
                    <th>Direccion</th>
                    <th>Precio</th>
                    <th>Opciones</th>
                </thead>
                <tbody>
                    <?php
                    foreach ($cineList as $cine) {
                    ?>
                        <tr>
                            <td><?php echo $cine->getName() ?></td>
                            <td><?php echo $cine->getCapacity() ?></td>
                            <td><?php echo $cine->getadress() ?></td>
                            <td><?php echo $cine->getPrice() ?></td>                            
                            <td>
                            
                                <form action="<?php echo FRONT_ROOT ?>cine/Delete" method="post">
                                    <button type="submit" name="<?php echo $cine->getName(); ?>" value="<?php echo $cine->getName(); ?>">
                                        <img width="20" height="20" src="<?php echo IMG_PATH ?>delete.png" alt="Eliminar_Cine">
                                    </button>
                                </form>
                                
                                    <button onclick="openNav()">
                                        <img width="20" height="20" src="<?php echo IMG_PATH ?>modify.png" alt="Modificar_Cine">
                                    </button>

                                    <div id="myNav" class="overlay">
                                        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                                        <div class="overlay-content">
                                            <form action="<?php echo FRONT_ROOT ?>cine/Modify" method="post">
                                            <section id="listado" class="mb-5">
                                            <div class="container">
                                                <input type="hidden" name="idName" value="<?php echo $cine->getName(); ?>">

                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label style="color:white" for="">Nombre</label>
                                                            <input type="text" name="name" value="<?php echo $cine->getName(); ?>" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label style="color:white" for="">Capacidad</label>
                                                            <input type="text" name="capacity" value="<?php echo $cine->getCapacity() ?>" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label style="color:white" for="">Direccion</label>
                                                            <input type="text" name="adress" value="<?php echo $cine->getadress() ?>" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label style="color:white" for="">Precio</label>
                                                            <input type="text" name="price" value="<?php echo $cine->getPrice() ?>" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                                <button type="submit" name="button" class="btn btn-dark ml-auto d-block" onclick="closeNav()" href="javascript:void(0)">Modificar</button>
                                            </div>
                                            </section>
                                            </form>
                                        </div>
                                    </div>

                                    <script>
                                        function openNav() {
                                            document.getElementById("myNav").style.width = "100%";
                                        }

                                        function closeNav() {
                                            document.getElementById("myNav").style.width = "0%";
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
?>