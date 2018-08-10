<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Ajouter une randonnée</title>
	<link rel="stylesheet" href="css/basics.css" media="screen" title="no title" charset="utf-8">
</head>
<body>
	<a href="read.php">Liste des données</a>
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
                foreach($pdo->query("SELECT * FROM hiking WHERE id=".$id) as $row){
                    $name = $row['name'];
                    $difficulty = $row['difficulty'];
                    $distance = $row['distance'];
                    $duration = $row['duration'];
                    $height = $row['height_difference'];
                    $available = $row['available'];
                }
                $pdo=NULL;
            }catch(PDOException $e){
                print "Erreur:".$e->getMessage()."<br>";
                die();
            }
        }
    ?>
	<h1>Modifier</h1>
	<form action="update.php" method="post">
		<div>
			<label for="name">Name</label>
			<input type="text" name="name" value="<?php echo $name ?>">
            <input type="hidden" name="id" value="<?php echo $id ?>">
		</div>
            
		<div>
			<label for="difficulty">Difficulté</label>
			<select name="difficulty">
				<option value="très facile" <?php if ($difficulty=="très facile"){ ?> selected="selected" <?php }?> >Très facile</option>
				<option value="facile" <?php if ($difficulty=="facile"){ ?> selected="selected" <?php }?> >Facile</option>
				<option value="moyen" <?php if ($difficulty=="moyen"){ ?> selected="selected" <?php }?> >Moyen</option>
				<option value="difficile" <?php if ($difficulty=="difficile"){ ?> selected="selected" <?php }?> >Difficile</option>
				<option value="très difficile" <?php if ($difficulty=="très difficile"){ ?> selected="selected" <?php }?> >Très difficile</option>
			</select>
		</div>
		
		<div>
			<label for="distance">Distance</label>
			<input type="number" name="distance" value="<?php echo $distance ?>">
		</div>
		<div>
			<label for="duration">Durée</label>
			<input type="time" name="duration" value="<?php echo $duration ?>">
		</div>
		<div>
			<label for="height_difference">Dénivelé</label>
			<input type="number" name="height_difference" value="<?php echo $height ?>">
		</div>
        
        <div>
			<label for="available">Disponibilité</label>
			<select name="available">
				<option value="1"<?php if($available==1){ ?> selected="selected" <?php }?> >Disponible</option>
				<option value="0"<?php if($available==0){ ?> selected="selected" <?php }?> >Pas disponible</option>
			</select>
		</div>
        
		<button type="submit" name="button">Envoyer</button>
	</form>
    <?php
    if(isset($_POST['name']) && isset($_POST['difficulty']) && isset($_POST['distance'])  && is_numeric($_POST['distance']) && isset($_POST['duration']) && isset($_POST['height_difference']) && is_numeric($_POST['height_difference']) && isset($_POST['available'])){
        $name = filter_var($_POST['name'],FILTER_SANITIZE_STRING);
        $difficulty = $_POST['difficulty'];
        $distance = $_POST['distance'];
        $duration = $_POST['duration'];
        $height = $_POST['height_difference'];
        $available = $_POST['available'];
        $id = $_POST['id'];
        try{
            $req  = $pdo->prepare("UPDATE hiking SET name='".$name."', difficulty='".$difficulty."', distance=".$distance.", duration='".$duration."', height_difference=".$height.",available=".$available." WHERE id=".$id);
            print_r($req);
            if($req->execute()){ ?>
                <script>alert("Bien enregristré");</script>
            <?php 
                header('Location: index.php');
                exit();
            }else{ ?>
                <script>alert("Il y a eu un soucis");</script>
            <?php }
        }catch(PDOException $e){
            print "Erreur:".$e->getMessage()."<br>";
            die();
        }
    }
    ?>
</body>
</html>
