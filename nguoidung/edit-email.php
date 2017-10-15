<?php require_once 'header.php'; ?>
<?php if ($_SESSION['name']){//check neu sesion name bâng admin thi cho vao
?>
<?php 
// phần upload hình ảnh
if (isset($_POST['check'])) {
	$email=$_POST['txtemail'];
// them email vao mýql
if (isset($email)) {
	$username=$_SESSION['name'];
	require_once '../admin/dbconnect.php';
	$conn=getconnection();
	$query="UPDATE users SET email=:email WHERE username=:username";
	$stmt=$conn->prepare($query);
	$stmt->bindvalue(':email',$email);
	$stmt->bindvalue(':username',$username);
	$stmt->execute();
	header('location: index.php?updateinfo=true');
}
}
 ?>

 <!-- phan lay ra hinh anh -->
<?php 

$usename=$_SESSION['name'];
require_once '../admin/dbconnect.php';
$conn=getconnection();
$query=" SELECT * FROM users WHERE username='$usename'";
$stmt=$conn->prepare($query);
$stmt->execute();
$result2=$stmt->fetchall();
 ?>

<div class="content">
<h4>Chỉnh Sửa Email</h4>
<form action="edit-email.php" method="POST" accept-charset="utf-8" enctype="multipart/form-data" >
<div class="content-col1">
<!-- phần hình ảnh -->
	<div class="content-col1-images">
	<?php foreach ($result2 as $value) {
	 ?>
	 <!-- nếu ko tồn tại ảnh thì gán ảnh bằng ảnh no_image.jpg -->
	 <?php if ($value['avatar']!=null) {
				$value['avatar'];
			}else{
				$value['avatar']='images/No_image.jpg';
				} ?>
	
		<img src="../<?= $value['avatar'] ?>" alt="">
		<?php } ?>
	</div>


</div>
<div class="content-col2">
	<table>

			<tr>
				<td>Email</td>
				<td><input type="email" name="txtemail" value="<?= $value['email']; ?>" required></td>
			</tr>

	</table>
</div>
		<tr>
				<td></td>
				<td><button type="submit" name="check">Chỉnh Sửa</button></td>
			</tr>
</form>
</div>

	<?php require_once 'aside.php'; ?>
<?php require_once 'footer.php'; ?>
<?php 
	}else{
		echo "<center>xin lỗi bạn không được phép truy cập trang này nếu là quản trị viên vui lòng <a href='../login.php'>Đăng Nhập</a> lại";
	}
 ?>