<?php
    require_once("bd/connexion.php");
    require_once "header_doc.php";

    $matiere = filter_input(INPUT_POST,"matiere");
    /* recuperation des etudiants dans la bd */
    $listDesEtudiants = $connexion->query("SELECT * FROM etudiants ORDER BY id")->fetchAll();
    
    
    @$listPresent = $_POST['choix'];
    $ok ="";
    
   
    $abs = "";
    $ListeFinale = [];
    if(isset($_POST['valide']))
    {
        
        foreach ($listDesEtudiants as $row)
        {
            if(!empty($matiere))
                {
                    // insertion de la matiere dans la table present
                    $sql = "INSERT INTO present (matiere) VALUES (?)";
                    $stmt = $connexion->prepare($sql);
                    $stmt->execute([$matiere]);

                    // recuperation de l'ID de la matiere
                    $idMat = $connexion->query("SELECT id FROM present where matiere= '$matiere'")->fetch();
                    
                    
                    // insertion de l'appel
                    $sql = "INSERT INTO etre_present (id_present,status,id_etudiant) VALUES (?,?,?)";
                    $stmt = $connexion->prepare($sql);
                    
                    
                    if(in_array($row['id'],$listPresent))
                    {
                    
                        $stmt->execute([$idMat['id'],"PRESENT(E)",$row['id']]);
                    }
                    else
                    {
                        $stmt->execute([$idMat['id'],"ABSENT(E)",$row['id']]);
                    }
                        
                        
                        
                }
        }
        $ok = "super";
       
    }
?>



<!--Titre de la Page  -->
<h1 class="h3 mb-2 text-gray-800 text-center h2">Liste des Etudiants inscrient</h1>
                    
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Liste de classe</h6>
                        </div>
                        <?php if(isset($_POST['valide']) and !empty($ok)):?>
                            <div class="alert alert-success text-center">
                                <?= "Appel effectué avec succes"?>
                            </div>
                        <?php endif ?>
                        <?php if(isset($_POST['valide']) and empty($ok)):?>
                            <div class="alert alert-danger text-center">
                                <?= "Appel échoué"?>
                            </div>
                        <?php endif ?>
                        <div class="card-body">
                            <div class="table-responsive">
                                <form action="" method="post">
                                    <table class="table table-bordered" id="" width="100%" cellspacing="0">
                                        <div class="row">

                                            <div class="col w-25 form-group pt-3 mb-4">
                                                <select name="matiere" id="niveau" class="w-100 form-control" value="" required>
                                                    <option value=""><span class="text-secondary">Entrez la matiére </span></option>
                                                    <option value="TRAITEMENT DE SIGNAL">TRAITEMENT DE SIGNAL</option>
                                                    <option value="PROGRAMMATION WEB">PROGRAMMATION WEB</option>
                                                    <option value="PROGRAMMATION ORIENTEE-OBJET">PROGRAMMATION ORIENTEE-OBJET</option>
                                                    <option value="THEORIE DES GRAPHES">THEORIE DES GRAPHES</option>
                                                    <option value="MERISE">MERISE</option>
                                                    <option value="MICRO-PROCESSEUR">MICRO-PROCESSEUR</option>
                                                    <option value="RESEAU INFORMATIQUE">RESEAU INFORMATIQUE</option>
                                            
                                                </select>
                                            </div>
                                            <div class="col">
                                                <?php if(isset($_POST['valide']) and !empty($ok)):?>
                                                    <a href="liste_presence_absence.php">Liste presence et absence</a>
                                                <?php endif ?>
                                            </div>
                                        </div>
                                        <thead>
                                        
                                            <tr>
                                                <th>ID</th>
                                                <th>Nom</th>
                                                <th>Prenom</th>
                                                <th>N° de carte étudiante</th>
                                                <th>Status</th>
                                                <th>Sup</th>
                                                
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>ID</th>
                                                <th>Nom</th>
                                                <th>Prenom</th>
                                                <th>N° de carte étudiante</th>
                                                <th>status</th>
                                                <th>Sup</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            <!-- Affichage des etudiants -->
                                            <?php foreach ($listDesEtudiants as $row): ?>
                                            <tr>
                                                <td><?php echo $row['id']; ?></td>
                                                <td><?php echo $row['nom']; ?></td>
                                                <td><?php echo $row['prenoms']; ?></td>
                                                <td><?php echo $row['nce']; ?></td>
                                                <td> 
                                                    <input type="checkbox" name="choix[]" value="<?php echo $row['id']; ?>"> Present(e)
                                                </td>
                                                <td>
                                                <a href="delete.php?table=etudiants&id=<?php echo $row['id']; ?>"><i class="bi bi-trash3 "></i></a> 

                                            </td>
                                            </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                    <input type="submit" value="Terminer" name="valide" class="btn btn-primary w-25 mb-4 btn-center mt-3">
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>

            <?php
require_once "footer_doc.php";
?>
