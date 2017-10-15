<?php require_once 'header.php'; ?>
<?php if ($_SESSION['name']){//check neu sesion name bâng admin thi cho vao
?>
 <!-- phan lay ra hinh anh -->
<?php 
$usename=$_SESSION['name'];
require_once '../admin/dbconnect.php';
$conn=getconnection();
$query=" SELECT * FROM users WHERE username='$usename'";
$stmt=$conn->prepare($query);
$stmt->execute();
$result3=$stmt->fetchall(); ?>

<!-- phần đếm số sản phẩm của người dùng -->
<?php 
$demsospcuanguoidung=array();
$users_id=$_SESSION['users_id'];
require_once '../admin/dbconnect.php';
$conn=getconnection();
$query=" SELECT * FROM products WHERE namepost=$users_id";
$stmt=$conn->prepare($query);
$stmt->execute();
$demphantu=$stmt->fetchall(); 
foreach ($demphantu as $key => $value) {
	$demsospcuanguoidung[]=$value['namepost'];// đưa tất cả các id sản phầm mà do người dùng này vào 1 mảng 
}
$demsospcuanguoidung2=count($demsospcuanguoidung);// dùng hàm đếm xem trong mảng có bao nhiêu phần tử và xuát ra
?>

 <!-- phần form -->
<div class="content">
<h4>Thông Tin Cá Nhân</h4>
<form action="edit-info.php" method="POST" accept-charset="utf-8" enctype="multipart/form-data" >
	<?php foreach ($result3 as $value) {

	 ?>
<div class="content-col1">

	<div class="content-col1-images">
<!-- nếu ko tồn tại ảnh thì gán ảnh bằng ảnh no_image.jpg -->
	 <?php if ($value['avatar']!=null) {
				$value['avatar'];
			}else{
				$value['avatar']='images/No_image.jpg';
				} ?>

		<img src="../<?= $value['avatar'] ?>" alt="">
	</div>

</div>
<div class="content-col2">
<div class="thongtincanhan">
	<table>
			<tr>
				<td><b>Họ Tên</b></td>
				<td><?= $value['name']; ?></td>
			</tr>
			<tr>
				<td><b>Giới Tính</b></td>
				<!-- phần convert giưới tính -->
				<td><?php if ($value['gender']==1) {
					$value['gender']='Nam';
				}else{
					$value['gender']='Nữ';
					} ?>
						<?= $value['gender'] ?>
					</td>
			</tr>
			<tr>
				<td><b>Email</b></td>
				<td><?= $value['email'] ?></td>
			</tr>
			<tr>
				<td><b>Cấp Độ</b></td>
				<td><?php if ($value['level']==1) {
					echo "<b>Quản Trị Viên</b>";
				}else{
					echo "<b>Thành Viên</b>";
					} ?></td>
			</tr>
			<tr>
				<td><b>Số Sản Phẩm</b></td>
				<td><?php echo "$demsospcuanguoidung2"; ?></td>
			</tr>
	</table>
	<br>
	<br>

	<a href="edit-info.php">Cập Nhật Thông Tin Cá Nhân</a><br><br>
	<a href="../changepassword.php">Cập Nhật Mật Khẩu</a><br><br>
	<a href="edit-email.php">Cập Nhật EMAIL</a><br><br>
	<a href="themsanpham.php">Đăng Sản Phẩm</a>
</div>
</div>
 <?php } ?>
</form>
</div>

	<?php require_once 'aside.php'; ?>
<?php require_once 'footer.php'; ?>
<?php 
	}else{
		echo "<center>xin lỗi bạn không được phép truy cập trang này nếu là quản trị viên vui lòng <a href='../login.php'>Đăng Nhập</a> lại";
	}
 ?>
<!-- phần in ra thông báo nếu cập nhật thông tin thành công -->
 <?php if (isset($_GET['updateinfo'])) {
	echo "<script>alert('cập nhật thông tin cá nhân thành công')</script>";
} ?>