<?php

// FONCTIONS DE CONNEXION

   $hote="localhost";
   $login="festival";
   $mdp="secret";

   try{
      $connexion = new PDO("mysql:host=$hote;dbname=festival", $login, $mdp);
      $connexion->exec("set names utf8");
      return $connexion;
   }
   catch(PDOException $e){
      echo "Erreur :" . $e->getMessage();
      die();
   }

// FONCTIONS DE GESTION DES ÉTABLISSEMENTS

function obtenirReqEtablissements()
{
   $req="SELECT id, nom from Etablissement order by id";
   return $req;
}

function obtenirReqEtablissementsOffrantChambres()
{
   $req="SELECT id, nom, nombreChambresOffertes from Etablissement where 
         nombreChambresOffertes!=0 order by id";
   return $req;
}

function obtenirReqEtablissementsAyantChambresAttribuées()
{
   $req="SELECT distinct id, nom, nombreChambresOffertes from Etablissement, 
         Attribution where id = idEtab order by id";
   return $req;
}

function obtenirDetailEtablissement($connexion, $id)
{
   $req="SELECT * from Etablissement where id='$id'";
   $rsEtab=$connexion->query($req);
   return $rsEtab->fetchAll();
}

function supprimerEtablissement($connexion, $id)
{
   $req="DELETE from Etablissement where id='$id'";
   $connexion->exec($req);
}
 
function modifierEtablissement($connexion, $id, $nom, $adresseRue, $codePostal, 
                               $ville, $tel, $adresseElectronique, $type, 
                               $civiliteResponsable, $nomResponsable, 
                               $prenomResponsable, $nombreChambresOffertes)
{  
   $nom=str_replace("'", "''", $nom);
   $adresseRue=str_replace("'","''", $adresseRue);
   $ville=str_replace("'","''", $ville);
   $adresseElectronique=str_replace("'","''", $adresseElectronique);
   $nomResponsable=str_replace("'","''", $nomResponsable);
   $prenomResponsable=str_replace("'","''", $prenomResponsable);
  
   $req="UPDATE Etablissement set nom='$nom',adresseRue='$adresseRue',
         codePostal='$codePostal',ville='$ville',tel='$tel',
         adresseElectronique='$adresseElectronique',type='$type',
         civiliteResponsable='$civiliteResponsable',nomResponsable=
         '$nomResponsable',prenomResponsable='$prenomResponsable',
         nombreChambresOffertes='$nombreChambresOffertes' where id='$id'";
   
   $connexion->exec($req);
}

function creerEtablissement($connexion, $id, $nom, $adresseRue, $codePostal, 
                            $ville, $tel, $adresseElectronique, $type, 
                            $civiliteResponsable, $nomResponsable, 
                            $prenomResponsable, $nombreChambresOffertes)
{ 
   $nom=str_replace("'", "''", $nom);
   $adresseRue=str_replace("'","''", $adresseRue);
   $ville=str_replace("'","''", $ville);
   $adresseElectronique=str_replace("'","''", $adresseElectronique);
   $nomResponsable=str_replace("'","''", $nomResponsable);
   $prenomResponsable=str_replace("'","''", $prenomResponsable);
   
   $req="INSERT into Etablissement values ('$id', '$nom', '$adresseRue', 
         '$codePostal', '$ville', '$tel', '$adresseElectronique', '$type', 
         '$civiliteResponsable', '$nomResponsable', '$prenomResponsable',
         '$nombreChambresOffertes')";
   
   $connexion->query($req);
}


function estUnIdEtablissement($connexion, $id)
{
   $req="SELECT * from Etablissement where id='$id'";
   $rsEtab=$connexion->query($req);
   return $rsEtab->fetchAll();
}

function estUnNomEtablissement($connexion, $mode, $id, $nom)
{
   $nom=str_replace("'", "''", $nom);
   // S'il s'agit d'une création, on vérifie juste la non existence du nom sinon
   // on vérifie la non existence d'un autre établissement (id!='$id') portant 
   // le même nom
   if ($mode=='C')
   {
      $req="SELECT * from Etablissement where nom='$nom'";
   }
   else
   {
      $req="SELECT * from Etablissement where nom='$nom' and id!='$id'";
   }
   $rsEtab=$connexion->query($req);
   return $rsEtab->fetchAll();
}

function obtenirNbEtab($connexion)
{
   $req="SELECT count(*) as nombreEtab from Etablissement";
   $rsEtab=mysqli_query($connexion, $req);
   $lgEtab=mysqli_fetch_array($rsEtab);
   return $lgEtab["nombreEtab"];
}

function obtenirNbEtabOffrantChambres($connexion)
{
   $req="SELECT count(*) as nombreEtabOffrantChambres from Etablissement where 
         nombreChambresOffertes!=0";
   $rsEtabOffrantChambres=$connexion->query($req);
   $lgEtabOffrantChambres=$rsEtabOffrantChambres->fetch();
   return $lgEtabOffrantChambres["nombreEtabOffrantChambres"];
}

// Retourne false si le nombre de chambres transmis est inférieur au nombre de 
// chambres occupées pour l'établissement transmis 
// Retourne true dans le cas contraire
function estModifOffreCorrecte($connexion, $idEtab, $nombreChambres)
{
   $nbOccup=obtenirNbOccup($connexion, $idEtab);
   return ($nombreChambres>=$nbOccup);
}

// FONCTIONS RELATIVES AUX GROUPES

function obtenirReqIdNomGroupesAHeberger()
{
   $req="SELECT id, nom from Groupe where hebergement='O' order by id";
   return $req;
}

function obtenirNomGroupe($connexion, $id)
{
   $req="SELECT nom from Groupe where id='$id'";
   $rsGroupe=$connexion->query($req);
   $lgGroupe=$rsGroupe->fetch();
   return $lgGroupe["nom"];
}

// FONCTIONS RELATIVES AUX ATTRIBUTIONS

// Teste la présence d'attributions pour l'établissement transmis    
function existeAttributionsEtab($connexion, $id)
{
   $req="SELECT * From Attribution where idEtab='$id'";
   $rsAttrib=$connexion->query($req);
   return $rsAttrib->fetchAll();
}

// Retourne le nombre de chambres occupées pour l'id étab transmis
function obtenirNbOccup($connexion, $idEtab)
{
   $req="SELECT IFNULL(sum(nombreChambres), 0) as totalChambresOccup from
        Attribution where idEtab='$idEtab'";
   $rsOccup=$connexion->query($req);
   $lgOccup=$rsOccup->fetchAll();
   foreach ($lgOccup as $row) {
      return $row["totalChambresOccup"];
   }
}

// Met à jour (suppression, modification ou ajout) l'attribution correspondant à
// l'id étab et à l'id groupe transmis
function modifierAttribChamb($connexion, $idEtab, $idGroupe, $nbChambres)
{
   $req="SELECT count(*) as nombreAttribGroupe from Attribution where idEtab=
        '$idEtab' and idGroupe='$idGroupe'";
   $rsAttrib=$connexion->query($req);
   $lgAttrib=$rsAttrib->fetch();
   if ($nbChambres==0)
      $req="DELETE from Attribution where idEtab='$idEtab' and idGroupe='$idGroupe'";
   else
   {
      if ($lgAttrib["nombreAttribGroupe"]!=0)
         $req="UPDATE Attribution set nombreChambres=$nbChambres where idEtab=
              '$idEtab' and idGroupe='$idGroupe'";
      else
         $req="INSERT into Attribution values('$idEtab','$idGroupe', $nbChambres)";
   }
   $connexion->query($req);
}

// Retourne la requête permettant d'obtenir les id et noms des groupes affectés
// dans l'établissement transmis

// Suppresion de selectbase car ne sert à rien.
function obtenirReqGroupesEtab($id)
{
   $req="SELECT distinct id, nom from Groupe, Attribution where 
        Attribution.idGroupe=Groupe.id and idEtab='$id'";
   return $req;
}
            
// Retourne le nombre de chambres occupées par le groupe transmis pour l'id étab
// et l'id groupe transmis
function obtenirNbOccupGroupe($connexion, $idEtab, $idGroupe)
{
   $req="SELECT nombreChambres From Attribution where idEtab='$idEtab'
        and idGroupe='$idGroupe'";
   $rsAttribGroupe=$connexion->query($req);
   if ($lgAttribGroupe=$rsAttribGroupe->fetch())
      return $lgAttribGroupe["nombreChambres"];
   else
      return 0;
}

function obtenirGroupe()
{
   $req="SELECT * from Groupe"; 
   return $req;
}

function obtenirdetailGroupe($id)
  {
   $req="SELECT * from Groupe where id='$id' ";
   return $req;
  }

?>
