<?php
$nomPage = "gestion des équipes ";
include "_debut.inc.php";
include("_gestionBase.inc.php"); 
include("_controlesEtGestionErreurs.inc.php");

// création du tableau 
echo"
      <p align='center'><td><a href='creationEquipe.php?action=demanderCreEtab'>
      Création d'une equipe</a ><p>";

echo "
<table width='70%' cellspacing='0' cellpadding='0' align='center' 
class='tabQuadrille'>
   <tr class='enTeteTabNonQuad'>
      <td>Equipes</td>
      <td>Nom du groupe</td>
      <td> Stand du groupe</td>
      <td> Modifications ou suppresion de groupe</td>
   </tr>";

   $req=obtenirGroupe();
   $rsEquip=$connexion->query($req);
   $lgEquip=$rsEquip->fetchAll();

    foreach ($lgEquip as $row){
      $id=$row['id'];
      $nom=$row['nom'];
      $nombrePersonnes=$row['nombrePersonnes'];
      $stand=$row['stand'];
            echo "<tr class='ligneTabQuad'>";
            if($nombrePersonnes == 0){
            }else{
                echo"<td>Équipe de ".$nombrePersonnes." personne <a href='detailEquipe.php?id=$id'>Détail</a></td>";
            echo"<td>".$nom."</td>";
           if ($stand == 1) {
            echo"<td><input type='checkbox'  value='1' checked='yes' ></input></td>";
      }else{
            echo"<td><input type='checkbox'  value='0'></input></td>";
      }
      echo"<td><a href='modificationEquipe.php?action=demanderModifEqu&amp;id=$id'>Modifier</a> / "; 
      $req="SELECT * from attribution where idGroupe = '$id'";
      $teste=$connexion->query($req);
      $teste=$teste->fetchAll();
      $cpt=0;
      foreach ($teste as $row) {
         $cpt=$cpt+1;
      }
      if($cpt>0){
         echo " *";
      }else{
      echo "<a href='suppressionEquipe.php?action=demanderSupprEqu&amp;id=$id'>Supprimer</a></td>";}
      }
  }
?>