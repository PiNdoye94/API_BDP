<?php
class ClientSalarie{
    // Connexion
    private $connexion;
    private $table = "clientsalarie";

    // object properties
    public $id;						
    public $profession;
    public $nom_entreprise;
    public $adresse_entreprise;
    public $id_employeur;
    public $montant_salaire;
    public $clientphysique_id;
    public $created_at;

    /**
     * Constructeur avec $db pour la connexion à la base de données
     *
     * @param $db
     */
    public function __construct($db){
        $this->connexion = $db;
    }

    // /**
    //  * Lecture des produits
    //  *
    //  * @return void
    //  */
    // public function lire(){
    //     // On écrit la requête
    //     $sql = "SELECT c.nom as categories_nom, p.id, p.nom, p.description, p.prix, p.categories_id, p.created_at FROM " . $this->table . " p LEFT JOIN categories c ON p.categories_id = c.id ORDER BY p.created_at DESC";

    //     // On prépare la requête
    //     $query = $this->connexion->prepare($sql);

    //     // On exécute la requête
    //     $query->execute();

    //     // On retourne le résultat
    //     return $query;
    // }

    /**
     * Créer un Client Salarié
     *
     * @return void
     */
    public function creer(){

        // Ecriture de la requête SQL en y insérant le nom de la table
        $sql = "INSERT INTO " . $this->table . " SET profession=:profession, nom_entreprise=:nom_entreprise, adresse_entreprise=:adresse_entreprise, id_employeur=:id_employeur, montant_salaire=:montant_salaire, clientphysique_id=:clientphysique_id";

        // Préparation de la requête
        $query = $this->connexion->prepare($sql);
        // var_dump($query);
        // die;
        // Protection contre les injections
        $this->profession=htmlspecialchars(strip_tags($this->profession));
        $this->nom_entreprise=htmlspecialchars(strip_tags($this->nom_entreprise));
        $this->adresse_entreprise=htmlspecialchars(strip_tags($this->adresse_entreprise));
        $this->id_employeur=htmlspecialchars(strip_tags($this->id_employeur));
        $this->montant_salaire=htmlspecialchars(strip_tags($this->montant_salaire));
        $this->clientphysique_id=htmlspecialchars(strip_tags($this->clientphysique_id));

        // Ajout des données protégées
        $query->bindParam(":profession", $this->profession);
        $query->bindParam(":nom_entreprise", $this->nom_entreprise);
        $query->bindParam(":adresse_entreprise", $this->adresse_entreprise);
        $query->bindParam(":id_employeur", $this->id_employeur);
        $query->bindParam(":montant_salaire", $this->montant_salaire);
        $query->bindParam(":clientphysique_id", $this->clientphysique_id);
        
        // var_dump($query);
        // die;
        // Exécution de la requête
        if($query->execute()){
            return true;
        }
        return false;
    }

    // /**
    //  * Lire un produit
    //  *
    //  * @return void
    //  */
    // public function lireUn(){
    //     // On écrit la requête
    //     $sql = "SELECT c.nom as categories_nom, p.id, p.nom, p.description, p.prix, p.categories_id, p.created_at FROM " . $this->table . " p LEFT JOIN categories c ON p.categories_id = c.id WHERE p.id = ? LIMIT 0,1";

    //     // On prépare la requête
    //     $query = $this->connexion->prepare( $sql );

    //     // On attache l'id
    //     $query->bindParam(1, $this->id);

    //     // On exécute la requête
    //     $query->execute();

    //     // on récupère la ligne
    //     $row = $query->fetch(PDO::FETCH_ASSOC);

    //     // On hydrate l'objet
    //     $this->nom = $row['nom'];
    //     $this->prix = $row['prix'];
    //     $this->description = $row['description'];
    //     $this->categories_id = $row['categories_id'];
    //     $this->categories_nom = $row['categories_nom'];
    // }

    // /**
    //  * Supprimer un produit
    //  *
    //  * @return void
    //  */
    // public function supprimer(){
    //     // On écrit la requête
    //     $sql = "DELETE FROM " . $this->table . " WHERE id = ?";

    //     // On prépare la requête
    //     $query = $this->connexion->prepare( $sql );

    //     // On sécurise les données
    //     $this->id=htmlspecialchars(strip_tags($this->id));

    //     // On attache l'id
    //     $query->bindParam(1, $this->id);

    //     // On exécute la requête
    //     if($query->execute()){
    //         return true;
    //     }
        
    //     return false;
    // }

    // /**
    //  * Mettre à jour un produit
    //  *
    //  * @return void
    //  */
    // public function modifier(){
    //     // On écrit la requête
    //     $sql = "UPDATE " . $this->table . " SET nom = :nom, prix = :prix, description = :description, categories_id = :categories_id WHERE id = :id";
        
    //     // On prépare la requête
    //     $query = $this->connexion->prepare($sql);
        
    //     // On sécurise les données
    //     $this->nom=htmlspecialchars(strip_tags($this->nom));
    //     $this->prix=htmlspecialchars(strip_tags($this->prix));
    //     $this->description=htmlspecialchars(strip_tags($this->description));
    //     $this->categories_id=htmlspecialchars(strip_tags($this->categories_id));
    //     $this->id=htmlspecialchars(strip_tags($this->id));
        
    //     // On attache les variables
    //     $query->bindParam(':nom', $this->nom);
    //     $query->bindParam(':prix', $this->prix);
    //     $query->bindParam(':description', $this->description);
    //     $query->bindParam(':categories_id', $this->categories_id);
    //     $query->bindParam(':id', $this->id);
        
    //     // On exécute
    //     if($query->execute()){
    //         return true;
    //     }
        
    //     return false;
    // }

}