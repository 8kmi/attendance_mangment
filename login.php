<?php
  //Start session
  session_start();
  error_reporting(E_ALL);
  ini_set("display_errors", 1);

  require 'connexion.php';


  $email = filter_input( INPUT_POST, 'email');
  $mdp = filter_input( INPUT_POST, 'mdp');
  $message = "";
  $etat = '';


  $teachers = $connexion -> query( "SELECT * FROM teacher") -> fetchAll();

  // var_dump($teachers);

  if(isset($_POST['ok']))
  {
      foreach($teachers as $teacher)
      {
        if($teacher['email'] == $email && $teacher['mdp'] == $mdp )
        {
            $message = "Connection étabile";

            $_SESSION['currentUserId'] = $teacher['id'] ;

            $_SESSION['surname'] = $teacher['prenoms'] ;


            $etat = True;

            header("Location: index.php");
        }
        else
        {
            // $message = sprintf("Les informations envoyées ne permettent pas de vous identifier : %s %s",
            //                       $email, $mdp);

            $message = "Email ou mot de passe incorrect";
            
            $etat = False;
        }
      }
  }
  
?>



<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0 , shrink-to-fit=no">
    <link rel="stylesheet" href="./assets/css/bootstrap.min.css">    
    <link rel="stylesheet" href="./assets/css/style.css">

    <title>Gestion des Absences | Login</title>
</head>
<body style="background-color: #19b459;">

  <section>
    <div class="d-flex justify-content-center">
      <?php if( isset($_POST['ok']) && $etat ): ?>
          <div class="alert alert-success text-center">
            <?= $message ?>
          </div>
      <?php endif ;?>
        
      <?php if( isset($_POST['ok']) && !$etat ): ?>
          <div class="alert alert-danger text-center">
            <?= $message ?>
          </div>
      <?php endif ;?>
    </div>

    <div class="container d-flex justify-content-center align-items-center">
      <!-- <div class="row justify-content-center">GESTION DE PRESENCE</div> -->
        <div class="col-sm-12 col-md-10 col-lg-8 col-xl-6 col-xxl-6 bg-light shadow-lg">
          <div class="wrap d-md-flex">
            <div class=" left-div text-wrap px-4 py-2 p-lg-4 text-center d-flex flex-column">
              <div class="d-flex justify-content-center"><img src="./assets/images/logo-una.png" width = "80" height = "80" alt=""></div>
              <div class="text w-100">
                  <h2>Bienvenue sur la page de connexion</h2>
                  <p>Veuillez vous identifier</p>
              </div>
              <!-- <img src="../pics/logo-una.png" width="80" height="80" class="img-flui" alt=""> -->
            </div>

            <!-- div du formulaire -->
            <div class="login-wrap p-4 p-lg-5 w-100">
              <h4 class="mb-4 text-success text-center">Connexion</h4>
              <form action="" class="signin-form" method="POST">

                <div class="form-floating mb-3">
                  <input type="text" name="email" class="form-control form-control-sm" id = "emailInput" placeholder="#" required>
                  <label for="emailInput">Email</label>
                </div>

                <div class="form-floating mb-2">
                  <input type="password" name="mdp" class="form-control" id = "mdpInput" placeholder="#" required>
                  <label for="mdpInput">Password</label>
                </div>
      
                <div class="form-group mt-3">
                  <button type="submit" name="ok" class="form-control btn btn-success px-3">Login</button>
                </div>
              </form>
            </div>
          </div>
        </div>
    </div>
  </section>
</body>
</html>