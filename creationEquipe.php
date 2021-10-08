<?php
$nomPage='Création Equipe';
include("_debut.inc.php");
include("_gestionBase.inc.php"); 
include("_controlesEtGestionErreurs.inc.php");

// CRÉER UN ÉTABLISSEMENT 

// Déclaration du tableau des civilités
$tabCivilite=array("M.","Mme","Melle");  

$action=$_REQUEST['action'];

// les champs à vide sinon on affichera les valeurs précédemment saisies
if ($action=='demanderCreEtab') 
{  
   $nom='';
   $nombrePersonnes='';
   $identiteResponsable='';
   $adressePostale='';
   $adressePostale='';
   $nomPays='';
   $stand=0;
   $nombrePersonne='';
   $nomchefequipe='';
   $prenomchefequipe='';
   $telequipe='';
   $emailequipe='';

}
else
{
   $sql="SELECT id FROM Groupe ORDER by id Desc LIMIT 0,1";
            $sth=$connexion->query($sql);
            $resultat=$sth->fetchall(PDO::FETCH_ASSOC);
            foreach ($resultat as $row) {
                $code= $row['id'];
            }
            $codeC = substr($code, 0,3);
            $codeCh = substr($code, 3,4);
            $codeCh =$codeCh +1;
            if($codeCh>=10){
                $codeC = substr($code, 0,2);
                if($codeCh>=100){
                    $codeC = substr($code, 0,1);
                }
            }     
            $nom=$row['nom'];
            $nombrePersonnes=$row['nombrePersonnes'];
            $identiteResponsable=$row['identiteResponsable'];
            $adressePostale=$row['adressePostale'];
            $nomPays=$row['nomPays'];
            $stand=$row['stand'];

   verifierDonneesEtabC($connexion, $id, $nom, $adresseRue, $codePostal, $ville,  
                        $tel, $nomResponsable, $nombreChambresOffertes);      
   if (nbErreurs()==0)
   {        
      creerEquipe($connexion, $id, $nom, $nombrePersonne, $nomchefequipe, 
      $prenomchefequipe, $telequipe, $emailequipe, $type);
   }
}

echo "
<form method='POST' action='creationEquipe.php?'>
   <input type='hidden' value='validerCreEquip' name='action'>
   <table width='85%' align='center' cellspacing='0' cellpadding='0' 
   class='tabNonQuadrille'>
   
      <tr class='enTeteTabNonQuad'>
         <td colspan='3'>Nouveau groupe</td>
      </tr>";
      
     
      echo '
      <tr class="ligneTabNonQuad">
         <td> Nom*: </td>
         <td><input type="text" value="'.$nom.'" name="nom" size="50" 
         maxlength="45" required ></td>
      </tr>
      <tr class="ligneTabNonQuad">
         <td> Nombre de personne*: </td>
         <td><input type="text" value="'.$nombrePersonne.'" name="nombrePersonne" 
         size="50" maxlength="45" required></td>
      </tr>
      <tr class="ligneTabNonQuad">
         <td> Nom du chef d équipe*: </td>
         <td><input type="text" value="'.$nomchefequipe.'" name="nomchefequipe" 
         size="4" maxlength="5" required></td>
      </tr>
      <tr class="ligneTabNonQuad">
         <td> Prenom du chef d équipe*: </td>
         <td><input type="text" value="'.$prenomchefequipe.'" name="prenomchefequipe" size="40" 
         maxlength="35" required></td>
      </tr>
      <tr class="ligneTabNonQuad">
         <td> Téléphone*: </td>
         <td><input type="text" value="'.$telequipe.'" name="telequipe" size ="20" 
         maxlength="10" required></td>
      </tr>
      <tr class="ligneTabNonQuad">
         <td> E-mail: </td>
         <td><input type="text" value="'.$emailequipe.'" name=
         "emailequipe" size ="75" maxlength="70" required></td>
      </tr>
  </table>';
   
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

// En cas de validation du formulaire : affichage des erreurs ou du message de 
// confirmation
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