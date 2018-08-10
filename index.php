<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Ajouter une randonnée</title>
	<link rel="stylesheet" href="css/basics.css" media="screen" title="no title" charset="utf-8">
</head>
<body>
    <ul>
        <?php
        session_start ();
        if(isset($_SESSION['username'])) {
        ?>
        <li><a href="logout.php">Se déconnecter</a></li>
        <li><a href="create.php">Créer une randonnée</a></li>
        <?php }else{ ?>
        <li><a href="login.php">Se connecter</a></li>
        <?php } ?>
        <li><a href="read.php">Liste des données</a></li>
        
        
    </ul>
</body>
</html>
