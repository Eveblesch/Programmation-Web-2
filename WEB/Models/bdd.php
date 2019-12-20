<?php

const SQL_DSN = 'mysql:host=osr-mysql.unistra.fr;dbname=eblesch;charset=utf8';
const SQL_USERNAME = 'eblesch';
const SQL_PASSWORD = 'chouette';
try
{
	$bdd= new PDO(SQL_DSN,SQL_USERNAME, SQL_PASSWORD);
} 
catch(PDOException $e){
	echo "Erreur" . $e->getMessage();
	exit;
}

?>