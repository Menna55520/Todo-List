<?php 
require_once "../inc/conn.php" ;
require_once "../app.php" ;
if($request->checker($request->get('id'))){
    $id = $request->filter($request->get('id'));
    // select one
    $sql = "select title from tasks where id=:id" ;
    $res = $conn->prepare($sql) ;
    $res->bindParam(':id',$id,PDO::PARAM_INT);
    $res->execute();
    $data = $res->fetchColumn();
    if($data){
        // delete
        $sql = "delete from tasks where id=:id" ;
        $res = $conn->prepare($sql) ;
        $res->bindParam(':id',$id,PDO::PARAM_INT);
        $out= $res->execute();
        if($out){
            // success
            $session->set('success','Task Deleted Successfully');
            $request->redirect('../index.php');
        }else{
            // fail
            $session->set('errors',['Error While Deleting']);
            $request->redirect('../index.php');
        }
    }else{
        $session->set('errors',['Task Not found']);
        $request->redirect('../index.php');
    }
}else{
    $request->redirect('../index.php');
}


?>