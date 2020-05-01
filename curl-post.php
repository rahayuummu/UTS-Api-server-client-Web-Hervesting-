<?php
$url = 'localhost/praktikum3/post.php';

$header = array(
'nama: rahayu',
'token: c81e728d9d4c2f636f067f89cc14862c'
);

$data = array(
'nama_lengkap' => 'yudit yervi',
'alamat' => 'nhp',
'no_hp' => '089655979125', 
'email' => 'yudityervi@gmail.com'
);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
//menggunakan method post
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
$result = curl_exec($ch);

echo $result;