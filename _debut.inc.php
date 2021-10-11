<?php //manquait balise php

echo '
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" 
"http://www.w3.org/TR/html4/loose.dtd">
<!-- TITRE ET MENUS -->
<html lang="fr">
<head>
<!-- menu -->
<div class="navbar">
   <img src="images/logo.png" alt= "Logo de la M2L" height="120px" width="120px"/>
   <a href="index.php">
      Accueil
   </a>
   <a href="listeEtablissements.php">
      Gestion établissements
   </a>
   <a href="consultationAttributions.php">
      Attributions chambres
   </a>
   </ul>
</div>

<title>Festival- ';
echo $nomPage ;
echo '</title>
<meta http-equiv="Content-Language" content="fr">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="css/cssGeneral.css" rel="stylesheet" type="text/css">
</head>
<body class="basePage">

<!--  Tableau contenant le titre -->
<table width="100%" cellpadding="0" cellspacing="0">
   <tr> 
   
      <td class="titre"> Festival Sp’Or <br>
      <span id="texteNiveau2" class="stexteNiveau2">
      H&eacute;bergement des groupes</span><br>&nbsp;
      </td>
   </tr>
   
</table>
<hr>
<br>';
?>

