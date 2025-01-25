<?php 
namespace classes\validation ;
require_once "Required.php" ;
require_once "Str.php" ;

class Validation{
    private $errors = [] ;
    public function validate($key,$value,$roles){
        foreach($roles as $role){
            $role = "classes\\validation\\".$role ;
            $obj = new $role ;
            $res = $obj->check($key , $value);
            if($res){
                $this->errors[] = $res ;
            }
        }
    }
    public function getErrors(){
        return $this->errors ;
    }
}



?>