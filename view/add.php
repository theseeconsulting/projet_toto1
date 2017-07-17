
<div class="panel panel-primary">

	 <div class="panel-heading">
	   <h3 class="panel-title">
		    <?php if (!empty($studentInfos['stu_id'])) : ?>
		    	Modification de <?= $studentInfos['stu_firstname'] ?> <?= $studentInfos['stu_lastname'] ?>
		    <?php else : ?>
		    	Ajout d'un étudiant
		    <?php endif; ?>
	    </h3>
	 </div>

	<div class="panel-body">

	  	<?php if (!empty($errorList)) : ?>
			<div class="alert alert-danger" role="alert">
			  <?php foreach ($errorList as $currentErrorText) : ?>
			  	<?= $currentErrorText ?><br>
			  <?php endforeach; ?>
			</div>
  		<?php endif; ?>
<!--
	action = fichier de destination des données du form
	method = méthode HTTP pour le transfert des données
 -->
		<form action="" method="post" enctype="multipart/form-data">

			<?php if (!empty($studentInfos['stu_image'])) :?>
				<img src="<?= $studentInfos['stu_image'] ?>" alt="" height="140" style="display:block;margin:auto;" /><br>
			<?php endif; ?>

	  		<div class="row">
		  		<div class="col-md-6 col-sm-6 col-xs-12"> <!--on insere une partie du form dans une colonne a gauche--> 
		
					<div class="form-group">
						<strong>Nom de l'étudiant</strong><br />
						<input type="text" class="form-control" value=<?= $studentInfos['stu_lastname'] ?>" name="newName" /><br />
					</div>

					<div class="form-group">
						<strong>Prénom de l'étudiant</strong><br />
						<input type="text" class="form-control" value="<?= $studentInfos['stu_firstname'] ?>" name="newFirstName" /><br />
					</div>

					<div class="form-group">
						<strong>Date de naissance</strong><br />	
						<input type="text" class="form-control" value="<?= $studentInfos['stu_birthdate'] ?>" name="newBirthdate" /><br />
					</div>	

					<div class="form-group">
						<strong>Email</strong><br />	
						<input type="text" class="form-control" value="<?= $studentInfos['stu_email'] ?>" name="newEmail" /><br />
					</div>
				</div>

				<!--colonne de droite-->

				 <div class="col-md-6 col-sm-6 col-xs-12">

					<div class="form-group">
						<strong>Niveau de sympathie</strong><br />	
							<select name="stu_friendliness" class="form-control">
								<option value="">choisissez</option>
								<?php for($i=0;$i<=5;$i++) : ?>
									<option value="<?= $i ?>"<?= $studentInfos['stu_friendliness'] == $i ? ' selected=selected"' : '' ?>><?= getSympathieLabelFromId($i) ?></option>
								<?php endfor; ?>
							</select>
					</div>

					<div class="form-group">
						<strong>Numero de session</strong><br />
							<br>
							<select name="ses_id" class="form-control">

							<option value="">Choisissez :</option>
							<?php foreach ($allsession as $currentSession) :?>

			<!-- on cree une variable intermediaire "$currentSession" car la $allsession comprend en valeur un tableau par session donc on cree la $currentsession pour associe chaque tableau à une variable spécifique -->
							
							<option value=""><?= $currentSession["ses_id"] ?></option>
							<?php endforeach; ?>
							</select>
						<br>
						<br>
					</div>

					<div class="form-group">
						<strong>Ville</strong><br />
						<select name="cit_name" class="form-control">

							<option value="">Choisissez :</option>
							<?php foreach ($allcities as $cit_id=>$currentcity) :?>
			<!--creation de la variable intermediaire $allcities-->
							<option value="<?= $currentcity["cit_id"] ?>"><?= $currentcity["cit_id"] ?> - <?= $currentcity["cit_name"] ?></option>
							<?php endforeach; ?>
							</select>
						<br>
						<br>
					</div>
				</div>	
			</div>
			
			<?php if (!empty($studentInfos['stu_id'])) : ?>
				<input type="submit" class="btn btn-success btn-block" value="Modifier" />
	    	<?php else : ?>
				<input type="submit" class="btn btn-success btn-block" value="Ajouter" />
			<?php endif; ?>
		</form>

<!-- il est tres tres important que la value saisie dans le NAME soit équivalente à celle saisie dans le tableau POST regroupant les variables $lastname et $firstname -->
	</div>
</div>
