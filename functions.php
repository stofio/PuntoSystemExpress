<?php

include_once 'db/conn.php';

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

/**
 * function to calculate commissions, default, or users (if set)
 * return price with commissions.
 */
function getClientCommissionsCalculated($supplierPrice, $clientId) {
    //get client commission db
    require 'db/conn.php';
    $sql = "SELECT * FROM `commissions` WHERE `userid_FK` = $clientId";
    $result = mysqli_query($conn, $sql);
    
    //CLIENT
    $userComm = mysqli_fetch_assoc($result);

    //get default commission json
    $jsonString = file_get_contents($_SERVER['DOCUMENT_ROOT']."/commissions_default.json");
    $commissionsArr = json_decode($jsonString,true);

    //DEFAULTS
    $minComm = $commissionsArr['min_commission']; //euro
    $margin = $commissionsArr['margin']; //euro
    $molPerc = $commissionsArr['mol_perc']; //%

    
    $commissions['marg'] = $margin;
    
    //if client has its own
    if($userComm != null) {
        //calculate
        $commissions['min'] = $userComm['min_commission'] == 0 ? $minComm : $userComm['min_commission'];
        $commissions['mol'] = $userComm['mol_percent'] == 0 ? $molPerc : $userComm['mol_percent'];
        $calculatedPrice = calculateCommission($supplierPrice, $commissions);
    }
    else {
        //get default commission
        $commissions['min'] = $minComm;
        $commissions['mol'] = $molPerc;
        $calculatedPrice = calculateCommission($supplierPrice, $commissions);
    }

    return $calculatedPrice;
}

//return discounted price
function calculateDiscount($price, $discountPercent) {
    return $price - ($price * ($discountPercent/100));
}

function getDiscountinfo($userid, $requestid) {
    require 'db/conn.php';
    $discountUsed = mysqli_query($conn, "SELECT * FROM user_discounts WHERE useridfk='$userid' and requestidfk='$requestid'");
    return mysqli_fetch_assoc($discountUsed);
}


/**
 * calculate commissions. Return minimum, or bigger
 */
function calculateCommission($supplierPrice, $commissions) {

    //calc percentage
    $calculPricePercentage = $supplierPrice / 100 * $commissions['mol']; 



    //if its below margin, calculate
    if($supplierPrice < $commissions['marg']) {
        //if is below minimum, use minumum
        if($calculPricePercentage < $commissions['min']) {
            return $supplierPrice + $commissions['min'];
        }
        else { //use bigger
            return $supplierPrice + $calculPricePercentage;
        }
    }
    else { //if its bigger then margin, use percentage 
        return  $supplierPrice + $calculPricePercentage;
    }

}







?>