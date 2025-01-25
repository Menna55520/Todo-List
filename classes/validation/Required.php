<?php 
namespace classes\validation ;
require_once "validator.php" ;
class Required implements Validator{
    public function check($key, $value)
    {
        if(empty($value)){
            return "$key Is Required";
        }else{
            return false ;
        }
    }
}



?>