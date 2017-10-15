<?php $checksesion=session_start(); ?><!-- gán hàm session bằng checksesion rồi vào header kiem tra neu bien này ton tai thi không bật sessionstart nữa -ducdeveloper -->
<?php if ($_SESSION['name']=='admin'){//check neu sesion name bâng admin thi cho vao
?>

<?php 
	require('dbconnect.php');
	$conn=getconnection();
	$query="SELECT * FROM categories";
	$stmt=$conn->prepare($query);
	$stmt->execute();
	$result=$stmt->fetchall();
 ?>

<?php require('header.php'); ?>
		<div class="content">
		<div class="chuyenmuc">
		<p>QUẢN LÝ CHUYÊN MỤC</p>
		<table>
			<thead>
			<tr class="table-chuyenmuc-top">
				<td colspan="3"></td>			
				<td colspan="3"><a href="themchuyenmuc.php">Thêm Chuyên Mục</a></td>
			</tr>
				<tr>
					<th>TT Chuyên mục</th>
					<th style="width: 60%">Chuyên Mục</th>
					<th>Hinh Anh</th>					 				 
					<th>Edit</th>
					<th>Delete</th>
				</tr>
			</thead>
			<?php foreach ($result as $key => $value) {
?>
			<tbody>
				<tr>
					<td><?= $value['cate_id'] ?></td>
					<td><?= $value['cate_name'] ?></td>
					<!-- phần đường dẫn ảnh và đường dãn tới thư mục -->
					<td><a href="../chitietdanhmuc.php?id=<?= $value['cate_id'] ?>" title="Truy Cap danh muc ngay"><img src="../<?= $value['images'] ?>" width="200px;" height="50px;" ></a></td>
					<td><a href="suachuyenmuc.php?id=<?= $value['cate_id'] ?>" >Edit</a></td>
					<td><a href="xoachuyenmuc.php?id=<?= $value['cate_id'] ?>" onclick="return confirm_delete()" >Delete</a></td>
				</tr>
			</tbody>
			<?php }  ?>
		</table>
</div>
		</div>

		

<?php require('footer.php'); ?>


<?php 
	}else{
		echo "<center>xin lỗi bạn không được phép truy cập trang này nếu là quản trị viên vui lòng <a href='../login.php'>Đăng Nhập</a> lại";
	}
 ?>