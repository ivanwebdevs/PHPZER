<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


$servername = "127.0.0.1";
$username = "";
$password = "";
$dbname = "";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

function query($sql){
    global $conn;
    try{
        if ($data = $conn->query($sql)) {

            $data_row = [];
            while($row = $data->fetch_assoc()) {
                $data_row[] = $row;
            }
            if (count($data_row) > 0){
                $data_to_encode = json_encode($data_row);
                $data_row = json_decode($data_to_encode);
                return (object)[
                    "status"=>true,
                    "data"=> $data_row
                ];
            }else{
                return (object)[
                    "status"=>false,
                    "msg"=>"Tidak ada Data"
                ];
            }
        }else{
            return (object)[
            "status"=>false,
            "msg"=>"Gagal Query ERROR UNKNOWN"
            ];
        }
    }
    catch(Exception $e) {
        return (object)[
            "status"=>false,
            "msg"=>$e->getMessage()
            ];
    }
    
}
function query_input($sql){
    global $conn;
    try{
        if ($data = $conn->query($sql)) {
            return (object)[
                "status"=>true,
                "msg"=>"Berhasil"
            ];
              
        }
    }
    catch(Exception $e) {
        return (object)[
            "status"=>false,
            "msg"=>$e->getMessage()
            ];

    }
    
}

function query_update($sql){
    global $conn;
    try{

       if ($conn->query($sql) === TRUE) {
          if ($conn->affected_rows > 0){
              return (object)[
                "status"=>false,
                "msg"=>"Berhasil Update data",
                "affected_rows" => $conn->affected_rows
              ];
          }else{
              return (object)[
                "status"=>false,
                "msg"=>"Data tidak di temukan"
              ];
          }
        } else {
          return (object)[
            "status"=>false,
            "msg"=>"Gagal update ERROR UNKNOWN"
            ];
        }
    }
    catch(Exception $e) {
        return (object)[
            "status"=>false,
            "msg"=>$e->getMessage()
            ];

    }
    
}




