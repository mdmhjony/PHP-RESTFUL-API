<?php
include('conn.php');

$conn = connection();

header("Acess-Control-Allow-Origin: *");
header("Content-Type: application/json");


$data = file_get_contents("php://input");
$dataArray = json_decode($data, true);

if ($dataArray !== null) {
	$i=1;
    foreach ($dataArray as $any) {
        $amount = $any['amount'];
        $date = date('Y-m-d H:i:s');
        $title = $any['title'];
        $des = $any['description'];
		$sql = $conn->query("INSERT INTO installment (amount, date, title, description) VALUES ('$amount', '$date' ,' $title', '$des')");
		if($sql){
			echo json_encode(["status"=>"success",
			               
                            "Data"=>"$i",
                            "message"=>"create data executed successfully!"
                        ]
                        );
		}
		$i++;

    }

	 echo json_encode(["status"=>"success",
	 "message"=>" all data create and executed successfully!"
       ]);
   } else {
    echo json_encode(["status"=>"Error",
	   "message"=>"null data"
       ]);
}

$conn->close();

?>