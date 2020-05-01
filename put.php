<?php 
	header('Content-Type: application/json');

	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "bukalapak";

	$conn = new mysqli($servername, $username, $password, $dbname);

	$smethod = $_SERVER['REQUEST_METHOD'];
	//untuk buat variabel $_PUT yang akan menyimpan $data dari curl-put yang diambil oleh parameter pertama parse str
	$headers = apache_request_headers();
	parse_str(file_get_contents('php://input'), $_PUT);
	//print_r($_PUT); die;
	//indeks harus sama dengan indeks pada curl-put.php
	//if(isset($_PUT['ID_driver'])==1){
	$nama = $headers['nama'];
	$token = $headers['token'];
	$id_customers = $_PUT['id_customers'];
	$nama_lengkap = $_PUT['nama_lengkap'];
	$alamat = $_PUT['alamat'];
	$no_hp = $_PUT['no_hp'];
	$email = $_PUT['email'];
	//}

	$result = array();

	if ($smethod=='PUT') {
        	if (empty($nama)||empty($token)) {
				$result['status']['code'] = 400;
			    $result['status']['description'] = 'Error Headers';
			}
			else {

        		$sql = "SELECT COUNT(nama) as jumlah FROM `token` where nama = '$nama' AND token = '$token'";
        		$result1 = $conn->query($sql);
        		$cek = $result1->fetch_assoc();

       			if ($cek['jumlah'] == 0) {
						$result['status']['code'] = 400;
					    $result['status']['description'] = 'wrong Token';	        
				}
				else
				{	

		            $result['status']['code'] = 'success';
		            $result['status']['description'] = 'Request OK';
					$sql = "UPDATE customers SET 
								nama_lengkap = '$nama_lengkap',
								alamat = '$alamat',
								no_hp = '$no_hp',
								email = '$email'
					 		WHERE id_customers='$id_customers';";
					$conn->query($sql);
					$result['results'] = 'id '.$id_customers.' row updated';
			}
				
        }
	}
        else{
            $result['status']['code'] = 400;
            $result['status']['description'] = 'Error Request';
        }

        echo json_encode($result);
