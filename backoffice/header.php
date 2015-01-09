<?php
include_once "models/admin.php";
$admin = new Admin();

$header = '';

$header .= '<div class="rowHeader">';
    $header .= '
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>           
            <a class="navbar-brand myLogo" href="index.php?controller=news&action=accueil">NORMAN ROSENSTECH</a>
        </div>';

    $header .= '<div class="collapse navbar-collapse">';
        $header .= '<ul class="nav navbar-nav navbar-right menu">';
            $header .= '<li><a href="index.php?controller=news&action=accueil" title="ACCUEIL">ACCUEIL</a></li>';
            $header .= '<li><a href="index.php?controller=galleries&action=indexGallery" title="RÉALISATIONS">RÉALISATIONS</a></li>';
            $header .= '<li><a href="index.php?controller=aboutme&action=indexAboutme" title="A PROPOS">A PROPOS</a></li>';
            $header .= '<li><a href="index.php?controller=admins&action=contactme" title="CONTACT">CONTACT</a></li>';
            
            if($admin->sessionAdmin() && $admin->sessionAdmin() != ''){
                $link = '';
            }else{
                $link = 'index.php?controller=admins&action=connect';
            }
            
            $header .= '<li><a href="'.$link.'" title="ADMIN">ADMIN</a>';
                        // Admin connecté
                        if($admin->sessionAdmin() && $admin->sessionAdmin() != ''){
                            $header .= '<ul class="subMenu">';
                            $header .= '<li><a href="index.php?controller=news&action=listNews" title="GESTION">GESTION</a></li>';
                            $header .= '<li><a href="index.php?controller=admins&action=disconnect" title="DECONNEXION">DÉCONNEXION</a></li><br/>';
                            $header .= '</ul>';
                        } 
            $header .= '</li>';                
            

                       
        $header .= '</ul>';
    $header .= '</div>';

// TITRE -----------------------------------------------------------------------

//    $header .= '<h1 class="mainTitle">Bienvenue sur Blabla.</h1>';
    $header .= '<h2 class="tagline"><code class="logoCode">< </code>Développeur web orienté objet<code class="logoCode"> /></code></h2>';
    $header .= '<div class="talents">';
        $header .= '<h2 class="talentsDetail">PHP Objet / MySql / Javascript / Ajax<br/>JQuery / Zend Framework</h2>';
//        $header .= '<h2 class="talentsDetail">JQuery / Zend Framework</h2>';
    $header .= '</div>';
$header .= '</div>';






