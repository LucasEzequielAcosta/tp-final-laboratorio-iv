<?php
require_once(VIEWS_PATH."header.php");
?>
<nav class="navbar navbar-expand-lg  navbar-dark bg-dark">
    <span class="navbar-text">
        <strong>Movie Pass</strong> --- <strong style='color:lightgreen;'><?php echo $_SESSION['loggedUser']->getUser(); ?></strong>
    </span>
    <ul class="navbar-nav ml-auto">

        <li class="nav-item">
            <a class="nav-link" href="<?php echo FRONT_ROOT ?>compra/ticketsByUser">Mis Entradas</a>
        </li>
        
        <li class="nav-item">
            <a class="nav-link" href="<?php echo FRONT_ROOT ?>home/homeUser">Cartelera</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="<?php echo FRONT_ROOT ?>user/logOut">Cerrar sesion</a>
        </li>

    </ul>
</nav>
<?php
require_once(VIEWS_PATH."footer.php");
?>