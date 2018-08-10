<?php
    session_start ();
    if(!isset($_SESSION['username'])){
        header('Location: index.php');
        exit();
    }
    include 'connect.php';
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        try{
            $req  = $pdo->prepare("DELETE FROM hiking WHERE id=".$id);
            if($req->execute()){  
                header('Location: index.php');
                exit();
            }else{ ?>
                <script>
                    alert("Il y a eu un soucis");
                </script>
            <?php }
        }catch(PDOException $e){
            print "Erreur:".$e->getMessage()."<br>";
            die();
        }
    }

