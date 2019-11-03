<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Fechas {

    public function arrayDay()
    {
        for($i = 1; $i <= 31; $i++){
            
            if($i <= 9){
                $dias['0'.$i] = '0'.$i;
            } else{
                $dias[$i] = $i;
            }
        }    
        
        return $dias;
    }
    
    public function arrayMonth()
    {
        $m['01'] = 'Enero';
        $m['02'] = 'Febrero';
        $m['03'] = 'Marzo';
        $m['04'] = 'Abril';
        $m['05'] = 'Mayo';
        $m['06'] = 'Junio';
        $m['07'] = 'Julio';
        $m['08'] = 'Agosto';
        $m['09'] = 'Septiembre';
        $m['10'] = 'Octubre';
        $m['11'] = 'Noviembre';
        $m['12'] = 'Diciembre';
        
        return $m;
    }
    
    public function arrayYear()
    {
        for($i = 1950; $i <= date('Y'); $i++){
            $a[$i] = $i;
        }    
        
        return $a;
    }
    
}

