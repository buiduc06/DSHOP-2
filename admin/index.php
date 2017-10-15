<?php $checksesion=session_start(); ?><!-- gán hàm session bằng checksesion rồi vào header kiem tra neu bien này ton tai thi không bật sessionstart nữa -ducdeveloper -->
<?php if (isset($_SESSION['name'])) {
if ($_SESSION['name']=='admin'){//check neu sesion name bâng admin thi cho vao
?>

<?php require_once 'header.php'; ?>
	
		<div class="content"></div>
<?php require_once 'footer.php'; ?>

<?php 
	
}else{
		echo "<center><img src='../images/knight.png'><p style='color:green;font-size:40px;margin-left:20px;'>Security</p></center>";
		echo "<center style='margin-top:40px;font-size:18px;'>xin lỗi " .'<b>'.$_SESSION['name'].'</b>' ." Bạn không Đủ Quyền truy cập trang này nếu là quản trị viên vui lòng <a href='../login.php'>Đăng Nhập</a> hoặc trở về <a href='../index.php'>TrangChủ</a>";
	}
}else{
		echo "<center><img src='../images/knight.png'><p style='color:green;font-size:40px;margin-left:20px;'>Security</p></center>";
		echo "<center>xin lỗi bạn không Đủ Quyền truy cập trang này nếu là quản trị viên vui lòng <a href='../login.php'>Đăng Nhập</a> hoặc trở về <a href='../index.php'>TrangChủ</a>";
	}

 ?>
 <!-- //ket thuc rang buoc -->
