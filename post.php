<?php 
	header('Content-Type: application/json');

	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "bukalapak";

	$conn = new mysqli($servername, $username, $password, $dbname);

	$smethod = $_SERVER['REQUEST_METHOD'];
	$headers = apache_request_headers();
	if(isset($_POST['nama_lengkap'])==1){
		$nama = $headers['nama'];
		$token = $headers['token'];
		$nama_lengkap = $_POST['nama_lengkap'];
		$alamat = $_POST['alamat'];
		$no_hp = $_POST['no_hp'];
		$email = $_POST['email'];
	}
	
	$result = array();

	if ($smethod=='POST') {
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
					$sql = "INSERT INTO customers (
										nama_lengkap,
										alamat,
										no_hp,
										email)
					VALUES ('$nama_lengkap', 'alamat', '$no_hp', '$email');";
					$conn->query($sql);
					$result['results'] = '1 row inserted';
			}
				
        }
	}
        else{
            $result['status']['code'] = 400;
            $result['status']['description'] = 'Error Request';
        }

        echo json_encode($result);
