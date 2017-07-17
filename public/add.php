<?php

//- inclure le fichier de config dans chaque fichier "public"

require '../inc/config.php';

/*la methode GET recupère les données dans l'url ce qui n'est pas une approche sécurisée notamment si les données proviennent de l'exterieur donc on passe par POST qui sera un tableau s'il est suivi de []*/

if (!empty($_POST)) {

/*après soumissions du formulaire, récupérer les données envoyées en POST par le formulaire*/

//Recuperation de la donnée $newstudentlastname
// trim: Supprime les espaces (ou d'autres caractères) en début et fin de chaîne

$lastname = isset($_POST['newName']) ? strip_tags(trim($_POST['newName'])) : '';

//print_r ($_POST).'<br>';

//strip_tags: Supprime les balises HTML et PHP d'une chaîne

//echo $lastname;

//Recuperation de la donnée $newstudentfirstname

$firstname = isset($_POST['newFirstName']) ? strip_tags(trim($_POST['newFirstName'])) : '';

//echo $firstname;


//récupération de la donnée $newstudentBirthdate

$birthdate = isset($_POST['newBirthdate']) ? strip_tags(trim($_POST['newBirthdate'])) : '';

//récupération de la donnée $newstudentEmail

$email = isset($_POST['newEmail']) ? strip_tags(trim($_POST['newEmail'])) : '';

//récupération de la donnée $newstudentfriendliness

$friendliness = isset($_POST['newFriendliness']) ? strip_tags(trim($_POST['newFriendliness'])) : '';

//récupération de la donnée $newSession

$session = isset($_POST['newSession']) ? strip_tags(trim($_POST['newSession'])) : '';

//récupération de la donnée $newCity

$city = isset($_POST['newCity']) ? strip_tags(trim($_POST['newCity'])) : '';




// Je considère les données valides avant de les valider
$formValid = true;

// 2 - Validation des données

//Lastname

if (empty($lastname)) {
	$formValid = false;
	echo 'Veuillez renseigner le champ nom<br>';
	}
else if (strlen($lastname) < 2) {
	$formValid = false;
	echo 'Le champ nom doit contenir au moins 2 caractères<br>';
	}

//Firstname

if (empty($firstname)) {
		$formValid = false;
		echo 'Veuillez renseigner le champ prénom<br>';
	}
else if (strlen($firstname) < 2) {
		$formValid = false;
		echo 'Le champ prénom doit contenir au moins 2 caractères<br>';
	}

//Birthdate

if (empty($birthdate)) {
	$formValid = false;
	echo "Veuillez renseigner la date d'anniversaire<br>";
}
else if (strlen($birthdate) < 2) {
	$formValid = false;
	echo 'Le champ anniversaire doit contenir au moins 2 caractères<br>';
	}

//email

if (empty($email)) {
	$formValid = false;
	echo "Veuillez renseigner le champ email<br>";
}
else if (strlen($email) < 2) {
	$formValid = false;
	echo 'Le champ email doit contenir au moins 2 caractères<br>';
	}

//friendliness

if (empty($friendliness)) {
	$formValid = false;
	echo "Veuillez renseigner la sympathie<br>";
}
else if (strlen($friendliness) < 2) {
	$formValid = false;
	echo 'Le champ sympathie doit contenir au moins 2 caractères<br>';
	}

//session

if (empty($session)) {
	$formValid = false;
	echo "Veuillez renseigner la session<br>";
}
else if (strlen($session) < 2) {
	$formValid = false;
	echo 'Le champ session doit contenir au moins 2 caractères<br>';
	}

//city

if (empty($city)) {
	$formValid = false;
	echo "Veuillez renseigner la city<br>";
}
else if (strlen($city) < 2) {
	$formValid = false;
	echo 'Le champ city doit contenir au moins 2 caractères<br>';
	}

/*Si toutes les données sont valides, ajouter en DB*/

if ($formValid) {
		echo 'Données valides'.'<br>';
		echo 'Lastname : '.$lastname.'<br>';
		echo 'Firstname : '.$firstname.'<br>';
		echo 'Birthdate : '.$birthdate.'<br>';
		echo 'Email : '.$email.'<br>';
		echo 'Friendliness : '.$friendliness.'<br>';
		echo 'Session : '.$session.'<br>';
		echo 'City : '.$city.'<br>';
	}

//Insertion du nouvel etudiant dans la database
// J'écris ma requête SQL dans une variable

		$sql = '
		INSERT INTO student (stu_lastname, stu_firstname, stu_birthdate, stu_email, stu_friendliness, session_ses_id, city_cit_id)
		VALUES (:lastname, :firstname, :birthdate, :email, :friendliness, :session_ses, :city_cit);
		';

		$pdoStatement = $pdo->prepare($sql);

// BindValues for lastname

		$pdoStatement->bindValue(':lastname', $lastname);
		$pdoStatement->bindValue(':firstname', $firstname);
		$pdoStatement->bindValue(':birthdate', $birthdate);
		$pdoStatement->bindValue(':email', $email);
		$pdoStatement->bindValue(':friendliness', $friendliness);
		$pdoStatement->bindValue(':session_ses', $session);
		$pdoStatement->bindValue(':city_cit', $city);

		// Si erreur
		if($pdoStatement->execute() === false) {
			//print_r($pdoStatement->errorInfo());
		}
		else{
			$lastStudentId = $pdo->lastInsertId();
		}


/*--Pour retourner vers la page etudiant du dernier etudiant ajouté on doit recuperer l'id (lastStudentId)*/

echo 'L\'ID de la dernière ligne insérée est #'.$lastStudentId.'<br>';

//rediriger sur la page "student" de l'étudiant ajouté

/*header: permet de spécifier l'en-tête HTTP string lors de l'envoi des fichiers HTML*/

/*il doit se trouver dans le "if" pour pas que la redirection se fasse systematiquement*/ 

header("Location:student.php?Id=$lastStudentId");

}


/*récupérer toutes les villes de la DB (ou utiliser l'array)*/

//on cree une nouvelle variable qui regroupera l'ensemble des données récoltées

$allcities = array();

//chaque ville est identifiable via son id ou son nom cit_name

$sql='
	SELECT cit_name, cit_id
	FROM city
';

/*La requete porte sur la collecte de données de la database donc la requete est securiée, un query est ok.
La nouvelle variable qui nous apportera les données recherchées sera en statement puisqu'elle est issue d'une requete */

$stmtcityname = $pdo->query($sql);//format generique d'une variable statement et methode query 

	// J'exécute
	//si une erreur est presente dans la requete alors:
	if ($stmtcityname === false) {//lorsque l'on fait une query il n'est pas necessaire de faire "execute"... la condition est simplifié au === false
		//print_r($stmtcityname->errorInfo());
	}
	// si par erreur dans la requete:
	else {
		$allcities = $stmtcityname->fetchAll(PDO::FETCH_ASSOC);
		//print_r($allcities);
	}

//récupérer toutes les sessions de la DB

//on cree une variable intermediaire qui compilera l'ensemnle des données récoltées

$allsession = array();

//chaque session est identifiable par son id et son nom

$sql='
	SELECT ses_id
	FROM session
';

//requete sql donc création d'une variable STATEMENT

$stmtsession = $pdo->query($sql);

//j'execute en testant l'existence 

if ($stmtsession === false){
	//print_r($stmtsession->errorInfo());
}	
else{
	$allsession = $stmtsession->fetchAll(PDO::FETCH_ASSOC);
	//print_r($allsession);
}

require '../view/header.php';
require '../view/add.php';
require '../public/edit.php';
require '../view/footer.php';
?>