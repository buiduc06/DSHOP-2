<!-- ket noi qua pdo -->
<?php  
function getconnection(){
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "php1_assignment";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
    // // set the PDO error mode to exception
    // $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // // echo "Connected successfully"; 
    return $conn;
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    	return false;
    }
}
?> 

<!-- ket mysqlli -->
<!-- <?php 
    // Kết nối CSDL
$conn = new mysqli('localhost', 'root', '', 'lab2_ducbnph05034');
 
// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
} 
 ?> -->