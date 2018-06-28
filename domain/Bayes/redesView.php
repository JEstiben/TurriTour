<?php
	include_once('header.php');
?>
<!-- banner -->
  <div class="courses_banner">
  	<div class="container">
  		<h3>Redes</h3>
  		<p class="description">
             Uso de distancia Euclidiana para aporximar según información previamente recolectada en una base de datos la clase de una red (A o B) según una seria de datos solicitados.
        </p>
        <div class="breadcrumb1">
            <ul>
                <li class="icon6"><a href="../index.php">Home</a></li>
                <li class="current-page">Redes</li>
            </ul>
        </div>
  	</div>
  </div>
<!-- //banner -->
	<div class="admission">
	   	<div class="container">
	   	  	<h1>Instrucciones</h1>
	   	  	<p>Se debe ingresar la Fiabilidad de la red sobre la que se quiere conocer su clase además de la cantidad de enlaces que posee, la capacidad que posee esa red como tal y el costo de la misma.
            </p>
	   	  	<div class="col-md-6 admission_left">
	   	  		<h2>Información</h2>
	   	  		<form method="post" action="../controller/redesController.php">
             		<div class="select-block1">
             		<h4>Fiablidad</h4>
                		<select id="fiabilidad" name="fiabilidad">
                    		<option value="2">2</option>
    	                	<option value="3">3</option>
    	                	<option value="4">4</option>
    	                	<option value="5">5</option>
               		</select>
             		</div>
             		<div class="select-block1">
             		<h4>Catidad de enlaces</h4>
                		<select id="enlaces" name="enlaces">
                    		<option value="7">7</option>
    	                	<option value="8">8</option>
    	                	<option value="9">9</option>
    	                	<option value="10">10</option>
    	                	<option value="11">11</option>
    	                	<option value="12">12</option>
    	                	<option value="13">13</option>
    	                	<option value="14">14</option>
    	                	<option value="15">15</option>
    	                	<option value="16">16</option>
    	                	<option value="17">17</option>
    	                	<option value="18">18</option>
    	                	<option value="19">19</option>
    	                	<option value="20">20</option>
               		</select>
             		</div>
             		<div class="select-block1">
             		<h4>Capacidad de la red</h4>
                		<select name="capacidad" id="capacidad">
	                    	<option value="1">Baja</option>
    	                	<option value="2">Promedia</option>
    	                	<option value="3">Alta</option>
               		</select>
             		</div>
             		<div class="select-block1">
             		<h4>Costo de la red</h4>
                		<select id="costo" name="costo">
	                    	<option value="1">Bajo</option>
    	                	<option value="2">Medio</option>
    	                	<option value="3">Alto</option>
               		</select>
             		</div>
             	<input type="submit" value="Calcular" name="calcular" id="calcular" class="course-submit">
             	</form>
             	</div>
            	<div class="col-md-6 admission_right">
              		<h3>La red es de clase ...</h3>
                    <form>
                        <div class="input-group input-group1">

                    <?php
                    if (isset($_GET['error'])) {
                      $recibido = $_GET['error'];
                      echo "<h4>Error".$recibido."</h4>";
                        
                    } else if (isset($_GET['success'])) {
                      $recibido = $_GET['success'];
                      $recibido = substr($recibido, 0, -1);
                        $datos = explode(";",$recibido);
                        $num = 0;

                        $maximo = -10;
                        $clasemax = "";
                        foreach ($datos as $dato) {
                            $valores = explode("?",$dato);

                            if($valores[1] > $maximo){
                                $clasemax = $valores[0];
                                $maximo = $valores[1];
                            }//if

                            
                        }//foreach


                        echo "<h4>".$clasemax."</h4>";
                        echo "<h4>Probabilidad Total: ".$maximo."</h4>";

                        echo "<h4>-------------------------------------------------------</h4>";
                        echo "<h4>Resultados</h4>";

                        foreach ($datos as $dato) {
                            $valores = explode("?",$dato);
                                echo "<h3>Clase: ".$valores[0]."</h3>";
                                echo "<h3>Probabilidad Total: ".$valores[1]."</h3> <br>";
                            
                        }//foreach
                    }//else if
                    ?>
                        <!--<input class="form-control has-dark-background" readonly="readonly" name="resultado" id="resultado" placeholder="Su recinto es..." type="text">-->
	   	   		      </div>               
                    </form> 
                </div>
            <div class="clearfix"> </div>
        </div>
    </div>

<?php
	include_once('footer.php');
?>