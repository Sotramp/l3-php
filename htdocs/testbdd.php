<?php

// Connexion à la base de données
$user = 'root';
$pass = 'password';

$db = new PDO('mysql:host=mysql;dbname=eurovent', $user, $pass);

// CREATE TABLE
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sql ="CREATE TABLE IF NOT EXISTS clients(
     ID INT(11) AUTO_INCREMENT PRIMARY KEY,
     prenom VARCHAR(50) NOT NULL, 
     nom VARCHAR(50) NOT NULL,
     adresse VARCHAR(250) NOT NULL);";
$db->exec($sql);
print("Table créée.\n");

// INSERT
$insert = "INSERT INTO clients(prenom, nom, adresse) VALUES('Gauthier', 'Marette', '16 rue des Parapentes, Paris 75000')";
$request = $db->prepare($insert);
$request->execute();

// SELECT
foreach ($db->query('SELECT * from clients') as $row) {
    print_r($row);
}