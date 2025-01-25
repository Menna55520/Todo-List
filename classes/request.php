<?php 
namespace classes ;
class Request{
    public function get($key){
        if(isset($_GET[$key])){
            return $_GET[$key];
        }else{
            return false ;
        }
    }
    public function post($key){
        if(isset($_POST[$key])){
            return $_POST[$key];
        }else{
            return false ;
        }
    }
    public function filter($data){
        return htmlspecialchars(trim($data));
    }
    public function redirect($path){
        header("location:$path");
    }
    public function checker($data){
        return isset($data);
    }
}





?>