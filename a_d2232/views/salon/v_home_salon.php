<div class="row">

    <div class="col-sm-9">
      <div class="row">
        <?php
        echo form_open("alumnos/salida", array("id"=>"frm_usuario"));
         for ($i=0; $i < count($salidas) ; $i++) { 
          if($salidas[$i]->status==0){
           echo "
            <div class=\"col-sm-4\">
              <div class=\"panel panel-default\">
                <div class=\"panel-body\">
                  <h4>Alumno: </h4>" . $salidas[$i]->nombre . " " . $salidas[$i]->apaterno . " " .$salidas[$i]->amaterno.
                  "<br><h4>Recoge: </h4>" . $salidas[$i]->recoge ."<br><!--<a class=\"btn btn-primary pull-right\">Dar salida</a>-->";
                  echo form_submit(array("name" => "guardar","value"=>"Salida", "class"=> "btn btn-primary pull-right"));
                  echo"
                </div>
              </div>
            </div>";
          }
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
