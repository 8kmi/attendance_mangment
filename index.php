<?php
    require('header.php');

    session_start();
    if(!isset($_SESSION['currentUserId']))
    {
        header("Location: login.php");
        exit();
    }

    $currentUserId = $_SESSION['currentUserId'];
    $currentUser = $connexion -> query("SELECT nom,prenoms from teacher where id = $currentUserId") -> fetch();
 
    $ues = $connexion -> query("SELECT * FROM ue where teacher_id = $currentUserId") -> fetchAll();

    // $sessions = $connexion -> query("SELECT * FROM session where teacher_id = $currentUserId") -> fetchAll();
    $seances = $connexion->query("SELECT * FROM seance JOIN ue on ue.id = seance.ue_id AND seance.teacher_id = '$currentUserId';") -> fetchAll() ;

    
    
?>



  <div class="container-fluid mt-3">
      <div class="row d-flex justify-content-center">
        <h3 class="text-center mb-3">Bienvenue Mr <?= $currentUser['nom'] ?>  </h3>

        <div class="col-lg-8">
          <div class="card">
              <div class="card-header">Mes unités d' enseignement</div>
              <div class="card-body">
                <ul class="list-group list-group-flush">
                  <?php
                      $i = 0;
                      foreach ($ues as $row) :
                        $i++;
                  ?>
                    <li class="list-group-item">
                      <?= $i . ' - ' . $row['libelle']?>
                    </li>
                  <?php endforeach;?>
                </ul>
              </div>
          </div>
        </div>
        <div class="col-lg-8 mt-4">
            <div class="card">
              <div class="card-header"> Mes seances de cours </div>
              <div class="card-body">
                <?php
                  if(count($seances) == 0):
                ?>
                  <div class="alert alert-warning m-3">
                          Aucune seance enregistrée
                  </div>
                <?php else : ?>
                    <table class="table table-success table-striped">
                      <thead class = "table-light">
                        <tr>
                            <th>#</th>
                            <th>UE</th>
                            <th>Date</th>
                            <th>heure_debut</th>
                            <th>heure_fin</th>
                            <th>Type</th>
                        </tr>
                      </thead>

                      <tbody>
                          <?php
                            $i = 0;
                            foreach ($seances as $row) :
                                $i++;
                          ?>
                              <tr>
                                  <td>
                                      <?= $i; ?>
                                  </td>
                                  <td>
                                      <?= $row['libelle']; ?>
                                  </td>
                                  <td>
                                      <?= $row['seance_date'] ?>
                                  </td>
                                  <td>
                                      <?= $row['heure_debut']; ?>
                                  </td>
                                  <td>
                                      <?= $row['heure_fin']; ?>
                                  </td>

                                  <td>
                                      <?= $row['type_seance']; ?>
                                  </td>
                              </tr>
                          <?php endforeach;?>
                      </tbody>
                    </table>
                <?php endif; ?>
              </div>
            </div>
        </div>
      </div>
  </div>
      
      

<?php
  require('footer.php');
?>