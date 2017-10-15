<?php $checksesion=session_start(); ?><!-- gán hàm session bằng checksesion rồi vào header kiem tra neu bien này ton tai thi không bật sessionstart nữa -ducdeveloper -->
<?php if ($_SESSION['name']=='admin'){//check neu sesion name bâng admin thi cho vao
?>

<?php include('header.php'); ?>
		<div class="content">
			<form action="themchuyenmuc.php" method="POST" id="createcategories">
			<table>
			<b>Thêm Chuyên Mục</b>
			<tr>
				<td>Tên Chuyên Mục
				<input type="text" name="catename" placeholder="Example: Moblie,LapTop..." ></td>
				<td></td>
				<td><button type="submit" name="check" value="check">Thêm</button></td>
			</tr>
			</table>
			</form>
		</div>							
			<!-- code php -->
<center>
<?php

if (isset($_POST['check'])) {

	//CHECK DANH MUC
	$checkdanhmuc=array();
	require_once 'dbconnect.php';
	$conn=getconnection();
	$query="SELECT * FROM categories";
	$stmt=$conn->prepare($query);
	$stmt->execute();
	$result12=$stmt->fetchall();
	foreach ($result12 as $value) {
		$checkdanhmuc[]=$value['cate_name']; // gán tất cả các chuyên mục vào 1 mảng
	}
	$checkdl=in_array($_POST['catename'],$checkdanhmuc); // tìm trong mảng đó xem có tồn tại chuyên mục mà ng dùng nhập ko
	if ($checkdl==TRUE) {// nếu tên dmục bị trùng thì dừng và in ra thông báp
		echo "Tên Danh Mục Đã Tồn Tại";

	}else{ 
		
// THEM DANH MUC VAO CSDL
	if (empty($_POST['catename'])) {
		echo "Vui Lòng Nhập Tên Chuyên Mục";
	}else{
		$catename=$_POST['catename'];
	}
	if (isset($catename)) {
	require_once 'dbconnect.php';
	$conn=getconnection();
	$query="INSERT INTO categories
						(cate_name)
				VALUES (:cate_name)";
	$stmt=$conn->prepare($query);
	$stmt->bindvalue(':cate_name', $catename);
	$stmt->execute();
	header('location:quanlychuyenmuc.php');
	}
}
}
 ?>

 <!-- code php -->
 </center>
<?php include('footer.php'); ?>

<?php 
	}else{
		echo "<center>xin lỗi bạn không được phép truy cập trang này nếu là quản trị viên vui lòng <a href='../login.php'>Đăng Nhập</a> lại";
	}
 ?>