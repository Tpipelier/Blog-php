<?php


function cree_article(string $titre, string $description, int $id_categorie ){
     try{
            $connexion = new PDO('mysql:host=localhost;dbname=blog','root','');
            $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $connexion->prepare("INSERT INTO article(titre, description, pseudo) VALUES (?, ?, ?)");
            $stmt->bindParam(1, $titre);
            $stmt->bindParam(2, $description);
            $stmt->bindParam(3, $_SESSION["pseudo"]);

            $stmt->execute();

            $article_id  = $connexion->lastInsertId(); 
            
            $stmt = $connexion->prepare("INSERT INTO article_categorie(article_id,categorie_id) VALUES (?, ?)"); 
            $stmt->bindParam(1, $article_id);
            $stmt->bindParam(2, $id_categorie);

            $stmt->execute();

            return 0;




        } catch(PDOException $e){
            die('Erreur PDO : ' . $e->getMessage());
        }catch(Exception $e){
            die('Erreur Générale : ' . $e->getMessage());
        }

}

function option_categorie(){
      try{
            $connexion = new PDO('mysql:host=localhost;dbname=blog','root','');
            $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $connexion->query("SELECT * FROM categorie");
  
    
            foreach($stmt as $categorie){

                echo "<option value=".$categorie["id"].">".$categorie["nom"]."</option>";

            }
            $stmt->closeCursor();

 

        } catch(PDOException $e){
            die('Erreur PDO : ' . $e->getMessage());
        }catch(Exception $e){
            die('Erreur Générale : ' . $e->getMessage());
        }
    
}




?>