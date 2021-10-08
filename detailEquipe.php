<?php
$nomPage='Détail équipe';
include("_debut.inc.php");
include("_gestionBase.inc.php"); 
include("_controlesEtGestionErreurs.inc.php");

$id=$_REQUEST['id'];  

// OBTENIR LE DÉTAIL DE L'ÉTABLISSEMENT SÉLECTIONNÉ

$lgEtab=obtenirdetailGroupe($id);
$obtenirdetailGroupe=$connexion->query($lgEtab);
$obtenirdetailGroupe=$obtenirdetailGroupe->fetchall();
foreach ($obtenirdetailGroupe as $row) {
   $nom=$row['nom'];
   $nombrePersonnes=$row['nombrePersonnes'];
   $identiteResponsable=$row['identiteResponsable'];
   $adressePostale=$row['adressePostale'];
   $nomPays=$row['nomPays'];
   $stand=$row['stand'];

   echo "
   <table width='60%' cellspacing='0' cellpadding='0' align='center' 
   class='tabNonQuadrille'>
      
      <tr class='enTeteTabNonQuad'>
         <td colspan='3'>$nom</td>
      </tr>
      <tr class='ligneTabNonQuad'>
         <td  width='20%'> Id: </td>
         <td>$id</td>
      </tr>
      <tr class='ligneTabNonQuad'>
         <td> Nombre de personne: </td>
         <td>$nombrePersonnes</td>
      </tr>
      <tr class='ligneTabNonQuad'>
         <td> Nom ligue: </td>
         <td>$identiteResponsable</td>
      </tr>
      <tr class='ligneTabNonQuad'>
         <td> Code postal: </td>
         <td>$adressePostale</td>
      </tr>
      <tr class='ligneTabNonQuad'>
         <td> Nom pays: </td>
         <td>$nomPays</td>
      </tr>
      <tr class='ligneTabNonQuad'>
         <td> stand: </td>";
         if($stand==1){
            echo"<td> oui </td>";
         }else{
            echo"<td> NON </td>";
         }
      echo"</tr>
         </table>";
}
?>
<p align='center'><a href='GestionEquipe.php'>retour</a></p>