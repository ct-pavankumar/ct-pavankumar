<?php  

$server_name = 'localhost'; 
$user_name =	'root';
$password = '';
$database = 'api_example';

$conn = mysqli_connect($server_name,$user_name,$password,$database);

if($conn) {
	// echo 'success';
}else {
	echo 'not connected';
} 

?>