<?php
require_once(VIEWS_PATH . "header.php");

if (isset($_SESSION)) {

    $currentUser = $_SESSION['loggedUser'];
    if ($currentUser->getType() == 'admin') {
        require_once(VIEWS_PATH . 'admin-nav.php');
        require_once(VIEWS_PATH . 'sales-nav.php');


?>
        <main class="py-5">
            <section id="listado" class="mb-5">
                <div class="container">
                    <?php if ($message) { ?>
                        <h3 style="color: red;"><?php echo $message ?></h3>
                    <?php } ?>
                    <h2 class="mb-4">Ventas totales entre fechas</h2>

                    <form action="<?php echo FRONT_ROOT ?>compra/verificarRangoFechas" method="post">
                        <input type="date" name="fechaInicio" min="<?php echo $min; ?>" max="<?php echo $max; ?>" required> Fecha inicial
                        <br>
                        <br>
                        <input type="date" name="fechaFinal" min="<?php echo $min; ?>" max="<?php echo $max; ?>" required> Fecha final
                        <br>
                        <br>
                        <button type="submit" class="btn btn-success ml-3">Ver total</button>
                    </form>
                    <br>

                    <?php if ($_POST) { ?>
                        <table class="table bg-light-alpha table-striped">
                            <thead>
                                <th>Fechas</th>
                                <th> </th>
                                <th>Total</th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><?php echo $_POST['fechaInicio']. " / " .$_POST['fechaFinal'] ?></td>

                                    <td></td>

                                    <td>
                                        <?php
                                            echo '<strong>$</strong>' . $total;
                                        ?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    <?php
                    }
                    ?>
                </div>
            </section>
        </main>

<?php
        require_once(VIEWS_PATH . "footer.php");
    } else {
        require_once(VIEWS_PATH . 'nav.php');
        require_once(VIEWS_PATH . 'login.php');
    }
}
?>