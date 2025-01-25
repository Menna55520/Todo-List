<?php 
require_once "../inc/conn.php" ;
require_once "../app.php" ;

if($request->checker($request->post('submit'))){
    $title = $request->filter($request->post('title'));
    //validation     
    $validation->validate('title',$title,['Required','Str']);
    $errors = $validation->getErrors();
    // check errors
    if(empty($errors)){
        // insert
        $sql = "insert into tasks(`title`)values(:title)";
        $res = $conn->prepare($sql);
        $res->bindParam(':title',$title,PDO::PARAM_STR);
        $out = $res->execute();
        if($out){
            $session->set('success' ,'Task Added Successfully');
            $request->redirect('../index.php');
        }else{
            $session->set('errors' ,['Error While Inserting']);
            $request->redirect('../index.php');
        }
    }else{
        $session->set('errors' ,$errors);
        $request->redirect('../index.php');
    }
}else{
    $request->redirect('../index.php') ;
}




?>