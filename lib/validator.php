<?php
function est_vide($valeur) {
    return empty($valeur);
}

function est_entier($valeur) {
    return is_numeric($valeur);
}

function valide_libelle(array &$arrayError, string $key, $valeur) {
    if (est_vide(trim($valeur))) {
        $arrayError[$key] = "Champ obligatoire";
    }
}

function valid_champ_select2(array &$arrayError, $str, string $key) {
    $valeur=str_replace(" ","",$str);
    if (est_vide($valeur)) {
        $arrayError[$key] = "Choisit module";
    }
}


function valide_champs(array &$arrayError, string $key, $valeur) {
    if (est_vide(trim($valeur))) {
        $arrayError[$key] = "Champ obligatoire";
    } elseif(!est_entier($valeur)) {
        $arrayError[$key] = "Veuillez saisir votre numéro";
    }
}
function valide_champs1(array &$arrayError, string $key, $valeur) {
    if (est_vide(trim($valeur))) {
        $arrayError[$key] = "Champ obligatoire";
    } elseif(!est_entier($valeur)) {
        $arrayError[$key] = "Veuillez saisir un nombre";
    }elseif(est_entier($valeur) &&  $valeur<0){
        $arrayError[$key] = "Veuillez saisir un nombre positif";
    }
}

function valide_email_regex(array &$arrayError, string $key, $valeur) {
    $pattern = "/@+\.+";
    if (est_vide(trim($valeur))) {
        $arrayError[$key] = "Champ obligatoire";
    } elseif(preg_match($pattern, $valeur) == 0) {
        $arrayError[$key] = "Veuillez saisir une adresse mail valide";
    }
}

?>
