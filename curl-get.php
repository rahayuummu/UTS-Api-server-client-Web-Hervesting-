<?php
$url = 'localhost/praktikum3/get.php';

$header = array(
'nama: rahayu',
'token: c81e728d9d4c2f636f067f89cc14862c'
);


$data = array (
    'key' => '1'
    );
    
    $params = http_build_query($data);

$ch = curl_init();

//tentukan url tujuan
curl_setopt($ch, CURLOPT_URL, $url.'?'.$params );
//mengabaikan ssl sertification
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
//return the transfer as a string
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//untuk masuk ke API atau autentifikasi
curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
$result = curl_exec($ch);

echo $result;