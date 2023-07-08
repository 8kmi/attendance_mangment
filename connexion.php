<?php

$servername = 'localhost';
$user = 'root';
$mot2pass = '';
$database = 'presence_manag';

//On essaie de se connecter
try {
    $connexion = new PDO("mysql:host=$servername;dbname=$database", $user, $mot2pass);
    //On définit le mode d'erreur de PDO sur Exception
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // die("<h2>Connexion établie </h2>");
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
    //die("<h2>Connexion non établie </h2>");
}
/*
$sql = "INSERT INTO typecontacts (libelle) VALUES (:libelle)";
$stmt = $connexion->prepare($sql);
$stmt->execute(["libelle" => "Facebook"]);
/+/
//* /
$sql = "INSERT INTO typecontacts (libelle) VALUES (:libelle)";
$stmt = $connexion->prepare($sql);
$type = ["Email", "Telephone fixe", "Instagram", "Tiktok"];
foreach ($type as $v) :
    $stmt->execute(["libelle" => $v]);
endforeach;
//*/
/*
//https://phpdelusions.net/pdo_examples/select
$stmt = $conn->query("SELECT * FROM typecontacts");
while ($row = $stmt->fetch()) {
    echo $row['libelle'] . "<br />\n";
}
//* /
$sql = "UPDATE typecontacts SET libelle = :libelle WHERE id = :id";
$connexion->prepare($sql)->execute(['libelle' => 'E-mail', 'id' => 3]);
echo  "<h3>Fin de la modif</h3>";
/*
$stmt = $connexion->query("SELECT * FROM typecontacts");
while ($row = $stmt->fetch()) {
    echo $row['libelle'] . "<br />\n";
}
/* /* /

$data = $connexion->query("SELECT * FROM typecontacts")->fetchAll();
// and somewhere later:
foreach ($data as $row) {
    echo $row['libelle'] . "<br />\n";
}
//*/
//https://phpdelusions.net/pdo_examples/insert
$uploadDir = dirname(__FILE__) . DIRECTORY_SEPARATOR . "upload" . DIRECTORY_SEPARATOR;
//die("<h2>Fin </h2>");
