<?php
include_once "models/result.php";

class Admin
{
    protected $id_admin, $pseudo, $mdp;
    
    public function getIdAdmin(){
        return $this->id_admin;
    }
    
    public function getPseudo(){
        return $this->pseudo;
    }
    
    public function getMdp(){
        return $this->mdp;
    }
    
    // ---------------------------------
    
    public function setIdAdmin($idAdmin){
        $this->id_admin = $idAdmin;
    }
    
    public function setPseudo($pseudo){
        $this->pseudo = $pseudo;
    }
    
    public function setMdp($mdp){
        $this->mdp = $mdp;
    }
    
    // ---------------------------------
    
    public function checkConnect(){
            $resultat = $this->checkConnectPseudo();
            $resultArray[] = $resultat;
            if($resultat->getPassed()){
                $resultArray[] = $this->checkConnectPassword();
            }
            return $resultArray;        
    }
    
    public function checkConnectPseudo(){        
        $row = $this->searchAdmin();                                
        if ($row != 0){
            return new Result( true );
        }else{
            return new Result( false, "Erreur de pseudo!" );
        }
    }
    
    public function checkConnectPassword(){
        $foundAdmin = $this->findAdmin();
            if( $foundAdmin['mdp'] === $this->mdp ){
                return new Result(true);
            }else{
                return new Result(false, "Erreur de mot de passe!");
            }
    }
    
    public function openSession(){             
        $foundAdmin = $this->findAdmin();
        foreach($foundAdmin as $indice => $valeur){
            if($indice != 'mdp'){
                $_SESSION['admin'][$indice] = $valeur;
            }
        }
    }
        
    public function sessionAdmin(){
        if(isset($_SESSION['admin']) && $_SESSION['admin'] != ''){
            return true;
        }
        return false;
    }
    
    public function searchAdmin(){
        $db = Db::getInstance();
        $req = $db->query("SELECT * FROM admin WHERE pseudo = '$this->pseudo'");
        return $req->rowCount();            
    }
    
    public function findAdmin(){
        $db = Db::getInstance();
        $req = $db->query("SELECT * FROM admin WHERE pseudo = '$this->pseudo'");
        return $req->fetch(PDO::FETCH_ASSOC);            
    }
    
}
