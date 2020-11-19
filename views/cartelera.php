<?php
require_once(VIEWS_PATH . "header.php");

if (isset($_SESSION)) {

    $currentUser = $_SESSION['loggedUser'];
    if ($currentUser->getType() == 'client') {
        require_once(VIEWS_PATH . 'client-nav.php');
    }
}
?>
<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container">
            <h2 class="mb-4">Cartelera</h2>
<<<<<<< Updated upstream
            <div class="nav navbar justify-content-center">
                <form role="form" action="<?php echo FRONT_ROOT ?>funcion/getFunctionsByGenre?>" method="POST">
                    <label class="text-light mr-3" for="genre_movie">Genero: </label>
                    <select class="form-control-sm" name="genre">
                        <option value=-1>Todas</option>
=======
            <div class="row">
                <div class="col-sm">
                    <form role="form" action="<?php echo FRONT_ROOT ?>funcion/getFunctionsByGenre?>" method="POST">
                        <label class="text-light mr-3" for="genre_movie">Genero: </label>
                        <select class="form-control-sm" name="genre">
                            <option value=-1>Todas</option>
                            <?php
                            foreach ($genreList as $genre) : ?>
                                <option name="genreId" value="<?php echo $genre->getGenreId(); ?>"><?php echo $genre->getGenre(); ?></option>
                            <?php endforeach; ?>
                        </select>
                        <button type="submit" class="btn btn-success ml-3"> Buscar </button>
                    </form>
                </div>
                <div class="col-sm">
                    <div class="nav navbar justify-content-center">
                        <form role="form" action="<?php echo FRONT_ROOT ?>funcion/filterFunctionsByDate?>" method="POST">
                            <input type="date" name="date" min="<?php echo $today; ?>" max="<?php echo $max; ?>" required>
                            <button type="submit" class="btn btn-success ml-3"> Buscar </button>
                        </form>
                    </div>
                </div>

                <table class="table bg-light-alpha">
                    <thead>
                        <th>Cine</th>
                        <th>Sala</th>
                        <th>Película</th>
                        <th>Dia</th>
                        <th>Horario</th>
                        <th>Opciones</th>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($funcionList as $funcion) {
                            $originalDate = $funcion->getFecha();
                            $originalHour = $funcion->getHorario();
                        ?>
                            <tr>
                                <td><?php echo $funcion->getCine() ?></td>
                                <td><?php echo $funcion->getNombreSala() ?></td>
                                <td><?php echo $this->movieDao->getMovieById($funcion->getIdMovie())->getTitle();  ?></td>
                                <td><?php echo date("d/m/Y", strtotime($originalDate)); ?></td>
                                <td><?php echo date("H:i A", strtotime($originalHour)); ?></td>
                                <td>
                                    <form action="<?php echo FRONT_ROOT ?>compra/BuyView" method="POST">
                                        <input type="hidden" name="movieName" value="<?php echo $this->movieDao->getMovieById($funcion->getIdMovie())->getTitle(); ?>">
                                        <button type="submit" class="btn btn-success ml-3" name="idFuncion" value="<?php echo $funcion->getIdFuncion(); ?>">
                                            Comprar
                                        </button>
                                    </form>
                                </td>
                            </tr>
>>>>>>> Stashed changes
                        <?php
                        foreach ($genreList as $genre) : ?>
                            <option name="genreId" value="<?php echo $genre->getGenreId(); ?>"><?php echo $genre->getGenre(); ?></option>
                        <?php endforeach; ?>
                    </select>
                    <button type="submit" class="btn btn-success ml-3"> Buscar </button>
                </form>
            </div>
            <table class="table bg-light-alpha">
                <thead>
                    <th>Cine</th>
                    <th>Sala</th>
                    <th>Película</th>
                    <th>Dia</th>
                    <th>Horario</th>
                    <th>Opciones</th>
                </thead>
                <tbody>
                    <?php
                    foreach ($funcionList as $funcion) {
                        $originalDate = $funcion->getFecha();
                        $newDate = date("d/m/Y", strtotime($originalDate));
                    ?>
                        <tr>
                            <td><?php echo $funcion->getCine() ?></td>
                            <td><?php echo $funcion->getNombreSala() ?></td>
                            <td><?php echo $this->movieDao->getMovieById($funcion->getIdMovie());  ?></td>
                            <td><?php echo $newDate ?></td>
                            <td><?php echo $funcion->getHorario() ?></td>
                            <td>
                                <form action="<?php echo FRONT_ROOT ?>compra/BuyView" method="POST">
                                <input type="hidden" name="movieName" value="<?php echo $this->movieDao->getMovieById($funcion->getIdMovie()); ?>">
                                    <button type="submit" class="btn btn-success ml-3" name="idFuncion" value="<?php echo $funcion->getIdFuncion(); ?>">
                                        Comprar
                                    </button>
                                </form>
                            </td>
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

<?php
require_once(VIEWS_PATH . "footer.php");
?>