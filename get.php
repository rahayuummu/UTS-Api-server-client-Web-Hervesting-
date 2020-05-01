<?php 
	header('Content-Type: application/json');

	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "bukalapak";
	
	$conn = new mysqli($servername, $username, $password, $dbname);

	$smethod = $_SERVER['REQUEST_METHOD'];
	$headers = apache_request_headers();
	if(isset($_GET['key'])==1){
	$nama = $headers['nama'];
	$token = $headers['token'];
	$key = $_GET['key'];
	}
	
	if ($smethod=='GET') {
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
					    $result['status']['description'] = 'Wrong Token';	        
				}
				else
				{
						
		            $sql = "SELECT nama_lengkap, alamat, no_hp, email FROM customers where id_customers='$key'";
		            $q = $conn->query($sql);
					$result['results'] =  $q->fetch_all(MYSQLI_ASSOC);
			}
				
        }
	}
        else{
            $result['status']['code'] = 400;
            $result['status']['description'] = 'Error Request';
        }

        echo json_encode($result);
