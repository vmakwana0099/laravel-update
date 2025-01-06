<?php
    $curr = isset($_REQUEST['curr'])?$_REQUEST['curr']:"INR";
    if($curr == 'INR'){
        $dataINR = file_get_contents('pricingINR.js');
        $dataINR = json_decode($dataINR,true);
        ksort($dataINR);
        echo '<pre>';print_r($dataINR);    
    }
    else {
        $dataUSD = file_get_contents('pricingUSD.js');
        $dataUSD = json_decode($dataUSD,true);
        ksort($dataUSD);
        echo '<pre>';print_r($dataUSD);    
    }
    
?>