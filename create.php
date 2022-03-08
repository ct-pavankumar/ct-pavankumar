# api create code
<?php 
    require_once('config.php');
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST,GET");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    $user = $_REQUEST['uid'];
    $pass = $_REQUEST['key'];

    $name = $_REQUEST['name'];
    $email = $_REQUEST['email'];
    $password = $_REQUEST['password'];
    $sql = "select * from api_login where uid = '".$user."' and vkey = '".$pass."' ";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_num_rows($result);
    if($row == 1) {
        if($name != '' && $email != '' && $password != '')
        {
            $query = 'insert into api_crud (name,email,password) values("'.$name.'","'.$email.'","'.$password.'")';
            $result = mysqli_query($conn,$query);
            if($result)
            {
                $data = array(
                    'status' => 1,
                    'message' => 'Data inserted Successfully');
            }
            else{
                $data = array(
                    'status' => 2,
                    'message' => 'Data Not Inserted');
            }
        }else{
            $data = array(
                    'status' => 3,
                    'message' => 'All Fields are required');
        }
      
    }else {
        $data = array(
            'status' => 500,
            'message' => "Invalid Key or UID"
        );
    }
    
    echo json_encode($data);
    
   
?>
