<?php require_once 'templates/header.php'; ?>
<!-- phan lay ra danh sach san pham cau danh muc do -->
<?php 
$id=$_GET['id'];
if (isset($id)) {
require_once 'admin/dbconnect.php';
$conn=getconnection();
$query=" SELECT * FROM products WHERE cate_id=:id";
$stmt=$conn->prepare($query);
$stmt->bindvalue(':id',$id);
$stmt->execute();
$result=$stmt->fetchall();
}

if (isset($id)) {
require_once 'admin/dbconnect.php';
$conn=getconnection();
$query=" SELECT * FROM categories WHERE cate_id=:id";
$stmt=$conn->prepare($query);
$stmt->bindvalue(':id',$id);
$stmt->execute();
$result2=$stmt->fetchall();
}
 ?>
	<div class="container">
		<div class="content-top">
		<!-- phần slide show -->
			<div class="content-top-slide">
  		<div class="slider">
      <div>
<?php foreach ($result2 as $key => $value) {
			 ?>
        <img src="<?php 
        if ($value['images']==NULL) {// lay ra anh tuong ung voi thu muc
        	
        	echo 'images/index1.jpg';
        }else{
        	echo $value['images'];
        	} ?>" id="slideranh" />
      </div>
      
      </div>
			</div>
			</div>
			<!-- phan in ra ten tuong ung cua chuyen muc -->
			<div class="content-top-menu"><p><?= $value['cate_name'] ?> HOT</p><a href="#"><?= $value['cate_name'] ?> CŨ</a></div> 
			<?php } ?>
		</div>
<div class="content-categories">
			<div class="content-categories-full">
				<div class="content-categories-full-title" style="display: none;"></div>

				<!-- phần check xem có sản phẩm ở danh mục đó ko nếu có thì in ra các sản phẩm đó .. nếu ko có thì in ra thông báo danh mục trống -->
				<?php 
				foreach ($result as $value) {
					$checkkk=$value['image'];
				}

				if (isset($checkkk)!=TRUE) {
					echo "<center style='font-size:25px;padding:50px 0 50px 0;font-family:arial;'>Xin Lỗi Danh Mục " . '<b>' .$value['cate_name']. '</b>' ." Hiện Tại Trống</center>";
				}else{
					
					 ?>
				<div class="content-categories-full-show">
			
					<ul>
							<?php foreach ($result as $key => $value) {	
				?>
							<li>
							<!-- phần thông tin khuyến mại -->
								<?php require('templates/khuyenmai.php'); ?>
								<!-- phần hiển thị chính -->
							<?php require('templates/hienthisanpham.php'); ?>

								</li>
						<?php }  ?>
					</ul>
					
				</div>
				<?php } ?>
			</div>
</div>

<?php require_once 'templates/footer.php'; ?>