<?php 
namespace classes ;
class Session{
    public function __construct()
    {
        session_start();
    }
    public function set($key,$value){
        $_SESSION[$key] = $value ;
    }
    public function get($key){
        if(isset($_SESSION[$key])){
            return $_SESSION[$key];
        }else{
            return false; 
        }
    }
    public function unset($key){
        if(isset($_SESSION[$key])){
            unset($_SESSION[$key]);
        }else{
            return false; 
        }
    }
}



?>