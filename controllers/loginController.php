<?php   require_once('../../models/db_trait.php');
        require_once('functions.php');

        use PDOtrait;

        class LoginController {
            use PDOtrait;

            public function login(){
        
            if(!getToken()){
                if(isset($_POST['submit'])){
                    if(!empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['password'])){
                        $sql = $dbh->prepare('SELECT * FROM Administrateur WHERE nom_admin = :nom AND prenom_admin = :prenom LIMIT 1');
                        $sql->bindValue(':nom',$_POST['nom'],PDO::PARAM_STR);
                        $sql->bindValue(':prenom',$_POST['prenom'],PDO::PARAM_STR);
                        $sql->execute();
                        //vérification avec RowCount si je n'ai pas de résultat
                        if($sql->rowCount() == 0){
                            echo 'nom prenom introuvable';
                             exit;
                        }
                         // retourne la ligne de ma requête sous un tableau associatif
                        $resultat = $sql->fetch(PDO::FETCH_ASSOC);
                        // vérification si le mot de passe est OK
                        if(password_verify($_POST['password'],$resultat['password'])){
                            //création du cookie de connexion
                            setcookie('id',$resultat['ID_admin'],(time()+3600));
                            setcookie('passwd',$resultat['password'],(time()+3600));
                            $infos_cookie = array(
                                'id'        => $resultat['ID_admin'],
                                'passwd'    =>$resultat['password']);
                                setcookie('admin',serialize($infos_cookie),(time()+3600));    
                                echo 'Bonjour '.$resultat['nom_admin'].' '.$resultat['prenom_admin'];
                                echo '<br>';
                                // génération du token
                                $token = setToken(password_hash($_POST['password'],PASSWORD_BCRYPT));
                                echo '<a href="index.php?token='.$token.'">Se rendre au TDB</a>';
                                }
                            else
                                {
                             echo 'le mot de passe ne correspond pas';
                        }

                     }
                }
                exit;
            }
            else
            /// vérification présences cookies
                if($_COOKIE['id'] && $_COOKIE['passwd']){
                // Pour récupérer les infos du cookie user (serialisé)
                    $cookie_infos = unserialize($_COOKIE['admin']);
                    //var_dump($cookie_infos);
                    $sql = $dbh->prepare('SELECT * FROM  Administrateur WHERE ID_admin=:id LIMIT 1');
                    $sql->bindValue(':id',$_COOKIE['id'],PDO::PARAM_STR);
                    $sql->execute();
                    if($sql->rowCount() == 1){
                        $resultat = $sql->fetch(PDO::FETCH_ASSOC);
                        if(password_verify($_COOKIE['password'],$resultat['password'])){
                            $_SESSION['connect'] = 1;
                            require('../../views/back/indexFormation.php');
                            echo 'Bienvenue '.$resultat['prenom_admin'];
                        }
                    }  
               }
        }
       }
    $loginController = new LoginController();
    $loginController->login();
?>