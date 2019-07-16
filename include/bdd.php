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
                         $row = $stmt->fetch(PDO::FETCH_OBJ);
                    }
                    catch(Exception $e){
                     echo "Error !" .$e->getMessage();
                }
                //print $row->Password;
                return  password_verify($pass, $row->mdp) ? true : false ;
                }

                public function Enregistrer($user, $pass, $antenne){
                    $pass = password_hash($pass, PASSWORD_DEFAULT);

                    $cnn = PdoBdd::$monPdo;
                    try{
                      $stmt = $cnn->prepare('INSERT INTO utilisateurs (nom_d_utilisateur,mdp,id_Antennes) VALUES (:user, :pass, :antenne)');
                      $stmt->bindParam(':user', $user);
                      $stmt->bindParam(':pass', $pass);
                      $stmt->bindParam(':antenne', $antenne);
                      $result = $stmt->execute();
                        }catch(Exception $e){
                        echo "Error !" .$e->getMessage();
                        $result = false;  
                    }
                    return $result;
                } 

		
}