<?php
if ( $_SERVER["SCRIPT_FILENAME"] == __FILE__ ){
    $racine="..";
}
include_once "$racine/modele/bd.naf.inc.php";

// recuperation des donnees GET, POST, et SESSION
if (isset($_POST["region"]) && isset($_POST["dep"]) && isset($_POST["section_code"]) && isset($_POST["division_code"])){
    $region=$_POST["region"];
    $departement=$_POST["dep"];
    $sectionCode=$_POST["section_code"];
    $divisionCode=$_POST["division_code"];
}
else{
    $region = "";
    $departement = "";
    $sectionCode = "";
    $divisionCode = "";
}
;


//Recuperation effectif total d'un departement
$effectifDep = "";
$effectifDep = getEffectifDepartement($departement);
$effectifDep =  implode(",", $effectifDep);

//Recuperation effectif total d'une region
$effectifReg = "";
$effectifReg = getEffectifRegion($region);
$effectifReg = implode(",", $effectifReg);

//recuperation effectif division 
if(empty($divisionCode)){
    $effectifDiv = "";
}
else{
    $effectifDiv = getEffectifDivision($divisionCode);
    $effectifDiv = implode(",", $effectifDiv);
    }

//recup divisions d'une section
$divisionSection = getDivisionSecteur($sectionCode);
$valeurMarcheSec = 0;
//calcul somme effectifs
$effectifSec = getSommeEffectifs($divisionSection);

$totalSec = 0;
// Parcours du tableau des sommes et addition
foreach($effectifSec as $sum) {
    $totalSec += $sum;
}

//Calcul valeur marche
if($effectifDep != ""){
    $valMarche = $effectifDep * 200;
} elseif($effectifReg != ""){
    $valMarche = $effectifReg * 200;
} elseif($effectifDiv != ""){
    $valMarche = $effectifDiv * 200;
} elseif($totalSec != ""){
    $valMarche = $totalSec * 200;
}


// appel du script de vue qui permet de gerer l'affichage des donnees
$titre = "Resultats de la recherche";
include "$racine/vue/entete.html.php";
include "$racine/vue/vueRecherche.php";
include "$racine/vue/pied.html.php";


?>