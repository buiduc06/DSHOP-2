<?php 
	$stt=1;
	$id=$_GET['id'];
	require_once 'admin/dbconnect.php';
	$conn=getconnection();
	$query="SELECT * FROM products WHERE products_id=$id";
	$stmt=$conn->prepare($query);
	$stmt->execute();
	$result=$stmt->fetchall();
		
 ?>
<?php require('templates/header.php') ?>
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
							<!-- phan nut -->

							<td><center>
							
							<button type="button" id="plus" onclick="cong()">+</button>
							<input type="text" name="" value="1" id="textbox">
							<button type="button" id="substract" onclick="tru()">-</button>
							</center>
							</td>
							<!-- het phan nut -->
							<td><p style="text-align: center;"><?= $value['price'] ?> VND<p></td>
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