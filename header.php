<?php
    require 'connexion.php';  

?>

<!doctype html>

<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">


    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
    
    <!-- Style -->
    <link rel="stylesheet" href="./assets/css/style.css">

    <title>Gestion des Absences</title>
  </head>

  <body>
    
    <nav class="navbar navbar-expand-xl navbar-dark bg-success ">
      <div class="container-fluid">
        <a class="navbar-brand text-uppercase fw-bolder nx-4 py-3" href="/">Gestion des Absences</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
            <li class="link nav-item px-2">
                <a class="nav-link" aria-current="page" href="index.php">Accueil - UE & Seances</a>
            </li>
    
            <li class="link nav-item px-2">
                <a class="nav-link" href="createSession.php">Créer une Seance</a>
            </li>

            <li class="link nav-item px-2">
                <a class="nav-link" href="faire_appel.php">Faire l'appel</a>
            </li>

            <li class="link nav-item px-2">
                <a class="nav-link" href="liste_absents.php">Listes des absences</a>
            </li>

            <li class="link nav-item px-2">
                <a class="nav-link" href="deconnexion.php">Deconnexion</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>