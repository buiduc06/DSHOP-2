<?php session_start(); ?>
<!-- phần xuất chuyên mục ra menu -->
	<?php 
	require_once 'admin/dbconnect.php';
	$conn=getconnection();
	$query="SELECT * FROM categories";
	$stmt=$conn->prepare($query);
	$stmt->execute();
	$result20=$stmt->fetchall();
	?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Trang Chủ</title>
	<link rel="stylesheet" href="templates/main.css" type="text/css">
	<!-- thư viện javascript có sẵn  -->
	<link rel="stylesheet" type="text/css" href="templates/js/slider/themes/carbono/jquery.slider.css" />
	<script type="text/javascript" src="templates/js/jquery.min.js"></script>
  <script type="text/javascript" src="templates/js/slider/jquery.slider.min.js"></script>

  <script type="text/javascript">
    jQuery(document).ready(function($) {
      $(".slider").slideshow({
        width      : 1210,
        height     : 315,
        transition : ['slideLeft', 'slideRight', 'slideTop', 'slideBottom','explode','squareRandom']
        
      });
    });
    </script>
  	<!-- hết phần javascript có sẵn -->
  	<script src="js/js.js" type="text/javascript" charset="utf-8" async defer></script>
</head>
<body>
<div class="header">
	<div class="header-top">
		<ul>
<a href=""></a>
			<?php 
			if (isset($_SESSION['name'])) {
			if ($_SESSION['name']=='admin') {
				echo "Xin Chào ".'<b>'.$_SESSION['name'].'</b>'.'  '.' | '.'<a href="admin/index.php" style="color:blue;">Quản Trị web</a>'.' | '.'<a href="changepassword.php" style="color:blue;margin-left:5px;">Đổi Mật Khẩu</a>'.' | '.'<a href="logout.php" style="color:blue;">Đăng Xuất</a>';
						
			}else{
				// nếu tồn tại session fullname thì echo ra fullname nếu ko tồn tại thì gán bằng session usename
				if ($_SESSION['fullname']!=NULL) {
					$_SESSION['fullname'];
				}else{
					$_SESSION['fullname']=$_SESSION['name'];
				}
				// xuất ra thông báo 
				echo "Xin Chào ".'<b>'.$_SESSION['fullname'].'</b>'.' | '.'<a href="nguoidung/index.php" style="color:blue">Đăng Tin</a>'.' | '.'<a href="logout.php" style="color:blue;"> Đăng Xuất </a>' . '|' . '<a href="changepassword.php" style="color:blue;margin-left:10px;">Đổi Mật Khẩu</a>';
			}
		}
			else{
			echo '<li><a href="./register.php">Đăng Kí</a></li>
			      <li><a href="login.php">Đăng Nhập</a></li>
				<li><a href="#">Hệ Thống Cửa Hàng</a></li>
				<li><a href="#" style="border: none;">About</a></li>
			      ';
			}
			 ?>
		</ul>
		<img src="" alt="">
	</div>
	<div class="header-menu">
		 <ul>
			<a href="index.php"><img src="images/logo-ishop.png" alt="logo" id="menu-logo"></a>
			<?php foreach ($result20 as $value) { 
			$subbb=$value['cate_id'];// foreach lay danh sach danh muc ra mennu chính
			 ?>
			<li><p><a href="chitietdanhmuc.php?id=<?= $value['cate_id'] ?>"><?= $value['cate_name'] ?></a></p>	

			
				 <ul class="sub-menu">

				<?php 
if ($subbb!=NULL) {
	require_once 'admin/dbconnect.php';
	$conn=getconnection();
	$query="SELECT * FROM sub_categories WHERE sub_cate_id=$subbb";
	$stmt=$conn->prepare($query);
	$stmt->execute();
	$result21=$stmt->fetchall();// lấy danh sách menu con của menu chính ra với điều kiện menu con đó phải là menu con của menu chính :v
	foreach ($result21 as $value) { 
					echo '<li>'.'<a href='.'comingsoon.php?id='.$value['sub_id'].'>'.$value['sub_name'] .'</a></li>';
					}
}else{
	echo "";
}	
			 ?>
			 	</ul>
							<?php } ?>

			</li>
			<input type="seach" name="seach" placeholder="Tên Máy,Hãng Sản Xuất.......">

		</ul>
			
	</div>
</div>
