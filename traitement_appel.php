<?php
    require 'connexion.php';
    session_start();

   
    $students = $connexion -> query("SELECT * FROM student order by nom")->fetchAll();

    // $_SESSION['seanceId']
    @$presenceList = $_POST['presence'];

    if(isset($_POST['appel'])) :
        foreach ($students as $student)
        {
            $sql = "INSERT INTO absence (isPresent, seance_id, student_id) VALUES (?,?,?)";
            $stmt = $connexion->prepare($sql);
            
            
            if(in_array($student['id'],$presenceList))        
                $stmt->execute([1, $_SESSION['seanceId'],$student['id']]);
            else
                $stmt->execute([0, $_SESSION['seanceId'],$student['id']]);
        }


        header("Location:index.php");
    endif;

?>