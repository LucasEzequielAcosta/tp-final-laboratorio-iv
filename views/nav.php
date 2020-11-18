<?php
require_once(VIEWS_PATH."header.php");
?>
<nav class="navbar navbar-expand-lg  navbar-dark bg-dark">
    <span class="navbar-text">
        <strong>Movie Pass</strong>
    </span>
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a class="nav-link" href="<?php echo FRONT_ROOT ?>user/showLoginView">Iniciar sesion</a>
        </li>     
        <li class="nav-item">
            <a class="nav-link" href="<?php echo FRONT_ROOT ?>user/showRegisterView">Registrarse</a>
        </li>
    </ul>
</nav>
<?php
require_once(VIEWS_PATH."footer.php");
?>
