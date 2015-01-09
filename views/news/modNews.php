<?php
    $title = 'Modifier une news';    
    ob_start();
    if($news->access_ModelAdmin_sessionAdmin()){
?>
    <div class="forms">
        <form method="post" class="form-horizontal" role="form">

            <div class="form-group">
                <label class="label-control col-sm-4"  for="titre">Titre</label>
                <div class="col-sm-8">
                    <input class="form-control" type="text" name="titre" id="titre" value="<?php echo $modnews['titre']; ?>">
                </div>
            </div>

            <div class="form-group">
                <label class="label-control col-sm-4"  for="contenu">Message</label>
                <div class="col-sm-8">
                    <textarea class="form-control" type="text" name="contenu" id="contenu"><?php echo $modnews['contenu']; ?></textarea>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-12">
                    <input class="btn btn-default pull-right" type="submit" name="submit" value="Modifier">
                </div>
            </div>

        </form>
    </div>
<?php
    foreach($errors as $error){
        echo $error . '<br/>';
    }
    echo $msg; 
    }
    $layout = ob_get_contents();
ob_clean();
include 'layouts/layout.php';

