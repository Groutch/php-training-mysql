<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Randonnées</title>
    <link rel="stylesheet" href="css/basics.css" media="screen" title="no title" charset="utf-8">
  </head>
  <body>
    <a href="index.php">Retour accueil</a>
    <h1>Liste des randonnées</h1>
    <table>
        <tr>
            <td><h4>Nom</h4></td>
            <td><h4>Difficulté</h4></td>
            <td><h4>Distance</h4></td>
            <td><h4>Durée</h4></td>
            <td><h4>Dénivelé</h4></td>
            <td><h4>Disponibilité</h4></td>
        </tr>
      <!-- Afficher la liste des randonnées -->
        <?php
        session_start ();
        include 'connect.php';
        try{
            foreach($pdo->query("SELECT * FROM hiking") as $row){
                echo "<tr>";
                echo "<td>".$row['name']."</td>";
                echo "<td>".$row['difficulty']."</td>";
                echo "<td>".($row['distance']/1000)." km"."</td>";
                echo "<td>".$row['duration']."</td>";
                echo "<td>".$row['height_difference']." m"."</td>";
                if($row['available']==1){
                    echo "<td>Disponible</td>";
                }else{
                    echo "<td>Pas disponible</td>";
                }
                if(isset($_SESSION['username'])){
                    echo "<td><a href='update.php?id=".$row['id']."'>Modifier</a></td>";
                    echo "<td><a href='delete.php?id=".$row['id']."'>Supprimer</a></td>";
                }
                echo "</tr>";
            }
            $pdo=NULL;
        }catch(PDOException $e){
            print "Erreur:".$e->getMessage()."<br>";
            die();
        }
        ?>
    </table>
  </body>
</html>
