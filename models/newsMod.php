<?php
include_once "models/result.php";

class Newsmod
{
    protected $id_news, $auteur, $titre, $contenu, $dateAjout, $dateModif;
    
    public function getIdNews(){
        return $this->id_news;
    }
    
    public function getAuteur(){
        return $this->auteur;
    }
    
    public function getTitre(){
        return $this->titre;
    }
    
    public function getContenu(){
        return $this->contenu;
    }
    
    public function getDateAjout(){
        return $this->dateAjout;
    }
    
    public function getDateModif(){
        return $this->dateModif;
    }
    
    // ---------------------------------
    
    public function setIdNews($idNews){
        $this->id_news = $idNews;
    }
    
    public function setAuteur($auteur){
        $this->auteur = $auteur;
    }
    
    public function setTitre($titre){
        $this->titre = $titre;
    }
    
    public function setContenu($contenu){
        $this->contenu = $contenu;
    }
    
    public function setDateAjout($dateAjout){
        $this->dateAjout = $dateAjout;
    }
    
    public function setDateModif($dateModif){
        $this->dateModif = $dateModif;
    }
    
    // ---------------------------------
    
    public function access_ModelAdmin_sessionAdmin(){
        
        include_once "models/admin.php";        
        $admin = new Admin();
        
        $resultat = $admin->sessionAdmin();
        return $resultat;
    }
    
    public function listNews(){
        $db = Db::getInstance();
        $req = $db->query("SELECT * FROM news");
        $row = $req->fetchAll(PDO::FETCH_ASSOC);
        return $row;
    }
    
    public function saveNews(){        
        $db = Db::getInstance();
        $req = $db->query("INSERT INTO news (auteur, titre, contenu, dateAjout, dateModif) VALUES ('$this->auteur', '$this->titre', '$this->contenu', '$this->dateAjout', '$this->dateModif')");
        return $req;
    }
    
    public function findNews(){
        $db = Db::getInstance();
        $req = $db->query("SELECT * FROM news WHERE id_news = '$this->id_news'");
        return $req->fetch(PDO::FETCH_ASSOC);
    }
    
    public function replaceNews(){
        $db = Db::getInstance();
        $req = $db->query("REPLACE INTO news (id_news, auteur, titre, contenu, dateAjout, dateModif) VALUES ('$this->id_news', '$this->auteur', '$this->titre', '$this->contenu', '$this->dateAjout', '$this->dateModif')");
        return $req;
    }
    
    public function deleteNews(){
        $db = Db::getInstance();
        $req = $db->query("DELETE FROM news WHERE id_news = '$this->id_news'");
        return $req;
    }
}


