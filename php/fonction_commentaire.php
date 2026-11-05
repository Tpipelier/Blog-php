<?php
        function creation_commentaire(string $description, int $article_id, string $pseudo){
        try{
            $commentaire = new PDO('mysql:host=localhost;dbname=blog','root','');
            $commentaire->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $stmt = $commentaire->prepare("INSERT INTO  commentaire (description,article_id,pseudo) VALUES (?, ?, ?)"); 
				$stmt->bindParam(1, $description);
                $stmt->bindParam(2, $article_id);
                $stmt->bindParam(3, $pseudo);



                $stmt->execute();
                header("location: article.php");
			   
                exit(0);
        
        } catch(PDOException $e){
            die('Erreur PDO : ' . $e->getMessage());
        }catch(Exception $e){
            die('Erreur Générale : ' . $e->getMessage());
        }

        }

        function supprimer_commentaire(int $commentaire_id, int $article_id){
            try{
            $commentaire = new PDO('mysql:host=localhost;dbname=blog','root','');
            $commentaire->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			
			$stmt = $commentaire->prepare("DELETE INTO  commentaire WHERE id =$commentaire_id and article_id=$article_id"); 
                
			header("location: article.php");
			exit(0);

        } catch(PDOException $e){
            die('Erreur PDO : ' . $e->getMessage());
        }catch(Exception $e){
            die('Erreur Générale : ' . $e->getMessage());
        }



    }

    


?>