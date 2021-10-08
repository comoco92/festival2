<?php
$nomPage='Suppression équipe';
include("gestionEquipe.php");
include("_debut.inc.php");



function supprimerEquipe($connexion, $id)
{
   $req="DELETE from Groupe where id='$id'";
   $connexion->exec($req);
}



// SUPPRIMER UN ÉTABLISSEMENT 

$id=$_REQUEST['id']; 

$lgEtab=obtenirdetailGroupe($id);
foreach ($lgEquip as $row) {
   $nom=$row['nom'];
}




// Cas 1ère étape (on vient de gestionEquipe.php)

if ($_REQUEST['action']=='demanderSupprEquip')    
{
   echo "
   <br><center><h5>Souhaitez-vous vraiment supprimer l'équipe $nom ? 
   <br><br>
   <a href='suppressionEquipe.php?action=validerSupprEtab&amp;id=$id'>
   Oui</a>&nbsp; &nbsp; &nbsp; &nbsp;
   <a href='gestionEquipe.php?'>Non</a></h5></center>";
}

// Cas 2ème étape (on vient de suppressionEquipe.php)

else
{
   supprimerEquipe($connexion, $id);
   echo "
   <br><br><center><h5>L'équipe $nom a été supprimé</h5>
   <a href='gestionEquipe.php?'>Retour</a></center>";
}

?>