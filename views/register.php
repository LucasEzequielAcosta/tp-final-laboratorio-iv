<?php
require_once(VIEWS_PATH."header.php");
require_once('nav.php');
?>

<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container">
                    <?php if ($message) { ?>
                        <h3 style="color: red;"><?php echo $message ?></h3>
                    <?php } ?>
            <h1 class="mb-4">Registrarse</h1>
            
            <form action= "<?php echo FRONT_ROOT ?>user/register" method="post" class="bg-light-alpha p-5">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="">Usuario</label>
                            <input type="email" name="user" value="" class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="">Contraseña</label>
                            <input type="password" name="password" value="" class="form-control">
                        </div>
                    </div>
                </div>
                <button type="submit" name="button" class="btn btn-dark ml-auto a-block">Registrarse</button>
            </form>
            

        </div>
    </section>
</main>
<?php
require_once(VIEWS_PATH."footer.php");
?>