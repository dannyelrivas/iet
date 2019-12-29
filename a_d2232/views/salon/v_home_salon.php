<div class="row">

    <div class="col-sm-9">
      <div class="row">
        <?php
         $array_salidas = json_decode($salidas[0], true);
         print_r($array_salidas);
         for ($i=0; $i < count($array_salidas) ; $i++) { 
           echo "
           <div class=\"col-sm-4\">
             alumno: " . $salidas[$i]->nombre . " " . $salidas[$i]->apaterno . " " .$salidas[$i]->amaterno."
             recoge: " . $salidas[$i]->recoge .
             "<a class=\"btn\">Dar salida</a></div>";
        }
        
        ?>
      </div>


    </div>       

    <div class="col-sm-3">

        <h3>Ultimas Salidas</h3>

        <hr />
    </div><!--.col-->
</div><!--.row-->
