<?php 
	require_once 'admin/dbconnect.php';
	$conn=getconnection();
	$query="SELECT * FROM products WHERE cate_id=3";
	$stmt=$conn->prepare($query);
	$stmt->execute();
	$result=$stmt->fetchall();

 ?>
 <!-- truy vấn lấy ra máy tính  -->
<?php 
	require_once 'admin/dbconnect.php';
	$conn=getconnection();
	$query="SELECT * FROM products WHERE cate_id=1";
	$stmt=$conn->prepare($query);
	$stmt->execute();
	$maytinh=$stmt->fetchall();

 ?>
 <?php 
	require_once 'admin/dbconnect.php';
	$conn=getconnection();
	$query="SELECT * FROM products WHERE cate_id=4";
	$stmt=$conn->prepare($query);
	$stmt->execute();
	$table=$stmt->fetchall();

 ?>
  <?php 
	require_once 'admin/dbconnect.php';
	$conn=getconnection();
	$query="SELECT * FROM products WHERE cate_id=5";
	$stmt=$conn->prepare($query);
	$stmt->execute();
	$mac=$stmt->fetchall();

 ?>
<?php  require('templates/header.php'); ?>

		<div class="container">
		<div class="content-top">
		<!-- phần slide show -->
			<div class="content-top-slide">
  		<div class="slider">
      <div>

        <img src="images/index1.jpg" id="slideranh" alt=""/>
      </div>
      
      <div>
        <img src="images/index2.png" id="slideranh" alt=""/>
      </div>
      
      <div>
        <img src="images/index3.jpg" id="slideranh" alt=""/>
      </div>
      
      <div>

        <img src="images/index4.jpg" id="slideranh" alt=""/>
      </div>
			</div>
			</div>
			<div class="content-top-menu"><p>ĐIỆN THOẠI HOT</p><a href="#">ĐIỆN THOẠI CŨ</a></div>
		</div>
		<div class="content-categories">
			<div class="content-categories-full">
				<div class="content-categories-full-title" style="display: none;"></div>
				<div class="content-categories-full-show">
			
					<ul>
						<!-- <li id="categories-hot">
							<img src="images/iphone6s.png" alt="">
							
							<a href="" title="">IPhone 6s Plus - 64G - Gold/Rose ( CPO )</a>
							<p>13.290.000 đ</p>
							<button type="button">Mua Hàng</button>
						
						</li> -->
							<?php foreach ($result as $key => $value) {
				?>
							<li>
							<!-- phần thông tin khuyến mại -->
							<div class="categories-show2">
						<b>✎ Tặng Miếng dán cường lực cao cấp Trị giá 150k</b>
						<b>✎ Tặng ốp lưng cao cấp 150k</b>
						<b>✎ Tặng Miếng dán cường lực cao cấp 150k</b>
						<b>✎ Tặng Miếng dán cường lực cao cấp 150k</b>
					<div class="categories-price"><p><?= $value['price'].' đ' ?></p></div>
								<div class="categories-button">
									<tr><td>
									<!-- <?php if (isset($_POST['okk'])) {
									
											 }?> -->
									<a href="index2.php?id=<?= $value['products_id'];
									 
									 ?>" title="Thêm Vào Giỏ Hàng" name="okk"><img src="images/cart-icon.svg" alt="Thêm Vào Giỏ Hàng" ></a>

									<button type="button" name="themhang"><a href="giohang2.php?id=<?= $value['products_id'] ?>" title="Mua Sản Phẩm Ngay">MUA</a></button></td></tr>
								</div>

							<!-- phần hiển thị chính -->
							</div>
							<div class="categories-img">
								<a href="#" title="<?= $value['product_name'] ?>"><img src="<?= $value['image'] ?>" alt="<?= $value['product_name'] ?>"></a>
								</div>
								<div class="categories-title-smail"><p><?= $value['product_name'] ?></p></div>
								<div class="categories-price"><p><?= $value['price'].' đ' ?></p></div>
								<div class="categories-button">
									<tr><td>
									<!-- <?php if (isset($_POST['okk'])) {
									
											 }?> -->
									<a href="index2.php?id=<?= $value['products_id'];
									 
									 ?>" title="Thêm Vào Giỏ Hàng" name="okk"><img src="images/cart-icon.svg" alt="Thêm Vào Giỏ Hàng" ></a>

									<button type="button" name="themhang"><a href="giohang2.php?id=<?= $value['products_id'] ?>" title="Mua Sản Phẩm Ngay">MUA</a></button></td></tr>
								</div>
								
								</li>

	
						<?php }  ?>
					</ul>
					
				</div>
			</div>
			
			<?php $bb=implode(',', $giohang3); ?>
		<div style="position: fixed;right: 0;top:0px;z-index:2000;width: 100px; height: 100px;background-color: red;"><a href="giohang2.php?idd=<?php echo $bb;
									 ?>" title="">giohang</a></div>
			<div class="content-categories-full">
				<div class="content-categories-full-title"><p>MACBOOK HOT</p><a href="#">MACBOOK CŨ</a></div>
				<div class="content-categories-full-show">
			<ul>
							<?php foreach ($maytinh as $key => $value) {   //vong lap
																			?>
							<li>
							<div class="categories-img">
								<a href="#" title="<?= $value['product_name'] ?>"><img src="<?= $value['image'] ?>" alt="<?= $value['product_name'] ?>"></a>
								</div>
								<div class="categories-title-smail"><p><?= $value['product_name'] ?></p></div>
								<div class="categories-price"><p><?= $value['price'].' đ' ?></p></div>
								<div class="categories-button">
									<tr><td>
									
									<a href="#" title="Thêm Vào Giỏ Hàng"><img src="images/cart-icon.svg" alt="Thêm Vào Giỏ Hàng"></a>
									<button type="button" name="themhang"><a href="giohang.php?id=<?= $value['products_id'] ?>" title="Mua Sản Phẩm Ngay">MUA</a></button></td></tr>
								</div>
								</li>
						<?php }  ?> 
						<!-- //ket thuc vong lap -->
					</ul>
				</div>
			</div>




			<div class="content-categories-full">
				<div class="content-categories-full-title"><p>TABLE HOT</p><a href="#">TABLE CŨ</a></div>
				<div class="content-categories-full-show">
			<ul>
							<?php foreach ($table as $key => $value) {   //vong lap
																			?>
							<li>
							<div class="categories-img">
								<a href="#" title="<?= $value['product_name'] ?>"><img src="<?= $value['image'] ?>" alt="<?= $value['product_name'] ?>"></a>
								</div>
								<div class="categories-title-smail"><p><?= $value['product_name'] ?></p></div>
								<div class="categories-price"><p><?= $value['price'].' đ' ?></p></div>
								<div class="categories-button">
									<tr><td>
									
									<a href="#" title="Thêm Vào Giỏ Hàng"><img src="images/cart-icon.svg" alt="Thêm Vào Giỏ Hàng"></a>
									<button type="button" name="themhang"><a href="giohang.php?id=<?= $value['products_id'] ?>" title="Mua Sản Phẩm Ngay">MUA</a></button></td></tr>
								</div>
								</li>
						<?php }  ?> 
						<!-- //ket thuc vong lap -->
					</ul>
				</div>
			</div>


			<div class="content-categories-full">
				<div class="content-categories-full-title"><p>MÁY TÍNH HOT</p><a href="#">MÁY TÍNH CŨ</a></div>
				<div class="content-categories-full-show">
			<ul>
							<?php foreach ($mac as $key => $value) {   //vong lap
																			?>
							<li>
							<div class="categories-img">
								<a href="#" title="<?= $value['product_name'] ?>"><img src="<?= $value['image'] ?>" alt="<?= $value['product_name'] ?>"></a>
								</div>
								<div class="categories-title-smail"><p><?= $value['product_name'] ?></p></div>
								<div class="categories-price"><p><?= $value['price'].' đ' ?></p></div>
								<div class="categories-button">
									<tr><td>
									
									<a href="#" title="Thêm Vào Giỏ Hàng"><img src="images/cart-icon.svg" alt="Thêm Vào Giỏ Hàng"></a>
									<button type="button" name="themhang"><a href="giohang.php?id=<?= $value['products_id'] ?>" title="Mua Sản Phẩm Ngay">MUA</a></button></td></tr>
								</div>
								</li>
						<?php }  ?> 
						<!-- //ket thuc vong lap -->
					</ul>
				</div>
			</div>



		</div>
</div>

</div>
<div class="footer-slide">
		<div class="content-bottom-menu">
		<p>Tin Mới Nhất</p>
		<a href="#">Tư Vấn Chọn Mua</a>
		<a href="#">Tin Tức Công Nghệ</a>
		<a href="#">Hướng Dẫn Kĩ Thuật</a>
		</div>
		<div class="footer-content-slide">
			<div class="footer-content-slide-col">
				<img src="images/iphone7.jpg" alt="">
				<b>iphone 8 sẽ được trang bị nhiều chức năng mới</b>
				<p>Có độ mới của máy được cho là cao hơn hàng "like new", những chiếc iPhone "near...</p>
			</div>

			<div class="footer-content-slide-col">
				<img src="images/iphone7.jpg" alt="">
				<b>iphone 8 sẽ được trang bị nhiều chức năng mới</b>
				<p>Có độ mới của máy được cho là cao hơn hàng "like new", những chiếc iPhone "near...</p>
			</div>

			<div class="footer-content-slide-col">
				<img src="images/iphone7.jpg" alt="">
				<b>iphone 8 sẽ được trang bị nhiều chức năng mới</b>
				<p>Có độ mới của máy được cho là cao hơn hàng "like new", những chiếc iPhone "near...</p>
			</div>
		</div>
		<div class="content-bottom2-menu">
		<p>VIDEO</p>
		</div>
		</div>
<?php require('templates/footer.php') ?>