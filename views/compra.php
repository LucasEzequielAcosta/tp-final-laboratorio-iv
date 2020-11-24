<?php
require_once(VIEWS_PATH . "header.php");

if (isset($_SESSION)) {

    $currentUser = $_SESSION['loggedUser'];
    if ($currentUser->getType() == 'client') {
        require_once(VIEWS_PATH . 'client-nav.php');
        $today = date("Y-n-d");
    }
}
?>
<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container">
                    <?php if ($message) { ?>
                        <h3 style="color: red;"><?php echo $message ?></h3>
                    <?php } $plata= 0; ?>
            <h2 class="mb-4">Comprar</h2>
            
            <table class="table bg-light-alpha table-striped">
                <thead>
                    <th>Cine</th>
                    <th>Sala</th>
                    <th>Película</th>
                    <th>Dia</th>
                    <th>Horario</th>
                    <th>Cantidad de Entradas</th>
                    <th>Precio</th>
                </thead>
                <tbody>
                    <?php
                    foreach ($funcionList as $funcion) {
                        if($idFuncion == $funcion->getIdFuncion())
                        {
                        $originalDate = $funcion->getFecha();
                        $newDate = date("d/m/Y", strtotime($originalDate));
                    ?>
                        <tr>
                            <td><?php echo $funcion->getCine() ?></td>
                            <td><?php echo $funcion->getNombreSala() ?></td>
                            <td><?php echo $movieName  ?></td>
                            <td><?php echo $newDate ?></td>
                            <td><?php echo $funcion->getHorario() ?></td>
                            <td><?php echo $cantidad; ?></td>
                            <td><strong>$</strong><?php foreach ($salaList as $sala){
                                if($funcion->getNombreSala() == $sala->getName())
                                {    echo ($sala->getPrice() * $cantidad); $plata= $sala->getPrice() * $cantidad; }
                            }  ?></td>
                        </tr>
                    <?php
                    }
                }
                    ?>
                    </tr>
                </tbody>
            </table>            
            
            
            

            <button onclick="openNav()" class="btn btn-success ml-3" name="myNav" value="myNav">
                Ir al Pago
            </button>

                <div id="myNav" class="overlay">
                    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                    
                    <div class="overlay-content">
                    <img src="<?php echo IMG_PATH?>gimme_money.png" alt="platita" style='display: inline-block;' class='col-lg-offset-4'>
                    <br><br>
                        <div class='col-lg-offset-4 payDiv'>                           
                            <form action="<?php echo FRONT_ROOT ?>pago/makePayment" method="post">
                                <section id="listado" class="mb-5">
                                    <div class="container">
                                        
                                            <div class="row">
                                                <div class="col-lg-6">
                                                <label for="">E-mail</label>
                                                <input type="userEmail" name="email" value="" class="form-control" required>
                                                </div>
                                                
                                                <div class="col-lg-6">   
                                                <label for="">Nombre completo</label>
                                                <input type="text" name="userName" value="" class="form-control" required>
                                                </div>
                                            </div>                                            
                                            <br>
                                            <div class="row">  
                                                
                                                <div class="col-lg-6">
                                                <label for="">Número de la Tarjeta</label>
                                                <input type="text" pattern="[0-9]{16}" placeholder='0000-0000-0000-0000' id='card' name="cardNum" value="" class="form-control" style='text-align: center;' maxlength='16' required>
                                                </div>

                                                <div class='col-lg-2'>
                                                <label for="">CCV</label>
                                                <input type="password" pattern="[0-9]{3}" name="ccv" value="" class="form-control" placeholder='XXX' style='text-align: center;' maxlength='3' required>
                                                </div>
                                                
                                                <div class="col-lg-4">                                            
                                                <label for="">Proveedor</label>                                                
                                                <select class="form-control" required name="prov" id="prov" onchange="changeCard()">
                                                <option value="visa">VISA</option>
                                                <option value="master">MasterCard</option>                                                
                                                </select>
                                                </div> 
                                            </div>
                                            <br>
                                                                                        
                                                

                                                                                              
                                                
                                                
                                            
                                            <br>
                                            <br>
                                            
                                    </div>
                                </section>
                                            
                                            <input type="hidden" name="movieName" value="<?php echo $movieName; ?>">
                                            <input type="hidden" name="idFunc" value="<?php echo $idFuncion; ?>">            
                                            <input type="hidden" name="precio" value="<?php echo $plata; ?>">                        
                                            <input type="hidden" name="cantidadEntradas" value="<?php echo $cantidad; ?>">
                                            <button type="submit" name="button" class="btn btn-dark ml-auto d-block" href="javascript:void(0)">Confirmar</button>
                            </form>
                        </div>
                        </div>
                    </div>

                    <script>
                        function openNav() {
                            document.getElementById("myNav").style.width = "100%";
                        }

                        function closeNav() {
                            document.getElementById("myNav").style.width = "0%";
                        }                        
                    </script>
            
        </div>
    </section>
</main>

<?php
require_once(VIEWS_PATH . "footer.php");
?>