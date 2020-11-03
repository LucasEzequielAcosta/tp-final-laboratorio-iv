<?php

session_start();
if (isset($_SESSION)) {

    $currentUser = $_SESSION['loggedUser'];
    if ($currentUser->getType() == 'admin') {
        require_once('admin-nav.php');
    } elseif ($currentUser->getType() == 'client') {
        require_once('client-nav.php');
    }
}
?>
<main class="py-5">
    <div class="container">
        <h1 class="indexTitle">Cartelera</h1>
        <h2>Ver Por: </h2>
        <form>
            <label for="genres">Genero:</label>
            <select name="genre" id="genres" onChange="showResult()">
                <option value="all">Todos</option>
                <?php foreach ($genres as $genre) { ?>
                    <option value="<?= $genre->getId(); ?>"><?= $genre->getName(); ?></option>
                <?php } ?>
            </select>
            <input type="date" id="date" name="date" onChange="showResult()">

            <input type="button" id="reset" value="Reestablecer" onClick="clear()">
        </form>
        <div class="nav navbar justify-content-center">
            <form role="form" action="<?php echo FRONT_ROOT ?>movie/getByGenre?>" method="POST">
                <label class="text-light mr-3" for="genre_movie">Genero: </label>
                <select class="form-control-sm" name="genre">
                    <option value="-1">All</option>
                    <?php
                    foreach ($genreList as $genre) : ?>
                        <option value="<?php echo $genre->getGenreId(); ?>"><?php echo $genre->getGenre(); ?></option>
                    <?php endforeach; ?>
                </select>
                <button type="submit" class="btn btn-success ml-3"> Buscar </button>
            </form>
        </div>
    </div>

    <br><br>
    <section id="listado" class="mb-5">

        <div class="container">
            <h2 class="mb-4">Listado de Peliculas Actuales</h2>
            <table class="table bg-light-alpha">
                <thead>
                    <th>Poster</th>
                    <th>Titulo</th>
                    <th>Descripcion</th>
                    <th>Puntaje</th>
                </thead>
                <tbody>
                    <?php
                    foreach ($movieList as $movie) {
                    ?>
                        <tr>
                            <td><img src="<?php echo $movie->getPoster() ?>" class="img-fluid"></td>
                            <td><?php echo $movie->getTitle() ?></td>
                            <td><?php echo $movie->getDescription() ?></td>
                            <td><?php echo $movie->getRating() ?></td>
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