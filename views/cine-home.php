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
            <h2 class="mb-4">Administración de Cines</h2>
            <br>
            <h6 class="mb-1">Bienvenido, <strong><?php echo $currentUser->getUser(); ?></strong>.
            <br><br>
            Seleccione una opción en la segunda barra de navegación para comenzar a administrar cines.</h6>
            
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