<?php
include 'backoffice/header.php';
include 'backoffice/footer.php';
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" /> 
        <title><?php echo $title; ?></title>
        <link rel="stylesheet" href="public/css/bootstrap.css" />
        <link rel="stylesheet" href="public/css/style.css" /> 
        
        <script type="text/javascript" src="public/js/jquery-1.11.1.min.js"></script>  
    </head>
    <body>
        <div id="divPic01"><img src="public/images/topPic_01_sharp.jpg" /></div>
        <div id="divPic02"><img src="public/images/topPic_01_blur.jpg" /></div>
        <div class="superContainer">
            
            <div class="container">        
                <header>
                    <?php echo $header; ?>
                </header>
            </div>                     

            <div class="subtitle">
                <div class="container"> 
                    <p><code class="subtitleCode">> </code><?php echo $title; ?></p>  
                </div>
            </div>
            
            <div class="sectionLarge">
                <div class="container">   
                    <section>        
                        <?php echo $layout; ?>        
                    </section>
                </div>
            </div>          
            
            <footer>
                <?php echo $footer; ?>
            </footer> 
            
        </div>
    </body>


<script type="text/javascript">
    
    // ALTERNANCE IMAGES ACCUEIL
    
//    $(document).ready(function(){  
//        
//        $(".navbar-brand").hover(               
//            function(){
//                $('body').css('background-image', 'url("public/images/topPic_01_sharp.jpg")');
//            }, 
//            function(){
//                $('body').css('background-image', 'url("public/images/topPic_01_blur.jpg")');
//            }                   
//        ); 
//
//    });
    
    $(document).ready(function(){  
        
        $(".navbar-brand").hover(               
            function(){
                $('#divPic02').animate({"opacity": 0}, 1000);
                $('.talents').animate({"opacity": 0}, 1000);
            },
            function(){
                $('#divPic02').animate({"opacity": 1}, 1000);
                $('.talents').animate({"opacity": 1}, 1000);
            });
        });
    
    $(window).load(function(){
        $('.subtitle').animate({height: 125}, 1000);
    });


    
        
</script>
    


</html>