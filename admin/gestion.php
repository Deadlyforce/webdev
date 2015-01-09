<?php
require("../inc/inc_init.php");
require("../inc/inc_haut_de_site.php");
require("../inc/inc_header.php");


//----------------------------------REDIRECTION - Sécurisation du site en guidant l'utilisateur----------------------------------------------

if(!admin_est_connecte()){
    header("location:../connexion_admin.php");
    exit();									
    // Permet d'éviter que l'utilisateur hors connexion ait accès à la gestion en tapant l'adresse dans l'URL 
 }


?>

        <section>
            <aside>
               <?php
                // MENU LATERAL POUR AFFICHAGE OU ECRITURE DES NEWS 
                echo "<p><a href='?action=ecrire&bouton=off' title='Ecrire une news'>Ecrire une news</a></p>";
                echo "<p><a href='?action=editer&bouton=on' title='Editer les news'>Editer les news</a></p>";

               ?>
            </aside><!--
            --><article>
                <p>Interface ADMIN - Infos Admin - Gestion de la newsletter</p>	
                        
            <!-------------------------- FORMULAIRE NEWSLETTER--------------------------------->
            <?php
                // IL S'AFFICHE EN CAS D'ACTION ET SI ACTION = ECRIRE ou MODIFIER
                if(isset($_GET['action']) && ($_GET['action']=='ecrire' || $_GET['action']=='modifier')){
                // Je récupère les infos de la news à modifier et je les colle dans une variable
                    if(isset($_GET['id'])){
                        $resultat = news_elements($_GET['id']);
                        $news_a_modifier = $resultat->fetch_assoc();
                    };
            ?>
                    <fieldset>
                            <legend>Newsletter</legend>
                            <form method="post" action="">
                                    <!-- Le input "hidden" permet de faire passer l'id de la news à modifier si c'est le cas -->
                                    <input type="hidden" id="id" name="id" value="<?php choix_valeur('id')?>"/>

                                    <p><label for="pseudo">Auteur</label>
                                       <input type="text" id="auteur" name="auteur" placeholder="Auteur" value="<?php choix_valeur('auteur')?>"/></p>

                                    <?php 
                                    if(!isset($news_a_modifier)){
                                    ?>      
                                        <p><label for="dateAjout">Date Ajout</label>
                                        <input type="text" name="dateAjout" placeholder="YYYY-MM-DD" value="<?php choix_valeur('dateAjout')?>" /></p>
                                    <?php        
                                            }else{
                                    ?>        
                                                    <p><label for="dateModif">Date Modif</label>
                                                    <input type="text" name="dateModif" placeholder="YYYY-MM-DD" value="<?php choix_valeur('dateModif')?>" /></p>

                                                    <p><label for="dateAjout">Date Ajout</label>
                                                            <input type="text" name="dateAjout" placeholder="YYYY-MM-DD" value="<?php choix_valeur('dateAjout')?>" /></p>
                                    <?php
                                             }
                                    ?>

                                    <p><label for="titre">Titre</label>
                                       <input type="text" id="titre" name="titre" placeholder="Titre" value="<?php choix_valeur('titre')?>"/></p>

                                    <p><label for="contenu">Contenu</label>
                                       <textarea id="contenu" name="contenu" placeholder="Taper le texte ici..."><?php choix_valeur('contenu') ?></textarea></p>

                                    <p><input type="submit" id="publier" name="publier" value="<?php echo ucfirst($_GET['action']) ?>" /></p>   
                            </form>
                    </fieldset>
                <?php
                }
                ?>
                        
                        <!-------------------------- AFFICHAGE DES NEWSLETTER PRESENTES EN BASE --------------------------------------------->
                        
                        <?php
                        
                        //-------------------------- ENTREE DU FORMULAIRE EN BASE ---------------------------------------------
                        if($_POST){
                            
                                    // -----------------------------VERIFICATIONS --------------------------------------------------
                            
                                    // Enregistre une erreur si des caractères spéciaux apparaissent dans le nom de l'auteur.
                                    $verif_auteur = preg_match("#^[a-zA-Z0-9_-]+$#", $_POST['auteur']);	
                                    if(!$verif_auteur && !empty($_POST['auteur']) ){
                                        $msg .= '<div class="erreur">Caractères acceptés pour l\'auteur: A à Z et 0 à 9</div>';
                                    };

                                    // Enregistre une erreur si le nom de l'auteur ne fait pas la bonne taille
                                    if(strlen($_POST['auteur']) < 3 || strlen($_POST['auteur']) > 15){
                                        $msg .= '<div class="erreur">Le nom de l\'auteur doit comporter entre 3 et 15 caractères inclus</div>'; 
                                    }

                                    // Enregistre une erreur si le texte tapé ne fait pas la bonne taille
                                    if(strlen($_POST['contenu']) < 10 || strlen($_POST['contenu']) > 350){
                                        $msg .= '<div class="erreur">Le texte doit comporter entre 10 et 350 caractères.</div>';  
                                    }
                            
                            // Si aucunes erreurs, j'entre mes données en base
                            if(empty($msg)){
                                // Je vide les caractères html de tous les champs remplis par l'administrateur
                                foreach($_POST as $indice => $valeur){
                                    $_POST[$indice] = htmlentities($valeur, ENT_QUOTES);
                                };
                                
                                              
                                execute_requete("REPLACE INTO news (id, auteur, titre, dateAjout, dateModif, contenu) VALUES ('$_POST[id]','$_POST[auteur]','$_POST[titre]','$_POST[dateAjout]','$_POST[dateModif]','$_POST[contenu]')");
                                $msg .='<div class"validation">Newsletter publiée !</div>';
                                header("location:../index.php");
                                
                            }
                        }
                        
                        echo $msg;
                        
                        
                        // SUPPRESSION D'UNE NEWS--------------------------------------------------------------------------------------------------
                        // Recupération des paramètres action et id en URL
                        if(isset($_GET['action']) && $_GET['action']=='effacer'){
                            // Retrait des infos relatives à la news à effacer à partir de l'id passé en URL
                            $resultat = news_elements($_GET['id']);
                            $news_a_effacer = $resultat -> fetch_assoc();
                            
                            $msg.= '<div class="validation">Suppression de la news intitulée: ' . $news_a_effacer['titre'] . '<div>';
                            execute_requete("DELETE FROM news WHERE id = $_GET[id]");
                        }
                        
                     
                        // RETRAIT  ET AFFICHAGE DE TOUTES LES NEWSLETTER EN BASE POUR EDITION-----------------------------------------------------
                        
                        // A l'arrivée sur la page, j'affiche systématiquement les news existantes prêtes à éditer
                        $_GET['action'] = 'editer';   
                        
                        if(isset($_GET['action']) && $_GET['action']=='editer'){
                            $donnees = execute_requete("SELECT * FROM news");
                            while($news = $donnees->fetch_assoc()){
                                echo "<div id = 'newsletters'>";
                                    echo "<h3>Titre: " . ucfirst($news['titre'])."</h3>";
                                    echo "<p>Auteur: " . ucfirst($news['auteur'])."</p>";
                                    echo "<p>" . $news['contenu'] . "</p>";
                                   
                                    echo "<p>Date d'ajout: " . $news['dateAjout'] . "</p>";
                                    
                                    if($news['dateModif'] && $news['dateModif']!=''){
                                        echo "<p>Date de modification: " . $news['dateModif'] . "</p>";
                                    }
                                    
                                    if(isset($_GET['bouton']) && $_GET['bouton']=='on'){
                                           echo '<a href="?action=modifier&id=' . $news['id'] . '" title="Modifier"><img src="../images/button_modify.png" /></a>';
                                           echo '<a href="?action=effacer&id=' . $news['id'] . '" title="Effacer"><img src="../images/button_delete.png" /></a>';
                                    }
                                echo "</div>";
                            }
                        }
                        ?>
                        
                    </article>
		</section>


<?php
require("../inc/inc_footer.php");
?>
