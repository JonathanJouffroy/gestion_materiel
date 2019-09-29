<?php
	/*
	 * To change this license header, choose License Headers in Project Properties.
	 * To change this template file, choose Tools | Templates
	 * and open the template in the editor.
	 */


	class Pdobdd 
	{
		private static $serveur = 'mysql:host=localhost';
		private static $bdd = 'dbname=gestion_du_materiel';
		private static $user = 'root';
		private static $mdp = '';
		private static $monPdo;
		private static $monPdoBdd = null;
                

		/**
		 * Constructeur privé, crée l'instance de PDO qui sera sollicitée
		 * pour toutes les méthodes de la classe
		 */
    
		private function __construct() 
		{
			PdoBdd::$monPdo = new PDO(PdoBdd::$serveur . ';' . PdoBdd::$bdd, PdoBdd::$user, PdoBdd::$mdp);
			PdoBdd::$monPdo->query("SET CHARACTER SET utf8");
                        PdoBdd::$monPdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}

		/**
		 * Fonction statique qui crée l'unique instance de la classe
		 * Appel : $instancePdoBdd = Pdo::getPdoBdd();
		 * @return l'unique objet de la classe PdoBdd
		 */
		 
		public static function getPdoBdd() 
		{
			if (PdoBdd::$monPdoBdd == null) 
			{
				PdoBdd::$monPdoBdd = new PdoBdd();
			}
			
			return PdoBdd::$monPdoBdd;
		}
                
                public function AfficherAntenne()
                {
                    
                    $cnx = PdoBdd::$monPdo;
                    $req="SELECT id,nom
                          FROM antennes";
                     $reqprepare = $cnx->prepare($req);
	             $reqprepare->execute();
                     $tabcomp = $reqprepare->fetchAll(); 
	             return $tabcomp;
                }
                
          
                
                public function Connexion($user, $pass)
                {
                    $cnn = PdoBdd::$monPdo;
                    try
                    {
                         $stmt = $cnn->prepare('SELECT nom_d_utilisateur, mdp FROM utilisateurs WHERE nom_d_utilisateur = :user');
                         $stmt->bindParam(':user', $user);
                         $stmt->execute();
                         $user1 = $stmt->fetch(PDO::FETCH_OBJ);
                         if($user1)
                         {
                             
                        if ($user1 && password_verify($_POST['pass'], $user1->mdp)) 
                        {
                                 return true  ;    
                         }
                         else {
                            return false;
                            }     
                        }
                    }
                    catch(Exception $e){
                     echo "Error !" .$e->getMessage();
                }
                
                }

                public function Enregistrer($nom,$prenom,$nomU,$mdp,$adresseMail,$antenne,$role){
                    $mdp = password_hash($mdp, PASSWORD_DEFAULT);

                    $cnn = PdoBdd::$monPdo;
                    try{
                      $stmt = $cnn->prepare('INSERT INTO utilisateurs (nom,prenom,adresse_mail,nom_d_utilisateur,mdp,role,id_Antennes) VALUES (:nom, :prenom, :adresseM, :nomU, :mdp, :role, :antenne)');
                      $stmt->bindParam(':nom', $nom);
                      $stmt->bindParam(':prenom', $prenom);
                      $stmt->bindParam(':adresseM', $adresseMail);
                      $stmt->bindParam(':nomU', $nomU);
                      $stmt->bindParam(':mdp', $mdp);
                      $stmt->bindParam(':antenne', $antenne);
                      $stmt->bindParam(':role', $role);
                      $result = $stmt->execute();
                        }catch(Exception $e){
                        echo "Error !" .$e->getMessage();
                        $result = false;  
                    }
                    return $result;
                } 
                
                public function VerifMail($recup_mail)
                {
                     $cnx = PdoBdd::$monPdo;
             
                         $req="SELECT id,nom_d_utilisateur
                           FROM utilisateurs
                           WHERE adresse_mail = ?";
                     $reqprepare = $cnx->prepare($req);
	             $reqprepare->execute(array($recup_mail));
	             $recup_count = $reqprepare->rowCount();
                     
                     return $recup_count;
                     
                }
                    
                public function GetNomU($recup_mail)
                {
                    $cnx = PdoBdd::$monPdo;
             
                         $req="SELECT nom_d_utilisateur
                           FROM utilisateurs
                           WHERE adresse_mail = ?";
                     $reqprepare = $cnx->prepare($req);
	             $reqprepare->execute(array($recup_mail));
                     $reqprepare = $reqprepare->fetch();
                     $getnomU = $reqprepare['nom_d_utilisateur'];
                     
                     return $getnomU;
                    
                    
                }
                
                
                public function VerifCodeMDP($recup_mail)
                {
                    $cnx = PdoBdd::$monPdo;
                   
                    
                        $req="SELECT id
                           FROM recuperation
                           WHERE mail = ?";
                     $reqprepare = $cnx->prepare($req);
	             $reqprepare->execute(array($recup_mail));
	             $verif_count = $reqprepare->rowCount();
                     
                    return $verif_count;

                }
                
                 public function UpdateRecup($recup_code,$recup_mail)
                     {
                         $cnx = PdoBdd::$monPdo;
                     
                         $recup_insert = $cnx->prepare('UPDATE recuperation SET code = ? WHERE mail = ?');
                         $recup_insert->execute(array($recup_code,$recup_mail));
                         
                     }
                     
                public function InsertRecup($recup_mail,$recup_code)
                {
                    $cnx = PdoBdd::$monPdo;
                    
                    $recup_insert = $cnx->prepare('INSERT INTO recuperation(mail,code) VALUES (?, ?)');
                    $recup_insert->execute(array($recup_mail,$recup_code));
                }
                
                public function VerifReq($recup_mail,$verif_code) {
                    
                    $cnx = PdoBdd::$monPdo;
                    $req=" SELECT id,code
                           FROM recuperation
                           WHERE mail = ? and code = ?";

                     $reqprepare = $cnx->prepare($req);
	             $reqprepare->execute(array($recup_mail,$verif_code));
	             $verif_req = $reqprepare->rowCount();
                     
                  return $verif_req;
                    
                }
                
                public function VerifRecup($recup_mail)
                {
                     $cnx = PdoBdd::$monPdo;
                    $req=" UPDATE recuperation
                           SET confirme = 1
                           WHERE mail = ? ";
                    $reqprepare = $cnx->prepare($req);
                    $reqprepare->execute(array($recup_mail));
 
                    
                }
                
                public function VerifConfirme($recup_mail) {
                    
                         $cnx = PdoBdd::$monPdo;
                    
                         
                         $req="SELECT confirme 
                               FROM recuperation
                               WHERE mail = ?";
                         
                         $verif_confirme = $cnx->prepare($req);
                         $verif_confirme->execute(array($recup_mail));
                         $verif_confirme = $verif_confirme->fetch();
                         $verif_confirme = $verif_confirme['confirme'];
                         
                         return $verif_confirme;
                    
                }
                
                public function UpdateUtilisateur($mdp,$recup_mail) {
                    $cnx = PdoBdd::$monPdo;
                    $req="UPDATE utilisateurs
                          SET mdp = ? 
                          WHERE adresse_mail = ?";
                    $ins_mdp = $cnx->prepare($req);
                    $ins_mdp->execute(array($mdp,$_SESSION['recup_mail']));
                }
                

                
                public function DeleteCode($recup_mail) {
                    
                    $cnx = PdoBdd::$monPdo;
                    $req="DELETE FROM recuperation
                          WHERE mail = ?";
                    $dell_code = $cnx->prepare($req);
                    $dell_code->execute(array($_SESSION['recup_mail']));
                    
                    
                }
                
                public function InsertMaterielOP($nom,$nomrmsc,$lot,$cons,$qte,$packaging,$localisation,$dateP,$stockmini,$idA){
                    
                     $cnx = PdoBdd::$monPdo;
                  try{
                     $stmt = $cnx->prepare("INSERT INTO stock_materiel_operationnel (`nom`,`nom_rnmsc`,`lot`,`Consommable`,`quantite`,`packaging`,`localisation`,`date_de_peremption`,`stock_minimum`,`id_Antennes`) VALUES (:nom,:nomrnmsc,:lot,:consommable,:quantite,:packaging,:localisation,:dateP,:stockmin,:idA)");
                     
                      $stmt->bindParam(':nom', $nom);
                      $stmt->bindParam(':nomrnmsc', $nomrmsc);
                      $stmt->bindParam(':lot', $lot);
                      $stmt->bindParam(':consommable', $cons);
                      $stmt->bindParam(':quantite', $qte);
                      $stmt->bindParam(':packaging', $packaging);
                      $stmt->bindParam(':localisation', $localisation);
                      $stmt->bindParam(':dateP', $dateP);
                      $stmt->bindParam(':stockmin', $stockmini);
                      $stmt->bindParam(':idA', $idA);
                      $result = $stmt->execute();
                        }catch(Exception $e){
                        echo "Error !" .$e->getMessage();
                        $result = false;  
                    }
                    return $result;
                }
                
		 public function AfficherLotOP()
                {
                    
                    $cnx = PdoBdd::$monPdo;
                    $req="SELECT DISTINCT nom
                          FROM lots
                          order by nom asc";
                     $reqprepare = $cnx->prepare($req);
	             $reqprepare->execute();
                     $tabcomp = $reqprepare->fetchAll(); 
	             return $tabcomp;
                }
                 public function AfficherMaterielOP()
                {
                    
                    $cnx = PdoBdd::$monPdo;
                    $req="SELECT DISTINCT nom_rnmsc
                          FROM stock_materiel_operationnel";
                     $reqprepare = $cnx->prepare($req);
	             $reqprepare->execute();
                     $tabcomp = $reqprepare->fetchAll(); 
	             return $tabcomp;
                }
                 public function InsertMaterielFOR($nom,$nomrmsc,$typeformation,$cons,$qte,$packaging,$localisation,$dateP,$stockmini,$idA){
                    
                     $cnx = PdoBdd::$monPdo;
                  try{
                     $stmt = $cnx->prepare("INSERT INTO stock_materiel_formation (`nom`,`nom_rnmsc`,`type_formation`,`Consommable`,`quantite`,`packaging`,`localisation`,`date_de_peremption`,`stock_minimum`,`id_Antennes`) VALUES (:nom,:nomrnmsc,:typeformation,:consommable,:quantite,:packaging,:localisation,:dateP,:stockmin,:idA)");
                     
                      $stmt->bindParam(':nom', $nom);
                      $stmt->bindParam(':nomrnmsc', $nomrmsc);
                      $stmt->bindParam(':typeformation', $typeformation);
                      $stmt->bindParam(':consommable', $cons);
                      $stmt->bindParam(':quantite', $qte);
                      $stmt->bindParam(':packaging', $packaging);
                      $stmt->bindParam(':localisation', $localisation);
                      $stmt->bindParam(':dateP', $dateP);
                      $stmt->bindParam(':stockmin', $stockmini);
                      $stmt->bindParam(':idA', $idA);
                      $result = $stmt->execute();
                        }catch(Exception $e){
                        echo "Error !" .$e->getMessage();
                        $result = false;  
                    }
                    return $result;
                }
                
		 public function AfficherFOR()
                {
                    
                    $cnx = PdoBdd::$monPdo;
                    $req="SELECT DISTINCT nom
                          FROM formations";
                     $reqprepare = $cnx->prepare($req);
	             $reqprepare->execute();
                     $tabcomp = $reqprepare->fetchAll(); 
	             return $tabcomp;
                }
                 public function AfficherMaterielFOR()
                {
                    
                    $cnx = PdoBdd::$monPdo;
                    $req="SELECT DISTINCT nom_rnmsc
                          FROM stock_materiel_formation";
                     $reqprepare = $cnx->prepare($req);
	             $reqprepare->execute();
                     $tabcomp = $reqprepare->fetchAll(); 
	             return $tabcomp;
                }
                             
                
                public function AfficherMaterielOperationnel($idAntenne) {   
                    $cnx = PdoBdd::$monPdo;
                    $req="SELECT s.id, s.nom, s.nom_rnmsc, s.lot, s.Consommable, s.quantite, s.packaging, s.localisation, s.date_de_peremption,
                          s.stock_minimum, antennes.nom as nomAntenne
                          FROM stock_materiel_operationnel s
                          INNER JOIN antennes ON s.id_Antennes = antennes.id";
                    if ($idAntenne != null) {
                        $req .= " WHERE id_Antennes = " . $idAntenne;
                    }
                    $reqprepare = $cnx->prepare($req);
                    $reqprepare->execute();
                    $tabMaterielOperationnel = $reqprepare->fetchAll(); 
                    return $tabMaterielOperationnel;
                }
                
                public function ModifierMaterielOperationnel($id, $nom, $nom_rnmsc, $lot, $quantite, $localisation, $peremption, $stock_minimum) {
                    try {
                        $cnx = PdoBdd::$monPdo;
                        $cnx->beginTransaction();
                        $req="UPDATE stock_materiel_operationnel
                            SET nom = :nom, nom_rnmsc = :nom_rnmsc, lot = :lot, quantite = :quantite, localisation = :localisation, date_de_peremption = :peremption, stock_minimum = :stock_minimum 
                            WHERE id = :id";
                        $reqprepare = $cnx->prepare($req);
                        $reqprepare->bindParam(':id', $id);
                        $reqprepare->bindParam(':nom', $nom);
                        $reqprepare->bindParam(':nom_rnmsc', $nom_rnmsc);
                        $reqprepare->bindParam(':lot', $lot);
                        $reqprepare->bindParam(':quantite', $quantite);
                        $reqprepare->bindParam(':localisation', $localisation);
                        $reqprepare->bindParam(':peremption', $peremption);
                        $reqprepare->bindParam(':stock_minimum', $stock_minimum);
                        $reqprepare->execute();
                        $cnx->commit();
                        return 1;
                    } catch(Exception $e) {
                        $cnx->rollback();
                        return "Une erreur s'est produite.";
                    }
                }
                
                public function SupprimerMaterielOperationnel($id) {
                    $cnx = PdoBdd::$monPdo;
                    $req="DELETE FROM stock_materiel_operationnel
                          WHERE id = :id";
                    $reqprepare = $cnx->prepare($req);
                    $reqprepare->bindParam(':id', $id);
                    $reqprepare->execute();
                }
                
                public function AfficherCompte($user)
                {
                     $cnx = PdoBdd::$monPdo;
                    $req="Select * FROM utilisateurs
                          WHERE nom_d_utilisateur = :user";
                    $reqprepare = $cnx->prepare($req);
                    $reqprepare->bindParam(':user', $user);
                    $reqprepare->execute();
                    $tabcomp = $reqprepare->fetchAll(); 
	            return $tabcomp;
                    
                }
                
                public function ModifierCompte($nom,$prenom,$adressemail,$id) {
                     try {
                        $cnx = PdoBdd::$monPdo;
                        $cnx->beginTransaction();
                        $req="UPDATE utilisateurs
                            SET nom = :nom, prenom = :prenom, adresse_mail = :adressemail
                            WHERE id = :id";
                        $reqprepare = $cnx->prepare($req);
                        $reqprepare->bindParam(':nom', $nom);
                        $reqprepare->bindParam(':prenom', $prenom);
                        $reqprepare->bindParam(':adressemail', $adressemail);
                        $reqprepare->bindParam(':id', $id);
                        $reqprepare->execute();
                        $cnx->commit();
                        return 1;
                    } catch(Exception $e) {
                        $cnx->rollback();
                        return "Une erreur s'est produite.";
                    }
                }
                
                 public function UpdateMDP($mdp,$id) {
                   try{
                    $mdp = password_hash($mdp, PASSWORD_DEFAULT);
                    $cnx = PdoBdd::$monPdo;
                    $cnx->beginTransaction();
                    $req="UPDATE utilisateurs
                          SET mdp =:mdp 
                          WHERE id =:id";
                    $reqprepare = $cnx->prepare($req);
                    $reqprepare->bindParam(':mdp', $mdp);
                    $reqprepare->bindParam(':id', $id);
                    $reqprepare->execute();
                    $cnx->commit();
                    return 1;
                   
                   }
                    catch(Exception $e) {
                        $cnx->rollback();
                        return "Une erreur s'est produite.";
                    }
                }
                
               public function AfficherMaterielOPERAT() {   
                    $cnx = PdoBdd::$monPdo;
                    $req="SELECT id, nom, nom_rnmsc, lot, Consommable, quantite, packaging, localisation, date_de_peremption,
                          stock_minimum, id_Antennes
                          FROM stock_materiel_operationnel";
                    $reqprepare = $cnx->prepare($req);
                    $reqprepare->execute();
                    $tabMaterielOperationnel = $reqprepare->fetchAll(); 
                    return $tabMaterielOperationnel;
                }
                public function AfficherMaterielFROMA() {   
                    $cnx = PdoBdd::$monPdo;
                    $req="SELECT id, nom, nom_rnmsc, type_formation, Consommable, quantite, packaging, localisation, date_de_peremption,
                          stock_minimum, id_Antennes
                          FROM stock_materiel_formation";
                    $reqprepare = $cnx->prepare($req);
                    $reqprepare->execute();
                    $tabMaterielOperationnel = $reqprepare->fetchAll(); 
                    return $tabMaterielOperationnel;
                }
                
                   public function AfficherMaterielFormation($idAntenne) {   
                    $cnx = PdoBdd::$monPdo;
                    $req="SELECT s.id, s.nom, s.nom_rnmsc, s.type_formation, s.Consommable, s.quantite, s.packaging, s.localisation, s.date_de_peremption,
                          s.stock_minimum, antennes.nom as nomAntenne
                          FROM stock_materiel_formation s
                          INNER JOIN antennes ON s.id_Antennes = antennes.id";
                    if ($idAntenne != null) {
                        $req .= " WHERE id_Antennes = " . $idAntenne;
                    }
                    $reqprepare = $cnx->prepare($req);
                    $reqprepare->execute();
                    $tabMaterielFormation = $reqprepare->fetchAll(); 
                    return $tabMaterielFormation;
                }
                
                public function ModifierMaterielFormation($id, $nom, $nom_rnmsc, $type_formation, $quantite, $localisation, $peremption, $stock_minimum) {
                    try {
                        $cnx = PdoBdd::$monPdo;
                        $cnx->beginTransaction();
                        $req="UPDATE stock_materiel_formation
                            SET nom = :nom, nom_rnmsc = :nom_rnmsc, type_formation = :type_formation, quantite = :quantite, localisation = :localisation, date_de_peremption = :peremption, stock_minimum = :stock_minimum 
                            WHERE id = :id";
                        $reqprepare = $cnx->prepare($req);
                        $reqprepare->bindParam(':id', $id);
                        $reqprepare->bindParam(':nom', $nom);
                        $reqprepare->bindParam(':nom_rnmsc', $nom_rnmsc);
                        $reqprepare->bindParam(':type_formation', $type_formation);
                        $reqprepare->bindParam(':quantite', $quantite);
                        $reqprepare->bindParam(':localisation', $localisation);
                        $reqprepare->bindParam(':peremption', $peremption);
                        $reqprepare->bindParam(':stock_minimum', $stock_minimum);
                        $reqprepare->execute();
                        $cnx->commit();
                    } catch(Exception $e) {
                        $cnx->rollback();
                        return "Une erreur s'est produite.";
                    }
                }
                
                public function SupprimerMaterielFormation($id) {
                    $cnx = PdoBdd::$monPdo;
                    $req="DELETE FROM stock_materiel_formation
                          WHERE id = :id";
                    $reqprepare = $cnx->prepare($req);
                    $reqprepare->bindParam(':id', $id);
                    $reqprepare->execute();
                }
        
                public function AfficherMaterielOperationnelACommander($idAntenne) {   
                    $cnx = PdoBdd::$monPdo;
                    $req="SELECT s.id, s.nom, s.nom_rnmsc, s.lot, s.Consommable, s.quantite, s.packaging, s.localisation, s.date_de_peremption,
                          s.stock_minimum, antennes.nom as nomAntenne
                          FROM stock_materiel_operationnel s
                          INNER JOIN antennes ON s.id_Antennes = antennes.id
                          WHERE s.quantite < s.stock_minimum";
                    if ($idAntenne != null) {
                        $req .= " AND id_Antennes = " . $idAntenne;
                    }
                    $reqprepare = $cnx->prepare($req);
                    $reqprepare->execute();
                    $tabMaterielOperationnel = $reqprepare->fetchAll(); 
                    return $tabMaterielOperationnel;
                }

                public function AfficherMaterielFormationACommander($idAntenne) {   
                    $cnx = PdoBdd::$monPdo;
                    $req="SELECT s.id, s.nom, s.nom_rnmsc, s.type_formation, s.Consommable, s.quantite, s.packaging, s.localisation, s.date_de_peremption,
                          s.stock_minimum, antennes.nom as nomAntenne
                          FROM stock_materiel_formation s
                          INNER JOIN antennes ON s.id_Antennes = antennes.id
                          WHERE s.quantite < s.stock_minimum";
                    if ($idAntenne != null) {
                        $req .= " AND id_Antennes = " . $idAntenne;
                    }
                    $reqprepare = $cnx->prepare($req);
                    $reqprepare->execute();
                    $tabMaterielFormation = $reqprepare->fetchAll(); 
                    return $tabMaterielFormation;
                }
}