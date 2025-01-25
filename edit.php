<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/styles.css" rel="stylesheet">

</head>

<body>
<div class="container my-5">
        <h1 class="text-center mb-4">Edit Task</h1>

        <?php
            require_once "inc/conn.php" ;
            require_once "app.php" ;
            if($request->get('id')){
                // select one
                $id = $request->get('id');
                $sql = "select `title` from tasks where id=:id" ;
                $res=$conn->prepare($sql) ;
                $res->bindParam(':id',$id,PDO::PARAM_INT);
                $res->execute();
                $out = $res->fetchColumn();
                if(empty($out)){
                    $session->set('errors',['Id Not Found']);
                    $request->redirect("index.php") ;
                }
            }else{
                $request->redirect("index.php") ;
            }
        ?>
        <div class="input-section mb-5">
            <?php require_once "inc/errors.php" ;?>
            <?php require_once "inc/success.php" ;?>

            <form class="d-flex gap-3" action="handle/edit.php?id=<?php echo $id?>" method="post">
                <textarea name="title" class="form-control" rows="3" placeholder="Edit"><?php if(isset($out)) echo $out?></textarea>
                <button type="submit" name="submit" class="btn btn-primary">Edit</button>
            </form>
        </div>
</body>
</html>
