<?php
// adresse de la base de donn�e. Vu qu'ici la base de donn�e SQL est 
// stock�e sur le m�me serveur que le site, �a sera "localhost"
define("HOST", "localhost");
// nom d'utilisateur de la db, ici "root" (le nom de compte du compte admin par d�faut)
define("DBUSER", "root");
// mot de passe de cet utlisateur ( jamais visible � la personne visitant le site)
define("PASS", "");
// Nom de la db utilis�e
define("DB", "login");
 
// utilisation d'une fonction de php permettant de se connecter � une db
$conn = mysql_connect(HOST, DBUSER, PASS) or  die("Connexion impossible!<br />Contactez l'administrateur!");
 
$db = mysql_select_db(DB) or  die("Connexion impossible!<br />Contactez l'administrateur!");
 
?>