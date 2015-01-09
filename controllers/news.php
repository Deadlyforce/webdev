<?php
include 'models/newsMod.php';

class News
{
    public function accueil(){
        
        $msg = '';
        $news = new Newsmod();
        $list = $news->listNews();
        
        // NEWS LIMITEES A 3
        $listSize = count($list);
        if($listSize <= 2){
           $limit = $listSize;
        }else{
           $limit = 3;
        }
        
        
        for($i=0; $i<$limit; $i++){
            
            $date = new DateTime($list[$i]['dateAjout']);
            $list[$i]['dateAjout'] = $date->format('d-m-Y');
            
            $msg .= '<div class="blocNews">';
                $msg .= '<p><span class="date">' . $list[$i]['dateAjout'] . '</span>';
                $msg .= '<span class="titre">' . $list[$i]['titre'] . '</span></p>';            
                $msg .= '<p class="contenu">' . $list[$i]['contenu'] . '</p>';              
            $msg .= '</div>';
        }        
        
        include 'views/news/accueil.php';
    }
    
    public function listNews(){
        
        $msg ='';
        $news = new Newsmod();
        
        if($news->access_ModelAdmin_sessionAdmin()){
            
            // LISTER LES NEWS EXISTANTES EN BASE
            $list = $news->listNews();

            $msg .= '<a class="btn btn-default btnEdit" href="index.php?controller=news&action=addNews" title="Ajouter une news">Ajouter une news</a>';            
            
            foreach($list as $message){
                
                $date = new DateTime($message['dateAjout']);
                $message['dateAjout'] = $date->format('d-m-Y');
                
                $msg .= '<div class="blocNews">';
                    $msg .= '<p><span class="date">'.$message['dateAjout'].'</span>';
                    $msg .= '<span class="titre">' . $message['titre'] . '</span></p>';
                    $msg .= '<p class="auteur">Par: ' .$message['auteur'] . '</p>';
                    $msg .= '<p class="contenu">' . $message['contenu'] . '</p>';
                    
                    $msg .= '<a class="btn btn-default btnEdit2 pull-right" href="index.php?controller=news&action=delNews&id='. $message['id_news'] .'" title="Supprimer">Supprimer</a>';                            
                    $msg .= '<a class="btn btn-default btnEdit2 pull-right" href="index.php?controller=news&action=modNews&id='. $message['id_news'] .'" title="Modifier">Modifier</a>';
                    
                    $msg .=  '<div class="clearfix"></div>';
                $msg .= '</div>';                
            }
            
        }else{
            $msg .= 'Vous n\'êtes pas autorisé à accéder à cette page.<br/>';
        }
        
        include 'views/news/listNews.php';
    }
    
    public function addNews(){
        
        $msg = '';
        $errors = array();        
        $news = new Newsmod();
        
        if($news->access_ModelAdmin_sessionAdmin()){
        
            if(filter_has_var(INPUT_POST, 'submit')){
                
                $titre = filter_input(INPUT_POST,'titre', FILTER_SANITIZE_STRING);
                 if($titre == NULL || $titre == false || empty($titre)){
                     $errors[] = 'Vous devez fournir un titre.';
                }
                
                $contenu = filter_input(INPUT_POST,'contenu', FILTER_SANITIZE_STRING);
                 if($contenu == NULL || $contenu == false || empty($contenu)){
                     $errors[] = 'Vous devez écrire un message.';
                }
                
                if(count($errors) == 0){
                    $dateJour = new DateTime();
                    $dateJour = $dateJour->format('Y-m-d');
                    
                    $news->setAuteur($_SESSION['admin']['pseudo']);
                    $news->setDateAjout($dateJour);
                    $news->setDateModif($dateJour);
                    $news->setTitre($titre);
                    $news->setContenu($contenu);
                    
                    $news->saveNews();
                    
                    $msg.= 'La news est publiée !';                    
                }else{
                    $errors[] = 'Il y a un problème avec les informations entrées.';
                }
            }           
        }else{
            $msg .= 'Vous n\'êtes pas autorisé à accéder à cette page.<br/>';
        }
        
        include 'views/news/addNews.php';
    }
    
    public function modNews(){
        
        $msg = '';
        $errors = array();
        
        $news = new Newsmod();
        
        if($news->access_ModelAdmin_sessionAdmin()){
            
            if(filter_has_var(INPUT_GET, 'id')){
                $id = $_GET['id'];
            }       
            $news->setIdNews($id);            
            $modnews = $news->findNews();            
            
            if(filter_has_var(INPUT_POST, 'submit')){                
                $titre = filter_input(INPUT_POST,'titre', FILTER_SANITIZE_STRING);
                 if($titre == NULL || $titre == false || empty($titre)){
                     $errors[] = 'Vous devez fournir un titre.';
                }
                
//                $titre = htmlentities($_POST['titre'], ENT_QUOTES, "utf-8");
                
                $contenu = filter_input(INPUT_POST,'contenu', FILTER_SANITIZE_STRING);
                 if($contenu == NULL || $contenu == false || empty($contenu)){
                     $errors[] = 'Vous devez écrire un message.';
                }                               
                
                if(count($errors) == 0){
                    $dateJour = new DateTime();
                    $dateJour = $dateJour->format('Y-m-d');
                    
                    $news->setAuteur($_SESSION['admin']['pseudo']);
                    $news->setDateAjout($dateJour);                    
                    $news->setTitre($titre);
                    $news->setContenu($contenu);
                    
                    $news->replaceNews();
                    
                    $msg.= '<p>La news est modifiée !</p>';
                    $msg .= '<a class="btn btn-default btnEdit2" href="index.php?controller=news&action=listNews" title="Gestion">Retour au panneau de gestion</a>';                            
                    $msg .= '<a class="btn btn-default btnEdit2" href="index.php" title="Accueil">Aller à l\'accueil</a>';
                }else{
                    $errors[] = 'Il y a un problème avec les informations entrées.';
                }
            }
            
            
        }else{
            $msg .= 'Vous n\'êtes pas autorisé à accéder à cette page.<br/>';
        }
        
        include 'views/news/modNews.php';
    }
    
    public function delNews(){
        
        $msg = '';
        $errors = array();
        
        $news = new Newsmod();
        
        if($news->access_ModelAdmin_sessionAdmin()){
            
            if(filter_has_var(INPUT_GET, 'id')){
                $id = $_GET['id'];
            }       
            $news->setIdNews($id);            
            $news->deleteNews();
            
            $msg .= '<p>News correctement supprimée !</p>';
            $msg .= '<a class="btn btn-default btnEdit2" href="index.php?controller=news&action=listNews" title="Retour au panneau de gestion">Retour au panneau de gestion</a>';
            $msg .= '<a class="btn btn-default btnEdit2" href="index.php?controller=news&action=accueil" title="Accueil">Aller à l\'accueil</a>';
            
        }else{
            $msg .= 'Vous n\'êtes pas autorisé à accéder à cette page.<br/>';
        }
        
        include 'views/news/delNews.php';
    }
    
}

