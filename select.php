<?php 
    require_once('config.php');
    error_reporting(0);
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST,GET");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    $user = $_REQUEST['uid'];
    $pass = $_REQUEST['key'];
    if($_REQUEST['email'] != '' && $_REQUEST['password'] != '')
    {
        $email = $_REQUEST['email'];
        $password = $_REQUEST['password'];
    }
     echo 'hiii';
    $sql = "select * from api_login where uid = '".$user."' and vkey = '".$pass."' ";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_num_rows($result);
    if($row == 1) {
        if($email != '' && $password != '') {
            $query = "select * from api_crud where email = '".$email."' and password = '".$password."'";
            $result = mysqli_query($conn,$query);
            $row = mysqli_fetch_assoc($result);
            if($row) {
                $data = array(
                    'email' => $row['email'],
                    'password' => $row['password'],
                    'status' => 2,
                    'message' => 'success',
                );
            } 
        }else {
            $query1 = "select * from api_crud";
            $result1 = mysqli_query($conn,$query1);
            foreach($result1 as $row1) {
                $data[] = array(
                    'name' => $row1['name'],
                    'email' => $row1['email'],
                    'password' => $row1['password'],
                    'status' => 1,
                    'message' => 'success',
                    );
            }
        }
         
    }else {
        $data = array(
            'status' => 500,
            'message' => "Invalid Key or UID"
        );
    }
    
    echo json_encode($data);
    
   
?>
