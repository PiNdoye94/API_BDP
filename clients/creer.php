<?php
// Headers requis
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// On vérifie la méthode
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    // On inclut les fichiers de configuration et d'accès aux données
    include_once '../config/Database.php';
    //include_once '../models/ClientPhysique.php';
    include_once '../models/ClientSalarie.php';
    

    // On instancie la base de données
    $database = new Database();
    $db = $database->getConnection();

    // On instancie les produits
    //$clientphysique = new ClientPhysique($db);
    $clientsalarie = new ClientSalarie($db);

    // On récupère les informations envoyées
    $donnees = json_decode(file_get_contents("php://input"));
    
    if(!empty($donnees->profession) && !empty($donnees->nom_entreprise) && !empty($donnees->adresse_entreprise) && !empty($donnees->id_employeur) && !empty($donnees->montant_salaire) && !empty($donnees->clientphysique_id)){
        // Ici on a reçu les données
        // On hydrate notre objet
        // $clientphysique->nom = $donnees->nom;
        // $clientphysique->prenom = $donnees->prenom;
        // $clientphysique->adresse = $donnees->adresse;
        // $clientphysique->telephone = $donnees->telephone;
        // $clientphysique->email = $donnees->email;
        // $clientphysique->carte_identite = $donnees->carte_identite;
        // $clientphysique->validite_identite = $donnees->validite_identite;
        // var_dump($donnees);
        // die;
        $clientsalarie->profession = $donnees->profession;
        $clientsalarie->nom_entreprise = $donnees->nom_entreprise;
        $clientsalarie->adresse_entreprise = $donnees->adresse_entreprise;
        $clientsalarie->id_employeur = $donnees->id_employeur;
        $clientsalarie->montant_salaire = $donnees->montant_salaire;
        $clientsalarie->clientphysique_id = $donnees->clientphysique_id;
        // var_dump($clientsalarie);
        // die;
        if($clientsalarie->creer()){
            // Ici la création a fonclientsalariectionné
            // On envoie un code 201
            http_response_code(201);
            echo json_encode(["message" => "L'ajout a été effectué"]);
        }else{
            // Ici la création n'a pas fonctionné
            // On envoie un code 503
            http_response_code(503);
            echo json_encode(["message" => "L'ajout n'a pas été effectué"]);         
        }
    }
}else{
    // On gère l'erreur
    http_response_code(405);
    echo json_encode(["message" => "La méthode n'est pas autorisée"]);
}