<?php
$nomPage = "Supprimer un établissment";
include "_debut.inc.php";
include("_gestionBase.inc.php"); 
include("_controlesEtGestionErreurs.inc.php");

// SUPPRIMER UN ÉTABLISSEMENT 

$id=$_REQUEST['id'];  

$lgEtab=obtenirDetailEtablissement($connexion, $id);
foreach ($lgEtab as $row) {
   $nom=$row['nom'];
}

// Cas 1ère étape (on vient de gestionEquipe.php)

if ($_REQUEST['action']=='demanderSupprEtab')    
{
   echo "
   <br><center><h5>Souhaitez-vous vraiment supprimer l'établissement $nom ? 
   <br><br>
   <a href='suppressionEquipe.php?action=validerSupprEtab&amp;id=$id'>
   Oui</a>&nbsp; &nbsp; &nbsp; &nbsp;
   <a href='gestionEquipe.php?'>Non</a></h5></center>";
}

// Cas 2ème étape (on vient de suppressionEquipe.php)

else
{
   supprimerEtablissement($connexion, $id);
   echo "
   <br><br><center><h5>L'établissement $nom a été supprimé</h5>
   <a href='listeEtablissements.php?'>Retour</a></center>";
}

?>
