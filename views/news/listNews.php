<?php
    $title = 'Liste des news';    
    ob_start();    
?>


<?php
//    foreach($errors as $error){
//        echo $error . '<br/>';
//    }
    echo $msg;     
    $layout = ob_get_contents();
ob_clean();
include 'layouts/layout.php';

