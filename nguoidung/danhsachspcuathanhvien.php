<?php require_once 'header.php'; ?>
<?php if ($_SESSION['name']){//check neu sesion name bâng admin thi cho vao
?>
<?php 
$checksp=array();
$stt='1'; 
$users_id=$_SESSION['users_id'];
// mở kết nối tới cơ sở dữ liệu 
	require_once "../admin/dbconnect.php";
	$conn=getconnection();
	//câu lệnh select lấy dữ liệu giữa 2 bảng - ducdeveloper
	$query="SELECT * FROM products INNER JOIN categories ON products.cate_id = categories.cate_id WHERE namepost=$users_id";
	$stmt=$conn->prepare($query);
	$stmt->execute();
	$result=$stmt->fetchall();

 ?>



	<div class="content">
	<div class="chuyenmuc">
	<!-- check xem nguời dùng này có sản phẩm hay không nếu có thì in ra nếu ko thì đưa ra yêu cầu tạo sp -->
	<?php foreach ($result as $key =>$value) { //form
		$checksp[]=$value['namepost'];// gán vào mảng các name post id
	}?>
	<?php $checksp2=in_array($users_id,$checksp); // dùng hàm in_array() để tìm trong cột đó có sản phàm bvào là của người dùng này đăng hay ko
	if ($checksp2==TRUE) {?>

	<form action="index_submit" method="get" accept-charset="utf-8">
		<table class="quanlysp">
			<thead >
			<tr class="table-chuyenmuc-top">
			<!-- 	<td colspan="4"></td>			
				<td colspan="3"><a href="themsanpham.php">Thêm Sản Phẩm</a></td> -->
			</tr>
			<tr style="position: fixed;">
					<th style="width: 4%;">STT</th>
					<th style="width: 22%;">hình ảnh</th>
					<th style="width: 304px;">Tên Sản Phẩm</th>
					<th style="width: 15%;">Danh Mục</th>
					<th style="width: 15%;">Giá</th>
					<th style="width: 6%;">Edit</th>
					<th style="width: 7%;">Delete</th>
					
				</tr>
				<tr>
					<th style="width: 4%;">STT</th>
					<th style="width: 22%;">hình ảnh</th>
					<th style="width: 32%;">Tên Sản Phẩm</th>
					<th style="width: 15%;">DANH MỤC</th>
					<th style="width: 15%;">price</th>
					<th style="width: 6%;">Edit</th>
					<th style="width: 7%;">Delete</th>
					
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
					<td><a href="suasanpham.php?id=<?= $value['products_id'] ?>" name="checkname">Edit</a></td> 
					<!-- lấy products id -->
					<td><a href="xoasanpham.php?id=<?= $value['products_id'] ?>" onclick="return confirm_delete()" >Delete</a></td>
					
				</tr>
			</tbody>
			<?php }  ?>
		</table>
	</form>
	<?php }else{
		echo "<center style='color:green;font-size:20px;margin-top:250px'>Bạn Hiện Không Có Sản Phẩm Nào Xin Hãy "."<a href='themsanpham.php'>Tạo Sản Phẩm Mới</a>"."</center>";
		} ?>
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