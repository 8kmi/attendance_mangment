<?php
    require 'header.php';
    session_start();
?>

<?php

    if(isset($_SESSION['seanceId'])) :
        $sId = $_SESSION['seanceId'];
        $current_seance = $connexion -> query("select * from seance where id = '$sId'")->fetch();

        

        $absences = $connexion -> query('SELECT * from absence
                                        join student on absence.student_id = student.id
                                        join seance on seance.id = absence.seance_id
                                        join ue on ue.id = seance.ue_id
                                        where absence.isPresent = 1') -> fetchAll();
    endif;
?>


    <div class="container">
        <h4 class="text-center">Liste des eleves absents</h4>
    </div>

   
    <div class="alert alert-warning">
        Liste des eleves absents à chaque seance
    </div>

  

<?php
    require 'footer.php';
?>