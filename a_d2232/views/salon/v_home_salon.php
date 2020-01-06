<div class="row">
    <div class="col-sm-9">
      <div class="row">
        <?php
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
        
        ?>
      </div>


    </div>       

    <div class="col-sm-3">

        <h3>Ultimas Salidas</h3>
    </div>
        <hr />
    </div><!--.col-->
</div><!--.row-->
