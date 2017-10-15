<?php require_once 'header.php'; ?>
<?php if ($_SESSION['name']){//check neu sesion name bâng admin thi cho vao
?>
 <?php 
 	$id=$_GET['id'];
 	require_once '../admin/dbconnect.php';
 	$conn=getconnection();
 	$query=" SELECT * FROM products INNER JOIN categories ON products.cate_id=categories.cate_id WHERE products_id=$id";
 	$stmt=$conn->prepare($query);
 	$stmt->execute();
 	$result=$stmt->fetchall();
 ?>

  <?php 
 	require_once '../admin/dbconnect.php';
 	$conn=getconnection();
 	$query=" SELECT * FROM categories";
 	$stmt=$conn->prepare($query);
 	$stmt->execute();
 	$result2=$stmt->fetchall();
 ?>
<div class="content">
<form action="suasanpham_config.php?id=<?php echo $_GET['id'] ?>" method="POST" enctype="multipart/form-data">
 <div class="content-col2">
 <?php foreach ($result as $value) {
 ?>
<table id="nguoidungsua">
		<tr>
			<td>Tên sản phẩm</td>
			<td><input type="text" name="txtname" value="<?= $value['product_name'] ?>" required></td>
		</tr>

		<tr>
			<td>giá</td>
			<td><input type="text" name="txtprice" value="<?= $value['price'] ?>" required></td>
		</tr>
		<tr>
			<td>image</td>
			<td><input type="file" name="avatar"  required></td>
		</tr>
		<tr>
			<td>Noi Dung</td>
			<td><textarea name="detail_info" required><?= $value['detail_info'] ?></textarea></td>
		</tr>
		<tr>
			<td>Danh Muc</td>
			<td><select name="danhmuc" >
			<option value="<?= $value['cate_id'] ?>"><?= $value['cate_name'] ?></option>
						<?php foreach ($result2 as $value) {
			?>
				<option value="<?= $value['cate_id'] ?>"><?= $value['cate_name'] ?></option>
							<?php } ?>
			</select></td>
		</tr>
		<tr>
			<td></td>
			<td><input type="submit" name="check" value="update"></td>
		</tr>
</table>
<?php } ?>
</form>
</div>
</div>
	<?php require_once 'aside.php'; ?>
</div>
<?php require_once 'footer.php'; ?>
<?php 
	}else{
		echo "<center><img src='../images/knight.png'><p style='color:green;font-size:40px;margin-left:20px;'>Security</p></center>";
		echo "<center>Bạn Phải Đăng Nhập Mới Được Vào Trang Này <a href='../login.php'>Đăng Nhập</a> hoặc trở về <a href='../index.php'>TrangChủ</a>";
	}
 ?>