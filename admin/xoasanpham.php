<?php $checksesion=session_start(); ?><!-- gán hàm session bằng checksesion rồi vào header kiem tra neu bien này ton tai thi không bật sessionstart nữa -ducdeveloper -->
<?php if ($_SESSION['name']=='admin'){//check neu sesion name bâng admin thi cho vao
?>

<?php 
$id=$_GET['id'];
	require('dbconnect.php');
	$conn=getconnection();
	$query="DELETE FROM products WHERE products_id=:id";
	$stmt=$conn->prepare($query);
	$stmt->bindvalue(':id',$id);
	$stmt->execute();
	header('location: quanlysanpham.php');
 ?>

 <?php 
	}else{
		echo "<center>xin lỗi bạn không được phép truy cập trang này nếu là quản trị viên vui lòng <a href='../login.php'>Đăng Nhập</a> lại";
	}
 ?>