<?php
require_once(VIEWS_PATH."header.php");
?>
<nav class="navbar navbar-expand-lg  navbar-light" style="background-color: #e3f2fd;">
    <span class="navbar-text">
        <strong></strong>
    </span>
    <ul class="navbar-nav ml-auto">        
        <li class="nav-item">
            <a class="nav-link" href="<?php echo FRONT_ROOT ?>cine/showAddView"><strong>Agregar Cines</strong></a>
        </li>        

        <li class="nav-item">
            <a class="nav-link" href="<?php echo FRONT_ROOT ?>cine/showListView"><strong>Ver/Modificar Cines</strong></a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="<?php echo FRONT_ROOT ?>sala/showSalaView"><strong>Administrar Salas</strong></a>
        </li> 
    </ul>
</nav>
<?php
require_once(VIEWS_PATH."footer.php");
?>