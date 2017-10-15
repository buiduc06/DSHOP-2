<?php $checksesion=session_start(); ?><!-- gán hàm session bằng checksesion rồi vào header kiem tra neu bien này ton tai thi không bật sessionstart nữa -ducdeveloper -->
<?php if ($_SESSION['name']=='admin'){//check neu sesion name bâng admin thi cho vao
?>


<?php 
$stt='1'; 
// mở kết nối tới cơ sở dữ liệu 
	require_once "dbconnect.php";
	$conn=getconnection();
	//câu lệnh select lấy dữ liệu giữa 3 bảng - ducdeveloper
	$query="SELECT * FROM products INNER JOIN categories ON products.cate_id = categories.cate_id
									INNER JOIN users ON products.namepost=users.users_id ORDER BY products.products_id ASC";
	$stmt=$conn->prepare($query);
	$stmt->execute();
	$result=$stmt->fetchall();

 ?>
<!-- thuật toán phân trang -->

<?php require_once 'header.php'; ?> 

	<!-- phan mac dinh khong duoc sua  //ducdeveloper -->
		<div class="content">
		<div class="chuyenmuc">
		<p>QUẢN LÝ SẢN PHẨM</p>
		<form action="suasanpham.php" method="POST">
		<table>
			<thead>
			<tr class="table-chuyenmuc-top">
				<td colspan="4"></td>			
				<td colspan="3"><a href="themsanpham.php">Thêm Sản Phẩm</a></td>
			</tr>
				<tr>
					<th style="width: 4%;">STT</th>
					<th style="width: 22%;">Hình ảnh</th>
					<th style="width: 32%;">Tên Sản Phẩm</th>
					<th style="width: 15%;">DANH MỤC</th>
					<th style="width: 15%;">Giá</th>
					<th style="width: 12%;">Người Đăng</th>
					<th style="width: 7%;">Edit/Delete</th>
					
				</tr>
			</thead>
<!--  //ducdeveloper -->
<?php foreach ($result as $key =>$value) { //form
	?>
			<tbody class="quanlysp">
				<tr>
					<td><?php echo $stt++; ?></td>
					<td><a href="#" title='<?= $value["product_name"] ?>'><img src="../<?= $value['image'] ?>" alt="Iphone 7s"></a></td>
					<td><?= $value["product_name"] ?></td>
					<td><?= $value["cate_name"] ?></td>
					<td><?= $value["price"].' VNĐ' ?></td>
					<td><?= $value['username'] ?></td> 
					<!-- lấy products id -->
					<td>
					<a href="suasanpham.php?id=<?= $value['products_id'] ?>" name="checkname"><p><img src="../images/icon.ico" width="50px" height="50px" alt=""></p></a>
					<a href="xoasanpham.php?id=<?= $value['products_id'] ?>" onclick="return confirm_delete()" ><p><img src="../images/delete-xxl.png" width="50px" height="50px" alt=""></p></a></td>
					
				</tr>
			</tbody>
			<?php }  ?>
		</table>
		</form>
</div>
		</div>

<?php require_once 'footer.php'; ?> 


<?php 
	}else{
		echo "<center>xin lỗi bạn không được phép truy cập trang này nếu là quản trị viên vui lòng <a href='../login.php'>Đăng Nhập</a> lại";
	}
 ?>

