<?php 
$usename=$_SESSION['name'];
require_once '../admin/dbconnect.php';
$conn=getconnection();
$query=" SELECT * FROM users WHERE username='$usename'";
$stmt=$conn->prepare($query);
$stmt->execute();
$result=$stmt->fetchall();
 ?>
<div class="aside">
		<div class="aside-avatar">
		<!-- mở vòng lặp và lấy ra hình ảnh -->
		<?php foreach ($result as $value) {
		?>
		
		<?php if ($value['avatar']!=null) {
				$value['avatar'];
			}else{
				$value['avatar']='images/No_image.jpg';
				} ?>
				<!-- hiển thị avartar thong qua sesion avatar đã dc gán khi login -->
			<img src="../<?= $value['avatar']; ?>" > 

			<!-- mở câu điều kiện nếu ko tồn tại nam thì lấy username thay thế -->
			<p><?php if ($value['name']!=null) {
				echo $value['name'];
			}else{
				echo $usename;
				} ?></p>
<?php } ?>
		</div>
		<div class="aside-info">
			<p><a href="index.php" >Thông Tin Cá Nhân</a></p>
			<p><a href="edit-info.php" >Cập Nhật Thông Tin</a></p>
			<p><a href="../changepassword.php" >Thay Đổi Mật Khẩu</a></p>
			<p><a href="../index.php" >Trang Chủ</a></p>
			<p><a href="../logout.php" >Đăng Xuất</a></p>
		</div>
		<div class="aside-menu">
			<b>SẢN PHẨM</b>
			<p><a href="danhsachspcuathanhvien.php" >Quản Lý Sản Phẩm</a></p>
			<p><a href="themsanpham.php" >+ Thêm Sản Phẩm</a></p>
		</div>
	</div>