<?php 
	header('Content-Type: application/json');

	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "tbukalapak";

	$conn = new mysqli($servername, $username, $password, $dbname);

	$smethod = $_SERVER['REQUEST_METHOD'];
	$headers = apache_request_headers();
	parse_str(file_get_contents('php://input'), $_DELETE);
	if(isset($_DELETE['id_customers'])==1){
	$nama = $headers['nama'];
	$token = $headers['token'];
	$id_customers = $_DELETE['id_customers'];
	}

	$result = array();
	$text = array_keys($_DELETE);
	if ($smethod=='DELETE') {
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
					    $result['status']['description'] = $text[0];	        
				}
				else
				{	

		            $result['status']['code'] = $id_driver;
		            $result['status']['description'] = 'Request OK';
					$sql = "DELETE FROM customers WHERE id_customers='$id_customers'";
					$conn->query($sql);
					$result['results'] = $id_driver;
			}
				
        }
	}
        else{
            $result['status']['code'] = 400;
            $result['status']['description'] = 'Error Request';
        }

        echo json_encode($result);
