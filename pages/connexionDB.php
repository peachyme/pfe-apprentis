<?php	

    $server = "localhost";
    $database = "ges_app";
    $login = "root";
    $password = "";


	try 
    {
        $connexion = new PDO("mysql:host=$server;dbname=$database", $login, $password);
        $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e)
    {
        die("Erreur : Echec de la connextion : " . $e->getMessage());
    }

?>