<?php
require_once(VIEWS_PATH . "header.php");
session_start();

if (isset($_SESSION)) {

    $currentUser = $_SESSION['loggedUser'];
    if ($currentUser->getType() == 'admin') {
        require_once('admin-nav.php');

?>
        <main class="py-5">
            <div class="container">
                    <?php if ($message) { ?>
                        <h3 style="color: red;"><?php echo $message ?></h3>
                    <?php } ?>
                <div class="nav navbar justify-content-center">
                    <form role="form" action="<?php echo FRONT_ROOT ?>movie/getMoviesByGenre" method="POST">
                        <label class="text-light mr-3" for="genre_movie">Genero: </label>
                        <select class="form-control-sm" name="genre">
                            <option value=-1>Todas</option>
                            <?php
                            foreach ($genreList as $genre) : ?>
                                <option value="<?php echo $genre->getGenreId(); ?>"><?php echo $genre->getGenre(); ?></option>
                            <?php endforeach; ?>
                        </select>
                        <button type="submit" class="btn btn-success ml-3" name="<?php echo $genre->getGenreId(); ?>"> Buscar </button>
                    </form>
                </div>
            </div>

            <br><br>
            <section id="listado" class="mb-5">
                <div class="container">
                    <h2 class="mb-4">Listado de Peliculas <?php if ($genreId) echo ($genreId != -1) ? "de " . $this->genreDao->getGenreById($genreId) : " "; ?></h2>
                    <table class="table bg-light-alpha table-striped">
                        <thead>
                            <th>Poster</th>
                            <th>Titulo</th>
                            <th>Descripcion</th>
                            <th>Puntaje</th>
                            <th>Duracion</th>
                            <th></th>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($movieList as $movie) {
                            ?>
                                <tr>
                                    <td><img src="<?php echo $movie->getPoster() ?>" class="img-thumbnail"></td>
                                    <td><?php echo $movie->getTitle() ?></td>
                                    <td><?php echo $movie->getDescription() ?></td>
                                    <td><?php echo $movie->getRating() ?></td>
                                    <td><?php echo $movie->getRuntime() ?> min</td>
                                    <td>
                                        <form action="<?php echo FRONT_ROOT ?>funcion/createMovieShow" method="POST">
                                            <button type="submit" class="btn btn-success ml-3" name="<?php echo $movie->getId(); ?>" value="<?php echo $movie->getId(); ?>">
                                                Agregar a cartelera
                                            </button>
                                        </form>

                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </section>
        </main>
<?php
    } elseif ($currentUser->getType() == 'client') {
        require_once('client-nav.php');
        require_once(VIEWS_PATH . 'funcion-list');
    }
}
require_once(VIEWS_PATH . "footer.php");
?>