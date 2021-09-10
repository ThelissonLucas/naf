<?php

include_once "bd.inc.php";

function getDep() {
    $resultat = array();

    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("select * from departement");
        $req->execute();

        $ligne = $req->fetch(PDO::FETCH_ASSOC);
        while ($ligne) {
            $resultat[] = $ligne;
            $ligne = $req->fetch(PDO::FETCH_ASSOC);
        }
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    return $resultat;
}

function getRegions() {
    $resultat = array();

    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("select DISTINCT region from departement");
        $req->execute();

        $ligne = $req->fetch(PDO::FETCH_ASSOC);
        while ($ligne) {
            $resultat[] = $ligne;
            $ligne = $req->fetch(PDO::FETCH_ASSOC);
        }
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    return $resultat;
}

function getSections() {
    $resultat = array();

    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("select DISTINCT section_code,section_libelle from naf");
        $req->execute();

        $ligne = $req->fetch(PDO::FETCH_ASSOC);
        while ($ligne) {
            $resultat[] = $ligne;
            $ligne = $req->fetch(PDO::FETCH_ASSOC);
        }
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    return $resultat;
}

function getDivisions() {
    $resultat = array();

    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("select division_code, division_libelle from naf");
        $req->execute();

        $ligne = $req->fetch(PDO::FETCH_ASSOC);
        while ($ligne) {
            $resultat[] = $ligne;
            $ligne = $req->fetch(PDO::FETCH_ASSOC);
        }
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    return $resultat;
}

function getEffectifDepartement($departement) {
    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("select sum(EFF_TOT) from effectifs where dep = '".$departement."'");
        $req->execute();

        $ligne = $req->fetch(PDO::FETCH_ASSOC);

    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    return $ligne;
}

function getEffectifRegion($region) {
    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("select sum(EFF_TOT) from effectifs inner join departement on effectifs.DEP = departement.cp where region = '".$region."'");
        $req->execute();

        $ligne = $req->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    return $ligne;
}


function getEffectifDivision($divisionCode) {
    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("select sum(EFF_".$divisionCode.") from effectifs");
        $req->execute();

        $ligne = $req->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    return $ligne;
}

function getDivisionSecteur($secteurCode) {
    $resultat = array();

    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("SELECT division_code FROM `naf` WHERE section_code = '$secteurCode'");
        $req->execute();

        $ligne = $req->fetch(PDO::FETCH_ASSOC);
        while ($ligne) {
            $resultat[] = $ligne;
            $ligne = $req->fetch(PDO::FETCH_ASSOC);
        }
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    return $resultat;
}

function getSommeEffectifs($DivisionSection){
    $resultat = array();

    try {
        $cnx = connexionPDO();
        foreach($DivisionSection as $code) {
            $column = "EFF_".$code['division_code'];
            $req = $cnx->prepare("SELECT SUM($column) as sum FROM `effectifs`");
            $req->execute();
            
            $ligne = $req->fetch(PDO::FETCH_ASSOC);
            if($ligne) {
                $resultat[] = $ligne["sum"];
            }
        }
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    return $resultat;
}