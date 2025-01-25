<?php 
require_once "../inc/conn.php" ;
require_once "../app.php" ;
if($request->checker($request->get('id')) && $request->checker($request->get('status'))){
    $id =$request->filter($request->get('id'));
    $status = $request->filter($request->get('status'));
    // select one
    $sql = "select * from tasks where id=:id" ;
    $res = $conn->prepare($sql);
    $res->bindParam(':id',$id,PDO::PARAM_INT);
    $res->execute();
    $data = $res->fetchAll(PDO::FETCH_ASSOC);
    if(count($data)>0){
        //update status
        $sql = "update tasks set status=:status where id=:id" ;
        $res = $conn->prepare($sql) ;
        $res->bindParam(':status',$status,PDO::PARAM_STR);
        $res->bindParam(':id',$id,PDO::PARAM_INT);
        $out = $res->execute();
        if($out){
            // success
            $session->set('success','Status Updated Successfully');
            $request->redirect('../index.php') ;
        }else{
            // failed
            $session->set('errors',['Error While Updating']);
            $request->redirect('../index.php') ;
        }

    }else{
        $session->set('errors',['Task Not Found']);
        $request->redirect('../index.php') ;
    }
}else{
    $request->redirect('../index.php') ;
}





?>