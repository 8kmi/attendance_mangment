<?php
    require 'header.php';

    session_start();

    $currentUserId = $_SESSION['currentUserId'];
    $ues = $connexion -> query("SELECT * FROM ue where teacher_id = $currentUserId");


    if(isset($_POST['create'])):
        $ue_id = filter_input(INPUT_POST, 'ue_id', FILTER_SANITIZE_NUMBER_INT);
        $date = filter_input(INPUT_POST, 'date');
        $d_hour = filter_input(INPUT_POST, 'd-hour');
        $f_hour = filter_input(INPUT_POST, 'f-hour');
        $type = filter_input(INPUT_POST, 'type');


        $data = [
            'date_seance'  => $date,
            'heure_debut'  => $d_hour,
            'heure_fin'    => $f_hour,
            'ue_id'        => $ue_id,
            'teacher_id'   => $currentUserId,
            'type_seance'  => $type
        ];


        $sql = "INSERT INTO seance (seance_date, heure_debut, heure_fin, ue_id, teacher_id, type_seance) VALUES (:date_seance, :heure_debut, :heure_fin, :ue_id, :teacher_id, :type_seance)";
        $stmt = $connexion->prepare($sql);
        $stmt->execute($data);

        header("Location:index.php");
    endif;

?>
    <div class="container d-flex justify-content-center align-items-center">
        <div class="card my-5 w-75">
            <div class="card-header h5">Creation d'une seance</div>
            
            <div class="card-body">
                <form action="" method="POST">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label  h6">Unité d'enseignement*</label>
                        <select name="ue_id" class="form-select form-select-sm" required>
                            <option selected value="">Choisir l' UE de la seance</option>
                            <?php
                                while ($ue = $ues->fetch()) :
                                    echo "<option value=\"$ue[id]\">$ue[libelle]</option>";
                                endwhile;
                            ?>
                        </select>                        
                    </div>
                    <div class="mb-3">
                        <label for="date1" class="form-label h6">Date*</label>
                        <input type="date" name="date" class="form-control" id="date1" required>
                    </div>

                    <div class="mb-3"> 
                        <label for="time1" class="form-label h6">heure de debut*</label>
                        <input type="time" name="d-hour" class="form-control" id="time1" required>
                    </div>

                    <div class="mb-3"> 
                        <label for="exampleInputEmail1" class="form-label h6">heure de fin*</label>
                        <input type="time" name="f-hour" class="form-control" id="exampleInputEmail1" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label h6">Type de cours*</label>
                        <select name="type" class="form-select form-select-sm" required>
                            <option value="" selected>Choisir le type de cours</option>
                            <option value="CM">CM</option>
                            <option value="TD">TD</option>
                            <option value="TP">TP</option>
                        </select>                        
                    </div>

                    <div class="d-flex justify-content-evenly">
                        <a class="btn btn-outline-secondary ml-3" href="/">Annuler</a>  
                        <button type="submit" name="create" class="btn btn-outline-success">Creer</button>           
                    </div>
                    
                </form>
            </div>
        </div>
    </div>
<?php
    require 'footer.php';
?>