<?php
    require_once(VIEWS_PATH."header.php");

    if(isset($_SESSION))
    {
        
        
        $currentUser= $_SESSION['loggedUser'];
        if($currentUser->getType() == 'admin')
        {
            require_once('admin-nav.php');
        }
        elseif($currentUser->getType() == 'client')
        {
            require_once('client-nav.php');        
        }
?>

<main class="py-5">
    <div class="container">
        <h2 class="mb-4"><?php echo $currentUser->getUser(); ?></h2>
        <br>
        <strong>Su categoría es: <?php switch($currentUser->getType()) {case "admin": echo 'Administrador'; break; case "client": echo 'Cliente'; break; } ?></strong>
    </div>
</main>

<?php
    
    }

    else
    {
        require_once(VIEWS_PATH.'nav.php');
        require_once(VIEWS_PATH.'login.php');
        
    }
    require_once(VIEWS_PATH."footer.php");
?>