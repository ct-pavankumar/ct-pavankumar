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
    $user_email = $_REQUEST['user_email'];
    $name = $_REQUEST['name'];
    $email = $_REQUEST['email'];
    $password = $_REQUEST['password'];
    $sql = "select * from api_login where uid = '".$user."' and vkey = '".$pass."' ";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_num_rows($result);
    if($row == 1) {
        if($user_email != '')
        {
            $query1 = "select id from api_crud where email = '".$user_email."' ";
            $result1 = mysqli_query($conn,$query1);
            $id = mysqli_fetch_assoc($result1);
            if($id != NULL){
                if($name != '' && $email != '' && $password != '')
                {
                    $query = "update api_crud set name = '".$name."', email = '".$email."', password = '".$password."' where id = '".$id['id']."'";
                    $result = mysqli_query($conn,$query);
                    if($result != true)
                    {
                        $data = array(
                            'status' => 2,
                            'message' => 'Data not updated');
                    }
                    else{
                        $data = array(
                            'status' => 1,
                            'message' => 'Data updated Successfully');
                    }
                }else{
                    $data = array(
                            'status' => 3,
                            'message' => 'All Fields are required');
                }
            }else{
                $data = array(
                    'status' => 2,
                    'message' => 'user email not valid');
            }
        }else{
            $data = array(
                    'status' => 2,
                    'message' => 'user email required');
        } 
    }else {
        $data = array(
            'status' => 500,
            'message' => "Invalid Key or UID"
        );
    }
    
    echo json_encode($data);
    
   
?>
