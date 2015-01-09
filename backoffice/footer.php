<?php
//include_once "models/admin.php";
//include_once 'models/newsletter.php';
//$admin = new Admin();
//$newsletter = new Newsletter();

//if(isset($_SESSION['user']['id_membre'])){
//    $id = $_SESSION['user']['id_membre'];
//    $newsletter->setIdMembre($id);
//}        
//$memberSubscribed = $newsletter->findSubscribedMember();
//
$footer = "";
//
$footer .= '<div class="container">';   
    $footer .= '<div class="row rowFooter">';    
        $footer .= '<div class="col-sm-4">';
            $footer .= '<a class="btn btn-default btnContact" href="index.php?controller=admins&action=contactme" title="Contact">Me contacter</a>';
        $footer .= '</div>';
        
        $footer .= '<div class="col-sm-8">';    
            $footer .= '<p id="copyright">Copyright © 2014 Norman Rosenstech. Tous droits réservés.</p>';    
        $footer .= '</div>';    
    $footer .= '</div>';    
$footer .= '</div>';

