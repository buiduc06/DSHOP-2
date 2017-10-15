	<div class="categories-img">
								<a href="#" title="<?= $value['product_name'] ?>"><img src="<?= $value['image'] ?>" alt="<?= $value['product_name'] ?>"></a>
								</div>
								<div class="categories-title-smail"><p><?= $value['product_name'] ?></p></div>
								<div class="categories-price"><p><?= $value['price'].' đ' ?></p></div>
								<div class="categories-button">
									<tr><td>
									<!-- <?php if (isset($_POST['okk'])) {
									
											 }?> -->
									<a href="index.php?id=<?= $value['products_id'] ?>" title="Thêm Vào Giỏ Hàng" name="okk"><img src="images/cart-icon.svg" alt="Thêm Vào Giỏ Hàng" ></a>
									<button type="button" name="themhang"><a href="giohang.php?id=<?= $value['products_id'] ?>" title="Mua Sản Phẩm Ngay">MUA</a></button></td></tr>
								</div>