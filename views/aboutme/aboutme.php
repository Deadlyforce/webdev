<?php
$title = 'A propos';
ob_start();

    echo $msg;
?>
<div class="aboutmeDiv">
    <div class="cursus">
        <p>Graphiste diplômé de l'ESAG Penninghen en 2003</p>
        <p>Graphiste 3D indépendant de 2003 à 2013</p>
        <p>Développeur Web Orienté Objet en 2014, issu d'une formation à l'institut IFOCOP</p>
    </div>
    <p class="skills">Mes compétences couvrent les domaines suivants :<br/> HTML5/CSS3, Javascript/Ajax, JQuery, PHP Objet/MySql, l'architecture MVC, Zend Framework ainsi que les principaux CMS (Drupal, Thélia, Wordpress) et des connaissances sur Symfony 2. </p>
    <div class="row rowSkills">
        <div class="col-sm-4">
            <img src="assets/images/logo_php.jpg" alt="PHP"/>
        </div>
        <div class="col-sm-4">
            <img src="assets/images/logo_mysql.jpg" alt="mySQL"/>          
        </div>
        <div class="col-sm-4">
            <img src="assets/images/logo_zend.jpg" alt="Zend Framework"/>           
        </div>
    </div>
    <div class="row rowSkills">
        <div class="col-sm-4">
            <img src="assets/images/logo_jQuery.jpg" alt="jQuery"/>            
        </div>
        <div class="col-sm-4">
            <img src="assets/images/logo_js.jpg" alt="Javascript"/>           
        </div>
        <div class="col-sm-4">
            <img src="assets/images/logo_Ajax.jpg" alt="Ajax"/>
        </div>
    </div>
    <div class="row rowSkills">
        <div class="col-sm-4">
            <img src="assets/images/logo_html5.jpg" alt="HTML5"/>
        </div>
        <div class="col-sm-4">
            <img src="assets/images/logo_css3.jpg" alt="CSS3"/>          
        </div>
        <div class="col-sm-4">
            <img src="assets/images/logo_symfony.jpg" alt="Symfony"/>
        </div>
    </div>
    
</div>
        
<?php    
    $layout = ob_get_contents();
ob_clean();

include 'layouts/layout.php';

