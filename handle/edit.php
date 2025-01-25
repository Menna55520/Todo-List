<?php 
require_once "../inc/conn.php" ;
require_once "../app.php" ;
if($request->get('id') && $request->checker($request->post('submit')) ){
    $id = $request->filter($request->get('id'));
    $title = $request->filter($request->post('title'));
    // validation
    $validation->validate('title',$title,['Required','Str']);
    $errors = $validation->getErrors();
    if(empty($errors)){
        // select one
        $sql = "select id from tasks where id=:id" ;
        $res = $conn->prepare($sql) ;
        $res->bindParam(':id',$id,PDO::PARAM_INT);
        $res->execute() ;
        $data = $res->fetchColumn();
        if($data){
            // update
            $sql = "update tasks set `title`=:title where id=:id" ;
            $res = $conn->prepare($sql) ;
            $res->bindParam(':title',$title,PDO::PARAM_STR);
            $res->bindParam(':id',$id,PDO::PARAM_INT);
            $out = $res->execute() ;
            if($out){
                $session->set('success','Data Updated Successfully');
                $request->redirect('../index.php');
            }else{
                $session->set('errors',['Error while Updating']);
                $request->redirect("../edit.php?id=$id") ;
            }

        }else{
            $session->set('errors',['Id Not Found']);
            $request->redirect("../index.php") ;
        }
    }else{
        $session->set('errors',$errors);
        $request->redirect("../edit.php?id=$id") ;
    }
    
}else{
        $request->redirect("../index.php") ;
}




?>