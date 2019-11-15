<?php

/**
 * @author Copyright 2019 Izzeldin Addarda <zeldin@merahputih.id>
 * @package Auto Create Account Gojek & Redeem Voucher
 * Change the copyright doesn't make you as a Proffesional CODER.
 **/

require "./class.php";
echo "[#] Nomor : "; $nomor = trim(fgets(STDIN));
$gojek = new Gojek($nomor);
$register = $gojek->register();
if(isset($register['success'])){
    if($register['message'] == null){
        die("User already registered.");
    }
    echo "[#] OTP : "; $otp = trim(fgets(STDIN));
    $send = $gojek->send_otp($register['otp_token'], $otp);
    while(!$send['success']){
        echo "[!] Invalid OTP.".PHP_EOL;
        echo "[#] OTP : "; $otp = trim(fgets(STDIN));
        $send = $gojek->send_otp($register['otp_token'], $otp);
    }
    echo "[+] Access token: ".$send['access_token'].PHP_EOL;
    echo "[$] Try to redeem GOFOODSANTAI19".PHP_EOL;
    sleep(3);
    echo $gojek->redeem("GOFOODSANTAI19", 0, $send['access_token'])['success'] == true ? "\n[$] Success redeem GOFOODSANTAI19..".PHP_EOL : "\n[!] Failed redeem GOFOODSANTAI19..".PHP_EOL;
    sleep(5);
    echo "[$] Try to redeem GOFOODSANTAI11".PHP_EOL;
    echo $gojek->redeem("GOFOODSANTAI11", 0, $send['access_token'])['success'] == true ? "\n[$] Success redeem GOFOODSANTAI11..".PHP_EOL : "\n[!] Failed redeem GOFOODSANTAI11..".PHP_EOL;
    sleep(5);
    echo "[$] Try to redeem GOFOODSANTAI08".PHP_EOL;
    echo $gojek->redeem("GOFOODSANTAI08", 0, $send['access_token'])['success'] == true ? "\n[$] Success redeem GOFOODSANTAI08..".PHP_EOL : "\n[!] Failed redeem GOFOODSANTAI08..".PHP_EOL;
}else{
    print("\n".$register['message'].PHP_EOL);
}
?>
