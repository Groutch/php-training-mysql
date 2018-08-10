<?php
    session_start();
    include 'connect.php';
    echo "coco";
    if(isset($_POST['username']) && isset($_POST['password'])){
         $username = filter_var($_POST['username'],FILTER_SANITIZE_STRING);
         $password = filter_var($_POST['password'],FILTER_SANITIZE_STRING);
         try{
             $req  = $pdo->prepare("SELECT * FROM user WHERE username='".$username."'");
             $req->execute();
             $row = $req->fetchAll();
             print_r($row);
             if($row[0]['password']==sha1($password)){
                 echo "Bon PWD";
                 $_SESSION['username'] = $username;
                 header ('Location: index.php');
                 exit();
             }else{
                 header ('Location: login.php');
                 exit();
             }
             
         }catch(PDOException $e){
             print "Erreur:".$e->getMessage()."<br>";
             die();
         }
     }
