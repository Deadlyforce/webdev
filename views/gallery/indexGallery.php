<?php
    $title = 'Réalisations';    
    ob_start();       
        echo $msg;
?>       

        <div class="row rowGallery">
            <div class="col-sm-4">
                <div class="preview">
                    <a id="kiidline" href="http://www.kiidline.com" target="_blank" title="Kiidline"></a>
                    <div class="previewText">Kiidline</div>
                </div>
                
            </div>
            <div class="col-sm-4">
                <div class="preview">
                    <a id="lokisalle" href="http://www.lokisalle.normanwebdev.com" target="_blank" title="Lokisalle"></a>
                    <div class="previewText">Lokisalle</div>  
                </div>                              
            </div>
            <div class="col-sm-4">
                <div class="preview">
                    <a id="perso3D_01" href="http://www.normanrosenstech.com" target="_blank" title="3D"></a>
                    <div class="previewText">Mon portfolio 3D</div>
                </div>                                
            </div>
        </div>
        
        <div class="row rowGallery">
            <div class="col-sm-4">
                
            </div>
            <div class="col-sm-4">
                
            </div>            
            <div class="col-sm-4">
                <div class="preview">
                    <a id="perso3D_02" href="http://www.normanwebdev.com/sites/Portfolio3D" target="_blank" title="3D (ancien)"></a>
                    <div class="previewText">Ancien portfolio 3D</div>
                </div>                
            </div>
        </div>
<?php    
    $layout = ob_get_contents();
ob_clean();
include 'layouts/layout.php';
