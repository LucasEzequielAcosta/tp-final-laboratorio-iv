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
<<<<<<< Updated upstream
<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container">
            <h2 class="mb-4">Agregar cine</h2>
            <form action= "<?php echo FRONT_ROOT ?>cine/addCine" method="post" class="bg-light-alpha p-5">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="">Nombre</label>
                            <input type="text" name="name" value="" class="form-control" required>
=======
        <main class="py-5">
            <section id="listado" class="mb-5">
                <div class="container">
                    <?php if ($message) { ?>
                        <h3 style="color: red;"><?php echo $message ?></h3>
                    <?php } ?>
                    <h2 class="mb-4">Agregar cine</h2>
                    <form action="<?php echo FRONT_ROOT ?>cine/addCine" method="post" class="bg-light-alpha p-5">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="">Nombre</label>
                                    <input type="text" name="name" value="" class="form-control" required>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="">Direccion</label>
                                    <input type="text" name="adress" value="" class="form-control" required>
                                </div>
                            </div>

>>>>>>> Stashed changes
                        </div>
                    </div>
                    
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="">Direccion</label>
                            <input type="text" name="adress" value="" class="form-control" required>
                        </div>
                    </div>
                    
                </div>
                <button type="submit" name="button" class="btn btn-dark ml-auto d-block">Agregar</button>

                
            </form>
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