<?php 
namespace classes\validation ;
require_once "validator.php" ;

class Str implements Validator{
    public function check($key, $value)
    {
        if(is_numeric($value)){
            return "$key Must Be String";
        }else{
            return false ;
        }
    }
}


?>