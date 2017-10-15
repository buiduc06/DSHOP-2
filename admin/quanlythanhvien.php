<?php $checksesion=session_start(); ?><!-- gán hàm session bằng checksesion rồi vào header kiem tra neu bien này ton tai thi không bật sessionstart nữa -ducdeveloper -->
<?php if ($_SESSION['name']=='admin'){//check neu sesion name bâng admin thi cho vao
?>

<!-- lay du lieu ra -->
<?php 
$stt='1';
	require_once 'dbconnect.php';
	$conn=getconnection();
	$query="SELECT * FROM users";
	$stmt=$conn->prepare($query);
	$stmt->execute();
	$result=$stmt->fetchall();
 ?>


<!-- xoa thanh vien -->
<?php require('header.php'); ?>
		<div class="content">
		<div class="chuyenmuc">
		<form action="xoathanhvien.php?id=<?= $value['users_id'] ?>" method="POST" accept-charset="utf-8">
			

		<p>QUẢN LÝ THÀNH VIÊN</p>
		<table>
			<thead>
		
				<tr>
					<th>STT</th>
					<th style="width: 60%">Account</th>
					<th>Level</th>
					<th>Delete</th>
				</tr>
			</thead>
			<?php foreach ($result as $value) {
?>

			<!-- phan convert level -->
				 <?php if($value['level']==1) {
					$level='Admin';
				}else if ($value['level']==2) {
					$level='Member';
				}else{
					$value['level']='?';
					} ?> 
			<tbody>
				<tr>
					<td><?php echo $stt++; ?></td>
					<td><?= $value['username'] ?></td>
					<td><?php echo "$level"; ?></td>
					<td><a href="xoathanhvien.php?id=<?= $value['users_id'] ?>" name="delete" onclick="return confirm_delete()">Delete</a></td>
				</tr>	
			</tbody>
			<?php }  ?>
		</table>
		</form>
</div>
		</div>
		
<?php require('footer.php'); ?>

<?php 
	}else{
		echo "<center>xin lỗi bạn không được phép truy cập trang này nếu là quản trị viên vui lòng <a href='../login.php'>Đăng Nhập</a> lại";
	}
 ?>