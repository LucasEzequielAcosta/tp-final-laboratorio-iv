<nav class="navbar navbar-expand-lg  navbar-dark bg-dark">
    <span class="navbar-text">
        <strong>Movie Pass</strong>
    </span>
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a class="nav-link" href="<?php echo FRONT_ROOT ?>user/showLoginView">Administrar</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?php echo FRONT_ROOT ?>movie/addNowPlayingMovies">Ver peliculas</a>
        </li>
    </ul>
</nav>


<!-- 
El administrador (A) podrá realizar las siguientes actividades:
b)Administrar cines.Cada registro debe tener el nombre del cine,su capacidad total, dirección y valor único de entrada.
El cliente (C) podrá realizar las siguientes actividades:
a) Consultar películas por fecha y/o categoría.
Revisión
1.1 - Administrar Cines (A- Item b, con dao en memoria)
1.2 - Consulta de películas actuales (C- Item a - get de la api)
-->