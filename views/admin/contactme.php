<?php
    $title = 'Me contacter';    
    ob_start();    
?>
    <div class="forms">
        <form method="post" class="form-horizontal" role="form">

            <div class="form-group">
                <label class="label-control col-sm-4"  for="exp">Expéditeur</label>
                <div class="col-sm-8">
                    <input class="form-control" type="text" name="exp" id="exp" placeholder="Email">
                </div>
            </div>

            <div class="form-group">
                <label class="label-control col-sm-4"  for="subject">Sujet</label>
                <div class="col-sm-8">
                    <input class="form-control" type="text" name="subject" id="subject" placeholder="Sujet">
                </div>
            </div>

            <div class="form-group">
                <label class="label-control col-sm-4"  for="message">Message</label>
                <div class="col-sm-8">
                    <textarea class="form-control" type="text" name="message" id="message" placeholder="Me contacter..."></textarea>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-12">
                    <input class="btn btn-default pull-right" type="submit" name="submit" value="Envoyer">
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

