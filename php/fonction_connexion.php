<?php
        function creation_compte(string $pseudo, string $email, string $mdp){
        try{
            $connexion = new PDO('mysql:host=localhost;dbname=blog','root','');
            $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $stmt = $connexion->prepare("INSERT INTO  utilisateur (pseudo,email,mdp) VALUES (?, ?, ?)"); //renvoie un 'statement' qu'il faut enregistrer
                $stmt->bindParam(1, $pseudo);
                $stmt->bindParam(2, $email);
                $stmt->bindParam(3, $mdp);



                $stmt->execute();
                $_SESSION["connecter"] = true;
                $_SESSION["pseudo"] = $pseudo;   
                $_SESSION["id"]  = $connexion->lastInsertId(); //permet d'obtenir l'id de l'utilisateur car on utilise un auto increments
                header("location: accueil.php"); 



        } catch(PDOException $e){
            die('Erreur PDO : ' . $e->getMessage());
        }catch(Exception $e){
            die('Erreur Générale : ' . $e->getMessage());
        }

        }

        function connexion(string $pseudo, string $email, string $mdp){
            try{
            $connexion = new PDO('mysql:host=localhost;dbname=blog','root','');
            $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


            $compte_existant = compte_existant($pseudo,$email);

            if($compte_existant === true){
                $stmt = $connexion->prepare("SELECT id,pseudo,email,mdp,admin FROM utilisateur WHERE pseudo = ?");
                $stmt->bindParam(1, $pseudo);
                $stmt->execute();

                $utilisateur = $stmt->fetch(PDO::FETCH_ASSOC);
                if ($utilisateur === false) {
                    return -1; //pseudo incorrect
                }
                else if($utilisateur['email'] != $email){
                    return -2;
                }
                else if($utilisateur['mdp'] != $mdp){
                    return -3;
                }
                $_SESSION["connecter"] = true;
                $_SESSION["pseudo"] = $pseudo;   
                $_SESSION["id"] = $id;  
                if($utilisateur['admin'] == 0){
                    $_SESSION["admin"] = true;

                }

                header("location: index.php"); 


            }
            else{
                creation_compte($pseudo,$email,$mdp);
            }
            


            

 

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