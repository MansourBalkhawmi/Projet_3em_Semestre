<?php

function encode_password(string $password) {
    $pepper = "momedrone";
    $pwd = $password;
    $pwd_peppered = hash_hmac("sha256", $pwd, $pepper);
    $pwd_hashed = password_hash($pwd_peppered, PASSWORD_ARGON2ID);

    return $pwd_hashed;
}

function check_password_match(string $password, string $pwd_hashed):bool {
    $pepper = "momedrone";
    $pwd_peppered = hash_hmac("sha256", $password, $pepper);
    if (password_verify($pwd_peppered, $pwd_hashed)) {
        return true;
    }
    else {
        return false;
    }
}

function get_list_per_page(array $list, int $page, int $nbrElementPerPage) {
    $totalElement = count($list);
    $nbrPage = get_nbrpage($list, $nbrElementPerPage);
    $iDepart = ($page -1) * $nbrElementPerPage;
    $iArrive = ($totalElement - $nbrPage) + $nbrElementPerPage;
    $listPerPage = array();
    for ($i=$iDepart; $i < $iDepart + $nbrElementPerPage; $i++) {
        if ($i >= $totalElement ) {
            return $listPerPage;
        } else {
            array_push($listPerPage, $list[$i]);
        }
    }

    return $listPerPage;
}

function get_nbrpage(array $list, int $nbrElementPerPage) {
    $totalElement = count($list);
    return ceil($totalElement/$nbrElementPerPage);
}