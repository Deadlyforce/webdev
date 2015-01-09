<?php
    $title = 'Modifier une news';    
    ob_start();
    if($news->access_ModelAdmin_sessionAdmin()){
        
        echo $msg;
        
    }
    $layout = ob_get_contents();
ob_clean();
include 'layouts/layout.php';

