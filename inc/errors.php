<?php 
require_once "app.php" ;
if($session->get('errors')){
    foreach($session->get('errors') as $error){?>
        <div class="alert alert-danger"><?php echo $error?></div>
    <?php }
    $session->unset('errors');
}




?>