<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todo List</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/styles.css" rel="stylesheet">
</head>
<?php require_once "inc/conn.php" ;?>
<body>
    <div class="container my-5">
        <h1 class="text-center mb-4">Todo List</h1>

        <!-- Input Section -->
        <div class="input-section mb-5">
            
            <?php require_once "inc/errors.php" ;?>
            <?php require_once "inc/success.php" ;?>
            <form action="handle/store.php" method="post">
                <textarea class="form-control" rows="3" placeholder="Enter your note here" name="title"></textarea>
                <button type="submit" class="btn btn-primary" name="submit">Add</button>
            </form>
        </div>

        <!-- Task Sections -->
        <div class="row d-flex justify-content-between">
            <!-- All Notes Section -->
            <div class="col-md-3">
                <h2 class="section-title mb-3">All Notes</h2>
                <?php
                    $sql = "select * from tasks where status='all'" ;
                    $res =$conn->query($sql);
                    
                    $allNotes = $res->fetchAll(PDO::FETCH_ASSOC);
                    if(count($allNotes) == 0){?>
                        <div class="item">
                                <div class="alert-info text-center ">
                                    empty to do
                                </div>
                            </div>
                    <?php }
                    else { foreach($allNotes as $all):?>
                        <div class="m-2  py-3">
                            <div class="task-item mb-3">
                                <span class="task-text"><?php echo $all['title']?></span>
                                <div class="task-date"><?php echo $all['created_at']?></div>
                                <div class="task-actions mt-2">
                                    <a class="btn btn-warning btn-sm" href="edit.php?id=<?php echo $all['id']?>">Edit</a>
                                    <a class="btn btn-info btn-sm" href="handle/goto.php?id=<?php echo $all['id']?>&status=doing">Doing</a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; }?>
                
            </div>

            <!-- Doing Section -->
            <div class="col-md-3">
                <h2 class="section-title mb-3">Doing</h2>
                <?php
                    $sql = "select * from tasks where status='doing'";
                    $res=$conn->query($sql);
                    $doing = $res->fetchAll(PDO::FETCH_ASSOC);
                    if(count($doing) == 0){?>
                        <div class="item">
                                <div class="alert-info text-center ">
                                    empty to do
                                </div>
                        </div>
                    <?php  }
                    else { foreach($doing as $d):?>
                        <div class="m-2  py-3">
                            <div class="task-item mb-3">
                                <span class="task-text"><?php echo $d['title']?></span>
                                <div class="task-date"><?php echo $d['created_at']?></div>
                                <div class="task-actions mt-2">
                                    <a class="btn btn-success btn-sm" href="handle/goto.php?id=<?php echo $d['id']?>&status=done">Done</a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; }?>
                
            </div>

            <!-- Done Section -->
            <div class="col-md-3">
                <h2 class="section-title mb-3">Done</h2>
                <?php
                    $sql = "select * from tasks where status='done'";
                    $res = $conn->query($sql);
                    $fetchedData = $res->fetchAll(PDO::FETCH_ASSOC);
                    if(count($fetchedData) == 0){?>
                        <div class="item">
                                <div class="alert-info text-center ">
                                    empty to do
                                </div>
                        </div>
                    <?php }
                else { foreach($fetchedData as $data):?>
                    <div class="m-2  py-3">
                        <div class="task-item mb-3">
                            <span class="task-text"><?php echo $data['title']?></span>
                            <div class="task-date"><?php echo $data['created_at']?></div>
                            <div class="task-actions mt-2">
                                <a class="btn btn-danger btn-sm" href="handle/delete.php?id=<?php echo $data['id']?>">Delete</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; }?>
                
            </div>
        </div>
    </div>
</body>
</html>