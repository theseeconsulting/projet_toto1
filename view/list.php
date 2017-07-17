<div class="panel panel-primary">
  <div class="panel-heading">
    <h3 class="panel-title">Liste des étudiants</h3>
  </div>
  <div class="panel-body">
    <?= $introductionText ?><br><br>
    <div class="col-md-3 text-left">
    <?php if ($page > 1) : ?>
      <a href="list.php?page=<?= ($page-1) ?>&ses_id=<?=$sessionId?>" class="btn btn-sm btn-info">précédent</a>
  <?php endif; ?>
    </div>
    <div class="col-md-6 text-center">
    <?php for ($i=1;$i<=$maxPageNum;$i++) : ?>
    <a href="?page=<?= $i ?>&ses_id=<?=$sessionId?>" class="btn btn-info btn-xs"><?= $i ?></a>
    <?php endfor; ?>
    </div>
    <div class="col-md-3 text-right">
    <?php if ($page < $maxPageNum) : ?>
      <a href="list.php?page=<?= ($page+1) ?>&ses_id=<?=$sessionId?>" class="btn btn-sm btn-info">suivant</a>
  <?php endif; ?>
    </div>
  </div>
<?php if (isset($studentListe) && sizeof($studentListe) > 0) : ?>
        <table class="table table-inverse">
          <thead>
            <tr>
              <th>Id</th>
              <th>Nom</th>
              <th>Prenom</th>
              <th>Email</th>
              <th>Date de naissance</th>
              <th>Lien vers l'étudiant</th>
            </tr>
          </thead>

          <tbody>

<?php foreach ($studentListe as $currentEtudiant):?>
            <tr>
              <td><?php echo $currentEtudiant["stu_id"]?></td>
              <td><?php echo $currentEtudiant['stu_lastname']?></td>
              <td><?php echo $currentEtudiant['stu_firstname']?></td>
              <td><?php echo $currentEtudiant['stu_email']?></td>
              <td><?php echo $currentEtudiant['stu_birthdate']?></td>
              <td>
              <a href="student.php?Id=<? $currentEtudiant["stu_id"]?>" class="btn btn-primary">Lien vers la fiche de l'étudiant</a></td>
              <td>
          <!-- Single button -->
                  <div class="btn-group">
                      <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <span class="glyphicon glyphicon-trash"></span>
                      </button>
                        <ul class="dropdown-menu">
                          <li><a href="list.php?deleteStudentId=<?= $currentEtudiant['stu_id'] ?>">Supprimer</a></li>
                          <li><a href="#">Annuler</a></li>
                        </ul>
                  </div>
                </td>
            </tr>

<!--le lien ne fonctionnait pas car la variable $studentId n'etait pas defini dans le fichier view/list.
Il s'agissait alors de trouver une affectation de cette variable dans le code existant. 
$studentId = $currentEtudiant['stu_id']
on remplace la variable par son affectation dans le code -->

<?php endforeach; ?>

          </tbody>
        </table>
<?php else :?>
  aucun étudiant
<?php endif; ?>
      </div>

