<?php require('templates/header.php') ?>
<?php 
	$stt=1;
	$soluong=2;
	$id=$_GET['id'];
	$_SESSION['cart']['$id']=$soluong;
		require_once 'admin/dbconnect.php';
		$conn=getconnection();
	foreach ($_SESSION['cart'] as $id => $soluong) {
		echo $_SESSION['cart']['$id'];
		die;
	$query="SELECT * FROM products WHERE products_id=$idd";
	$stmt=$conn->prepare($query);
	$stmt->execute();
	$result=$stmt->fetchall();
}
		
 ?>
	<div class="container">
		<div class="content-top">
			<div class="content-top-slide">
				<form id="thanhtoan-giohang">
				<table>
					<thead>
						<tr>
							<th>STT</th>
							<th width="65%">Thông Tin Sản Phẩm</th>
							<th width="15%">Số Lượng</th>
							<th width="15%">Thành Tiền</th>
						</tr>
					</thead>
					<?php foreach ($result as $key =>$value) { //form
	?>
					<tbody>

						<tr>
							<td><?php echo $stt++; ?></td>
							<td>

								<div class="anhsp">
									<img src="<?= $value['image'] ?>" alt="">
								</div>
								<div class="infosp">
								<p><b>Tên Sản Phẩm: </b> <?= $value['product_name'] ?> </p>
								<p><b>Giá Bán: </b> <?= $value['price'] ?> đ	</p>
								<p><b>Tình Trạng: </b> <a>Còn Hàng (new) </a></p>
								<p><b>Nội Dung: </b> <br><?= $value['detail_info'] ?></p>
								
								</div>
							</td>
							<td><input type="text" name="soluongsp" value="1" id="soluongmua"></td>
							<td><?= $value['price'] ?></td>
							</tr>
					</tbody>
					<?php } ?>
				</table>
				<button type="button" id="subthanhtoan"><a href="login.php">Thanh Toán</a></button>
				</form>
			</div>
		</div>


</div>
<?php require('templates/footer.php') ?>