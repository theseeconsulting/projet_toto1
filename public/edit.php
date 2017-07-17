<html>
	<head>
		<title>Upload de la fiche d'inscription</title>
		<meta charset="utf-8">
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

		<!-- Optional theme -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
	</head>

	<body>

		<div class="container">

		<pre>

			<?php

			//si le formulaire a ete soumis 

			if (!empty($_POST)){
				//si des fichiers ont ete uploadés 
				if(!empty($_FILES)){
					//je parcours tous les upload 
					foreach ($_FILES as $inputName => $fileData){
						$tmpExplode = explode('.', $fileData['name']);
						$extension = end($tmpExplode);

						//verification de l'extension
						if ($extension ='php'){
							echo 'Fichier invalide<br>';
						}
						else {
							echo 'Telechargement terminé<br>';
								}
					}
				}
			}

			?>
		</pre>
			<div class="row">

				<div class="col-md-2 col-sm-2 col-xs-0"></div>
				<div class="col-md-8 col-sm-8 col-xs-12">

					<form action="" method="post" enctype="multipart/form/data">
						<fieldset>
							<input type="hidden" name="studentidsubmitFile" value="1" />
							<label for="fileForm">Fichier</label>
							<input type="file" name="fileForm" id="fileForm" />
							<p class="help-block">Les extensions php ne sont pas autorisées</p>
							<br />
							<input type="submit" class="btn btn-success btn-block" value="Téléverser" />
						</fieldset>
					</form>
				</div>
				<div class="col-md-2 col-sm-2 col-xs-0"></div>
			</div>
	</body>
</html>

<?php

//- inclure le fichier de config dans chaque fichier "public"

require '../inc/config.php';

