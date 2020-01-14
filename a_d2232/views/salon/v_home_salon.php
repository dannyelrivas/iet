<div class="row">
    <div class="col-sm-12">
      <div class="row">
        <?php
        if(count($salidas) > 0)
        {
             for ($i=0; $i < count($salidas) ; $i++) { 
               echo "
                <div class=\"col-sm-4\">
                  <div class=\"panel panel-default\">
                    <div class=\"panel-body\">
                      <h4>Alumno: </h4>" . $salidas[$i]->nombre . " " . $salidas[$i]->apaterno . " " .$salidas[$i]->amaterno.
                      "<br><h4>Recoge: </h4>" . $salidas[$i]->recoge ."<br><a id_salida=\"" . $salidas[$i]->id . "\" class=\"btn btn-primary pull-right dar_salida\">Dar salida</a>
                    </div>
                  </div>
                </div>";
            }
        }
        else
        {
          echo "<h2>No hay salidas pendientes.</h2>";
        }
        
        ?>
      </div>


    </div>       
    </div><!--.col-->
</div><!--.row-->
