<?php $checksesion=session_start(); ?><!-- gán hàm session bằng checksesion rồi vào header kiem tra neu bien này ton tai thi không bật sessionstart nữa -ducdeveloper -->
<?php if ($_SESSION['name']=='admin'){//check neu sesion name bâng admin thi cho vao
?>


<?php 
// <!-- phần kết nối và lấy dữ liệu cho vào form -->
	$id=$_GET['id']; //dùng hàm get lấy thứ tự ID
	require_once "dbconnect.php";//mở kết nối đến cơ sở dữ liệu
	$conn=getconnection();
	$query="SELECT * FROM products INNER JOIN categories ON products.cate_id = categories.cate_id WHERE products_id=$id"; //câu lệnh lấy dữ liệu từ mysql
	$stmt=$conn->prepare($query);
	$stmt->execute();
	$result=$stmt->fetchall();

 ?>
  <?php 
 	require_once "dbconnect.php";//mở kết nối đến cơ sở dữ liệu
	$conn=getconnection();
 	$query="SELECT * FROM categories ";
 	$stmt=$conn->prepare($query);
	$stmt->execute();
	$result2=$stmt->fetchall();
  ?>

<!-- phần lấy dữ liệu cho vào phần danh lựa chọn danh mục -->
 

<?php require_once 'header.php'; ?> 

	<!-- phan mac dinh khong duoc sua  //ducdeveloper -->
		<div class="content">
		<center>
		<div class="chuyenmuc2">
		<p>SỬA SẢN PHẨM</p>
		<form action="suasanpham_create.php?id=<?php echo $_GET['id'] ?>" method="POST" enctype="multipart/form-data" >
		<table>

<!--  //ducdeveloper -->
<?php foreach ($result as $key =>$value) {
	?>
		
			<tr>
				<td>Tên Sản Phẩm</td>
				<td><input type="text" name="edit_name" value="<?= $value['product_name'] ?>" required></td>
			</tr>

			<tr>
				<td>giá</td>
				<td><input type="text" name="edit_price" value="<?= $value['price'] ?>" required></td>
			</tr>

			<tr>
				<td>Hình ảnh</td>
				<td><input type="file" name="avatar"></td>
			</tr>
			<tr>
				<td>Nội Dung</td>
				<td><textarea name="edit_info"  required><?= $value['detail_info'] ?></textarea>  
			</tr>
	<?php }  ?> 
	<!-- đóng vòng lặp thứ nhất -->
	<!-- mở vòng lặp thứ 2 -->
				<tr>
				<td>Chuyên mục</td>
				<td><select name="categories" required>
					<?php foreach ($result2 as $key => $value) {
			 ?>
					<option value="<?= $value['cate_id'] ?>"><?= $value['cate_name'] ?></option>
					<?php } ?>
				</select>
				</td>
			</tr>
			<tr>
				<td></td>
				<td><button type="submit" value="check"> update</button></td>
			</tr>
			
		</table>
		</form>
		<form action=""></form>
</div>
		</div>

<?php require_once 'footer.php'; ?> 



<?php 
	}else{
		echo "<center>xin lỗi bạn không được phép truy cập trang này nếu là quản trị viên vui lòng <a href='../login.php'>Đăng Nhập</a> lại";
	}
 ?>