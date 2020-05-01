<?php
$url = 'localhost/praktikum3/put.php';

$header = array(
'nama: rahayu',
'token: c81e728d9d4c2f636f067f89cc14862c'
);

$data = array(
'id_customers' => '1',
'nama_lengkap' => 'Andi cici',
'alamat' => 'mangga2',
'no_hp' => '08976547777',
'email' => 'cicimadinah@gmail.com'
);

$ch = curl_init();
//tentukan url tujuan
curl_setopt($ch, CURLOPT_URL, $url);
//mengabaikan ssl sertification
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
//request yang diterima di cobaput, ubah jadi PUT tapi tetap POST cara pengirimannya
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
//untuk masuk ke API atau autentifikasi karena kalau tidak server bisa down
curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
//berisi body atau data dalam array
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
//jalankan semua fungsi curl 
$result = curl_exec($ch);

echo $result;