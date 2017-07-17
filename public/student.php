<?php

//- inclure le fichier de config dans chaque fichier "public"

require '../inc/config.php';

/*on cherche l'ensemble des informations associées à chaque client

on distingue chaque etudiant par son ID, la première variable crée sera donc celle de $StudentId que l'on va affecté de la manière suivante:*/

/*En etape preliminaire, on cree une variable qui regroupera l'ensemble des données collectées par la requete */
$studentInfo = array();

$studentId = 0; //StudentId = 0 par defaut 
if (isset($_GET['Id'])) { // si studentId n'est pas = à 0 alors $studentId = un nombre entier lu dans l'URL par la methode GET
	$studentId = intval($_GET['Id']);
}
/* la variable correspondante à l'id de chaque étudiant n'est pas nulle et est égale à un Integer (chiffre entier) que l'on obtiendra par la methode GET qui permet de lire les données saisies exterieurement par formulaire ou dans l'url*/

$studentLastname = '';
$studentFirstname = '';
$studentEmail = '';
$studentBirthdate = '';
$studentAge = '';
$studentFriendliness = '';
$studentCity = '';
$studentCountry = '';

/*On redige une requete (dans ds sql car les requetes sont toujours dans sql)  */


$sql = '
	SELECT stu_id, stu_lastname, stu_firstname, cou_name, cit_name, stu_friendliness, stu_email, stu_birthdate
	FROM student
	LEFT OUTER JOIN city ON city.cit_id = student.city_cit_id
	LEFT OUTER JOIN country ON country.cou_id = city.country_cou_id
	WHERE stu_id = :stu_id /*j\'utilise un token car les données sont externes (donc pas confiance -> donc fonction "prepare" (et non pas query) et du coup -> on cree un bindValue entre la variable recherchée ($stuId et un token ":StuId"))*/
	LIMIT 1 /*optionnel*/
';

/* la requete porte sur des données saisies exterieurement donc on fait la requete avec prepare (et non query) et on cree une nouvelle variable qui permettra de lire les données associées à l'id. Cette variable sera STATEMENT car elle fait appel à une requete sql*/ 

$stmtId = $pdo->prepare($sql); //format generique avec la variable STATEMENT et la methode prepare 

//la methode "prepare" appelle un bindValue qui crée un lien entre la variable qui lira le resultat de la requete (donc statement), le token et et et la variable de recherche initiale avec PDO::PARAM_INT pour indiquer que c'est un integer que nous recherchons

	// Binds
	$stmtId->bindValue(':stu_id',$studentId, PDO::PARAM_INT);
	// J'exécute
	//si une erreur est presente dans la requete alors:
	if ($stmtId->execute() == false) {
		print_r($stmtId->errorInfo());
	}
	// si par erreur dans la requete:
	else {
		$studentInfo = $stmtId->fetch(PDO::FETCH_ASSOC);
		//print_r($studentInfo);
		$studentLastname = $studentInfo ['stu_lastname'];
		$studentfirstname = $studentInfo ['stu_firstname'];
		$studentemail = $studentInfo ['stu_email'];
		$studentbirthdate = $studentInfo ['stu_birthdate'];
		$studentFriendliness = getSympathieLabelFromId($studentInfos['stu_friendliness']);
		$studentAge = calculAge($studentBirthdate);
		$studentCity = $studentInfos['cit_name'];
		$studentCountry = $studentInfos['cou_name'];
	}

require '../view/header.php';
require '../view/student.php';
require '../view/footer.php';