<?php

//- inc/db.php :
//	* écrire le code de connexion à la base de données (PDO + dsn) en se basant sur les valeurs du tableau $config

$dsn="mysql:dbname={$config['db_database']};host={$config['db_host']}; charset=UTF8";

try{
	$pdo=new PDO($dsn,$config['db_user'],$config['db_password']);
	//code permettant d'identifier le type d'erreur:
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(Exception $e){
	echo $e->getMessage();
}

?>