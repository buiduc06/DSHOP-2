<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>
	<link rel="stylesheet" href="main.css" type="text/css">
	<script type="text/javascript">
	//doan script yeu cau xac minh khi delete - ducdeveloper
		function confirm_delete() {
		if (confirm("bạn có chắc chắn muốn xóa?")) {
				return true;
		} else {
				return false;
		}
}
	</script>
</head>
<body>
	<header>
		<div class="header-top">
			<h3>wellcome back admin !(<a href="../logout.php" title="">Logout</a> ,<a href="../index.php" title="">home</a>)</h3>
		</div>
		<div class="header-menu">
			<ul>
				<li><a href="quanlychuyenmuc.php" title=""> Quản Lý Chuyên Mục</a></li>
				<li><a href="quanlysanpham.php" title=""> Quản Lý Sản Phẩm</a></li>
				<li><a href="quanlythanhvien.php" title=""> Quản Lý Thành Viên</a></li>
				<li><a href="../index.php" title="">Phần Đang Phát Triển</a></li>
				<li><a href="../index.php">Phần Đang Phát Triển</a></li>
			</ul>
		</div>
	</header><!-- /header -->
	<div class="container">