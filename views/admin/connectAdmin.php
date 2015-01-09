<?php
    $title = 'Connexion';    
    ob_start();    
?>
<div class="forms">
    <form method="post" action="" class="form-horizontal" role="form">
        
        <div class="form-group">
            <label class="label-control col-sm-4" for="pseudo">Pseudo</label>
            <div class="col-sm-8">
                <input class="form-control" type="text" id="pseudo" name="pseudo" placeholder="Pseudo" />
            </div>
        </div>

        <div class="form-group">
            <label class="label-control col-sm-4" for="mdp">Mot de passe</label>
            <div class="col-sm-8">
                <input class="form-control" type="password" id="mdp" name="mdp" placeholder="Mot de passe"/>
            </div>
        </div>
        
        <div class="form-group">
            <div class="col-sm-12">
                <input class="btn btn-success pull-right" type="submit" id="connexion" name="connexion" value="Connexion" />
            </div>
        </div>
    </form>
</div>
<?php
    foreach($errors as $error){
        echo $error . '<br/>';
    }
    echo $msg;     
    $layout = ob_get_contents();
ob_clean();
include 'layouts/layout.php';



