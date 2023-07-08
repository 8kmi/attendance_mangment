<?php
    require 'header.php';
    session_start();
?>

<?php
    
    $currentUserId = $_SESSION['currentUserId'];
    // Tous les etudiants
    $etudiants = $connexion -> query("SELECT * FROM student order by nom")->fetchAll();

    $seance_id = 0;
    if(isset($_POST['see'])):
        $date = filter_input(INPUT_POST, 'date');
        $d_hour = filter_input(INPUT_POST, 'd-hour');
        $f_hour = filter_input(INPUT_POST, 'f-hour');
        
        // Recherche de la seance à laquelle on veut faire l'appel
        $seance = $connexion -> query("SELECT * FROM ue
                                        join seance  on ue.id = seance.ue_id AND seance.teacher_id = '$currentUserId'
                                        where heure_debut = '$d_hour' and heure_fin = '$f_hour' and seance_date = '$date' ") -> fetchAll();
        

        // var_dump($seance[0]['id']);
        // die();
        if(!empty($seance))
            $_SESSION['seanceId'] = $seance[0]['id'] ;
      
    endif;

    
?>

    <div class="container">
        <div class="row">
            <h4 class="text-center">Faire l'appel</h4>

            <div class="d-flex justify-content-center">
                <form class="mt-2" action="" method="post">
                    <div class="d-flex flex-row justify-content-around align-items-center">
                        <div class="mx-3">
                            <label for="dateInput" class="form-label h6">Date</label>
                            <input type="date" name="date" class="form-control " id="dateInput" required>
                        </div>

                        <div class="mx-3">
                            <label for="d-hourInput" class="form-label h6">Heure debut</label>
                            <input type="time" name="d-hour" class="form-control" id="d-hourInput" required>
                        </div>

                        <div class="mx-3">
                            <label for="f-hourInput" class="form-label h6">Heure fin</label>
                            <input type="time" name="f-hour" class="form-control" id="f-hourInput" required>
                        </div>

                        <div class="mx-3">
                            <button type="submit" name="see" class="btn btn-outline-success ">Afficher la Liste</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        
        <?php if(isset($seance) && !empty($seance)): ?>
            <div class="row mt-3">
                <h4 class="text-center text-uppercase">Informations sur la seance</h4>

                <table class="table table-success table-striped">
                    <thead class = "table-light">
                    <tr>
                        <th>UE</th>
                        <th>Date</th>
                        <th>Heure_debut</th>
                        <th>Heure_fin</th>
                        <th>Seance</th>
                    </tr>
                    </thead>

                    <tbody>
                        <?php foreach ($seance as $row) :?>
                            <tr>
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
            </div>
        
            <div class="row">
                <h4 class="text-center text-uppercase mt-2">Liste des etudiants</h4>
                <form action="traitement_appel.php" method="post">                  
                    <table class="table table-success table-striped mt-3">
                        <thead class = "table-light">
                        <tr>
                            <th>#</th>
                            <th>Nce</th>
                            <th>Nom</th>
                            <th>Prenom</th>
                            <th>DateNaissance</th>
                            <th>LieuNaissance</th>
                            <th>estPresent</th>
                        </tr>
                        </thead>

                        <tbody>
                            <?php 
                                $i = 0;
                                foreach ($etudiants as $row) :
                                    $i++;
                            ?>
                                <tr>
                                    <td>
                                        <?= $i ?>
                                    </td>
                                    <td>
                                        <?= $row['nce']; ?>
                                    </td>
                                    <td>
                                        <?= $row['nom']; ?>
                                    </td>
                                    <td>
                                        <?= $row['prenoms']; ?>
                                    </td>

                                    <td>
                                        <?= $row['date2naissance']; ?>
                                    </td>

                                    <td>
                                        <?= $row['lieu2naissance']; ?>
                                    </td>
                                    
                                    <td>
                                        <div class="d-flex justify-content-center">
                                            <input type="checkbox" class="form-check-input" checked value="<?=$row['id']?>" name="presence[]">  
                                        </div>
                                    </td>

                                </tr>
                            <?php endforeach;?>
                        </tbody>
                    </table>

                    <div class="d-flex justify-content-end">
                        <button type="submit" name="appel" class="btn btn-outline-danger">Enregistrer l'appel</button>
                    </div>
                </form>
            </div>
        <?php elseif(!isset($seance)) :?>
        
        <?php else:?>
            <div class="alert alert-warning mt-5">
                Aucune seance enregistrée avec ces coordonnées
            </div>
        <?php endif ;?>
    </div>

    

<?php
    require 'footer.php';
?>