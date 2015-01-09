<?php
include 'models/admin.php';

class Admins{
    
    public function connect(){
        $msg = '';
        $errors = array();
        
        if(filter_has_var(INPUT_POST, 'connexion')){
            $pseudo = filter_input(INPUT_POST,'pseudo', FILTER_SANITIZE_STRING);
            if($pseudo == NULL || $pseudo == false || empty($pseudo)){
                $errors[] = 'Vous devez fournir un pseudo.';
            }

            $mdp = filter_input(INPUT_POST,'mdp', FILTER_SANITIZE_STRING);
            if($mdp == NULL || $mdp == false || empty($mdp)){
                $errors[] = 'Vous devez fournir un mot de passe valide.';
            }                

            $mdp = md5($mdp);
            
            if(count($errors) == 0){
                // Instancie un nouvel objet admin
                $admin = new Admin();
                $admin->setPseudo($pseudo);                
                $admin->setMdp($mdp);

                $resultArray = $admin->checkConnect();

                $msgError = '';                

                for($i = 0; $i < count($resultArray); $i++){
                    if(!$resultArray[$i]->getPassed()){
                        $msgError .= $resultArray[$i]->getErrorMessage();
                        $msgError .= "<br/>";
                    }
                }

                if($msgError == ''){
                    $admin->openSession();
                    header('location:index.php?controller=admins&action=connected');

                }else{
                    $msg .= $msgError;
                }
            }else{
                $errors[] = 'Il y a un problème avec vos identifiants.';
            }               
            
        }      
        
        include 'views/admin/connectAdmin.php';
    }
    
    public function connected(){
        $msg = '';
        $msg .= '<p>PSEUDO et MDP OK, vous êtes connecté admin.</p>';        
        $msg .= '<a class="btn btn-default btnEdit2" href="index.php" title="Accueil">Retour à l\'accueil</a>';

        include 'views/admin/connected.php';
    }
    
    public function disconnect(){
        $msg = "";
        if(isset($_SESSION)){
            session_destroy();
        }

        $msg .= '<div class="alert alert-success">Fin de la session !</div>';
        $msg .= '<a class="btn btn-default btnEdit2" href="index.php" title="Retour à l\'accueil">Retourner à l\'accueil</a>';

        include "views/admin/disconnect.php";
    }
    
    public function contactme(){
        
        $msg = '';
        $errors = array();
        
        if(filter_has_var(INPUT_POST, 'submit')){
                
            $exp =  filter_input(INPUT_POST,'exp', FILTER_VALIDATE_EMAIL);
            if($exp == NULL){                
                $errors[] = 'Vous devez renseigner votre adresse email.';
            }elseif($exp == false){
                $errors[] = 'L\'adresse email n\'est pas valide.';
                $exp = filter_input(INPUT_POST,'exp', FILTER_SANITIZE_EMAIL);
            }

            $subject =  filter_input(INPUT_POST,'subject', FILTER_SANITIZE_STRING);
            if($subject == NULL || $subject == false || empty($subject)){
                $errors[] = 'Vous devez remplir le sujet.';
            }

            $message =  filter_input(INPUT_POST,'message', FILTER_SANITIZE_STRING);
            if($message == NULL || $message == false || empty($message)){
                $errors[] = 'Le champ message ne peut rester vide.';
            }
            
            if(count($errors) === 0){
                // Envoi de l'email récapitulatif à l'administrateur
                $to = 'norman.rosenstech@gmail.com';          

                $type = 'plain'; // or HTML
                $charset = 'utf-8';
                // Génère un identifiant unique basé sur l'heure courante
                $uniqid = md5(uniqid(time())); 

                $headers  = 'From: '.$exp."\n";
                $headers .= 'Reply-to: '.$exp."\n";
                $headers .= 'Return-Path: '.$exp."\n";
                $headers .= 'Message-ID: <'.$uniqid.'@'.$_SERVER['SERVER_NAME'].">\n";
                $headers .= 'MIME-Version: 1.0'."\n";
                $headers .= 'Date: '.gmdate('D, d M Y H:i:s', time())."\n";
                $headers .= 'X-Priority: 3'."\n";
                $headers .= 'X-MSMail-Priority: Normal'."\n";
                $headers .= 'Content-Type: multipart/mixed;boundary="----------'.$uniqid.'"'."\n\n";
                $headers .= '------------'.$uniqid."\n";
                $headers .= 'Content-type: text/'.$type.';charset='.$charset.''."\n";
                $headers .= 'Content-transfer-encoding: 7bit';

                mail($to, $subject, $message, $headers);

                $msg .= '<p>Message envoyé !</p>';
            }else{
                $errors[] = '<p>Votre message n\'a pas été envoyé.</p>';
            }
            
        }
        
        include 'views/admin/contactme.php';
    }
}



