<?php
        function creation_commentaire(string $description, int $article_id, string $article_id){
        try{
            $commentaire = new PDO('mysql:host=localhost;dbname=blog','root','');
            $commentaire->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $stmt = $commentaire->prepare("INSERT INTO  commentaire (id,description,article_id,pseudo) VALUES (?, ?, ?)"); 
                $stmt->bindParam(1, ?);
				$stmt->bindParam(2, $description);
                $stmt->bindParam(3, $article_id);
                $stmt->bindParam(4, $pseudo);



                $stmt->execute();
                   
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
                
			header("location: index.php");
			exit(0);

        } catch(PDOException $e){
            die('Erreur PDO : ' . $e->getMessage());
        }catch(Exception $e){
            die('Erreur Générale : ' . $e->getMessage());
        }



    }

    function compte_existant(string $pseudo, string $email){
        $connexion = new PDO('mysql:host=localhost;dbname=blog','root','');
        $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
        $slc_email = $connexion->prepare("SELECT email FROM utilisateur WHERE email = ?");
        $slc_email->bindParam(1, $email);
        $slc_email->execute();


        $slc_pseudo = $connexion->prepare("SELECT pseudo FROM utilisateur WHERE pseudo = ?");
        $slc_pseudo->bindParam(1, $pseudo);
        $slc_pseudo->execute();

       
       

        if($slc_pseudo->fetch() == false && $slc_email->fetch() == false){
            return false;
        }
        else
            return true;

  
    }



?>