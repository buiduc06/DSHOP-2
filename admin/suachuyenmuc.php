<?php $checksesion=session_start(); ?><!-- gán hàm session bằng checksesion rồi vào header kiem tra neu bien này ton tai thi không bật sessionstart nữa -ducdeveloper -->
<?php if ($_SESSION['name']=='admin'){//check neu sesion name bâng admin thi cho vao
?>

<?php
	$id=$_GET['id'];
	require('dbconnect.php');
	$conn=getconnection();
	$query="SELECT * FROM categories WHERE cate_id=$id";
	$stmt=$conn->prepare($query);
	$stmt->execute();
	$result=$stmt->fetchall();

 ?>

<?php require('header.php'); ?>
		<div class="content">
		<center>
		<div class="chuyenmuc2">
		<p>CHỈNH SỬA CHUYÊN MỤC</p>
		<form action="suachuyenmuc_create.php?id=<?php echo $_GET['id'] ?>" method="POST" enctype="multipart/form-data">
		<table>
			 
			<?php foreach ($result as $key => $value) {
?>
			
				<tr> 
				<td>Tên Chuyên Mục</td>
				<td><input type="text" name="edit_name" value="<?= $value['cate_name'] ?>" required></td>
				</tr>
				<tr>
					<td>Link Chuyên Mục</td>
					<td><input type="text" name="edit_link" value="<?= $value['cate_link'] ?>"></td>
				</tr>
				<tr>
					<td>Hinh Anh</td>
					<td><input type="file" name="avatar" ></td>
				</tr>
				<tr>
					<td></td>
					<td><button type="submit" name="check">update</button></td>
				</tr>

			<?php }  ?>

		</table>
			<!-- phần lấy ra thông báo nếu chuyên mục tồn tại -->
			<?php if (isset($notification['error'])) {
				echo $notification['error'];
			}else{
				echo " ";
				} ?>

					<?php if (isset($_GET['check'])) {
						if ($_GET['check']=='kt') {
							echo '<p style="color:red;font-size:16px">'."Tên Chuyên Mục Không Được Chứa Kí Tự".'</p>';
						}if($_GET['check']=='fl'){
							echo '<p style="color:red;font-size:16px">'."Tên Chuyên Mục Đã Tồn Tại".'</p>';
						}
				
			}else{
				echo " ";
				} ?>
		</form>
</div>
		</div>

		

<?php require('footer.php'); ?>

<?php 
	}else{
		echo "<center>xin lỗi bạn không được phép truy cập trang này nếu là quản trị viên vui lòng <a href='../login.php'>Đăng Nhập</a> lại";
	}
 ?>