<?php
$nomPage = "Liste des établissments";
include "_debut.inc.php";
include("_gestionBase.inc.php"); 
include("_controlesEtGestionErreurs.inc.php");

// AFFICHER L'ENSEMBLE DES ÉTABLISSEMENTS
// CETTE PAGE CONTIENT UN TABLEAU CONSTITUÉ D'1 LIGNE D'EN-TÊTE ET D'1 LIGNE PAR
// ÉTABLISSEMENT

echo "
<table width='70%' cellspacing='0' cellpadding='0' align='center' 
class='tabNonQuadrille'>
   <tr class='enTeteTabNonQuad'>
      <td colspan='4'>Etablissements</td>
   </tr>";
     
   $req=obtenirReqEtablissements();
   $rsEtab=$connexion->query($req);
   $lgEtab=$rsEtab->fetchAll();
   // BOUCLE SUR LES ÉTABLISSEMENTS
   while ($lgEtab!=FALSE)
   {
      foreach ($lgEtab as $row){
      $id=$row['id'];
      $nom=$row['nom'];
      echo "
		<tr class='ligneTabNonQuad'>
         <td width='52%'>$nom</td>
         
         <td width='16%' align='center'> 
         <a href='detailEtablissement.php?id=$id'>
         Voir détail</a></td>
         
         <td width='16%' align='center'> 
         <a href='modificationEtablissement.php?action=demanderModifEtab&amp;id=$id'>
         Modifier</a></td>";
      	
         // S'il existe déjà des attributions pour l'établissement, il faudra
         // d'abord les supprimer avant de pouvoir supprimer l'établissement
			if (!existeAttributionsEtab($connexion, $id))
			{
            echo "
            <td width='16%' align='center'> 
            <a href='suppressionEtablissement.php?action=demanderSupprEtab&amp;id=$id'>
            Supprimer</a></td>";
         }
         else
         {
              $résulte=obtenirNbOccup($connexion,$row['id']);
            echo "
            <td width='16%'>($résulte attributions) </td>";          
			}
			echo "
      </tr>";
      $lgEtab=$rsEtab->fetchAll();
      }
   }   
   echo "
   <tr class='ligneTabNonQuad'>
      <td colspan='4'><a href='creationEtablissement.php?action=demanderCreEtab'>
      Création d'un établissement</a ></td>
  </tr>
</table>";

?>
