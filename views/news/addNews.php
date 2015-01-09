<?php
    $title = 'Ajouter une news';    
    ob_start();
    if($news->access_ModelAdmin_sessionAdmin()){
?>
    <form method="post" class="form-horizontal" role="form">
        
        <div class="form-group">
            <label class="label-control col-sm-4"  for="titre">Titre</label>
            <div class="col-sm-8">
                <input class="form-control" type="text" name="titre" id="titre">
            </div>
        </div>
        
        <div class="form-group">
            <label class="label-control col-sm-4"  for="contenu">Message</label>
            <div class="col-sm-8">
                <textarea class="form-control" type="text" name="contenu" id="contenu"></textarea>
            </div>
        </div>
        
        <div class="form-group">
            <div class="col-sm-12">
                <input class="btn btn-default pull-right" type="submit" name="submit" value="Poster">
            </div>
        </div>

    </form>
<?php
    foreach($errors as $error){
        echo $error . '<br/>';
    }
    echo $msg; 
    }
    $layout = ob_get_contents();
ob_clean();
include 'layouts/layout.php';

