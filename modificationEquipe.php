<?php
$nomPage='Création Equipe';
include("_debut.inc.php");
include("_gestionBase.inc.php"); 
include("_controlesEtGestionErreurs.inc.php");

// CRÉER UN ÉTABLISSEMENT 

// Déclaration du tableau des civilités 

// S'il s'agit d'une création et qu'on ne "vient" pas de ce formulaire (on 
// "vient" de ce formulaire uniquement s'il y avait une erreur), il faut définir 
// les champs à vide sinon on affichera les valeurs précédemment saisies
$id=$_REQUEST['id'];
$sql="SELECT * from Groupe where id='$id'";
$modi=$connexion->query($sql);
$modi=$modi->fetchall();
foreach($modi as $row){
echo "
<form method='POST' action='creationEquipe.php?'>
   <input type='hidden' value='validerCreEquip' name='action'>
   <table width='85%' align='center' cellspacing='0' cellpadding='0' 
   class='tabNonQuadrille'>
   
      <tr class='enTeteTabNonQuad'>
         <td colspan='3'>Nouveau groupe</td>
      </tr>";
      
     
      echo "
      <tr class='ligneTabNonQuad'>
         <td> Nom: </td>
         <td><input type='text' value='".$row['nom']."' name='nom' size='50'
         maxlength='45' required ></td>
      </tr>
      <tr class='ligneTabNonQuad'>
         <td> Nom ligue: </td>
         <td><input type='text' value='".$row['identiteResponsable']."' name='nombrePersonne' 
         size='50' maxlength='45' required></td>
      </tr>
      <tr class='ligneTabNonQuad'>
         <td> Code postal: </td>
         <td><input type='text' value='".$row['adressePostale']."' name='nomchefequipe' 
         size='4' maxlength='5' required></td>
      </tr>
      <tr class='ligneTabNonQuad'>
         <td> Nombre personne: </td>
         <td><input type='text' value='".$row['nombrePersonnes']."' name='prenomchefequipe' size='40' 
         maxlength='35' required></td>
      </tr>
      <tr class='ligneTabNonQuad'>
         <td> Nom pay: </td>
         <td><input type='text' value='".$row['nomPays']."' name='telequipe' size ='20' 
         maxlength='10' required></td>
      </tr>
      <tr class='ligneTabNonQuad'>
         <td> stand : </td>";
    if($row['stand']==1){
        echo" <td><input type='checkbox' value='".$row['stand']."' name=
         'stand' size ='75' maxlength='70' checked></td>";
    }else{
        echo" <td><input type='checkbox' value='".$row['stand']."' name=
         'stand' size ='75' maxlength='70' ></td>";
    }
  echo"  </tr>
  </table>";
   
   echo "
   <table align='center' cellspacing='15' cellpadding='0'>
      <tr>
         <td align='right'><input type='submit' value='Valider' name='valider'>
         </td>
         <td align='left'><input type='reset' value='Annuler' name='annuler'>
         </td>
      </tr>
      <tr>
         <td colspan='2' align='center'><a href='gestionEquipe.php'>Retour</a>
         </td>
      </tr>
   </table>
</form>";
}
// En cas de validation du formulaire : affichage des erreurs ou du message de 
// confirmation
// rajouter le update avec les valeur vue précédament
$action=$_REQUEST['action'];
if ($action=='validerCreEtab')
{
   if (nbErreurs()!=0)
   {
      afficherErreurs();
   }
   else
   {
      echo "
      <h5><center>La création de l'établissement a été effectuée</center></h5>";
   }
}

?>