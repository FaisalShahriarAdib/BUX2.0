<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $couponCode = $_POST['coupon_str'];

    if ($couponCode === 'jmatik10') {
        $discountAmount = 10; 
        echo $discountAmount;
    }
    
    if ($couponCode === 'jmatik50') {
        $discountAmount = 50; 
        echo $discountAmount;
    }

    if ($couponCode === 'new25') {
        $discountAmount = 25; 
        echo $discountAmount;
    }
    if ($couponCode === 'first5') {
        $discountAmount = 5; 
        echo $discountAmount;
    }
    else {

        echo 'The code is invalid';
    }
} else {
    echo 'error';
}
?>
