<?php session_start();
	session_destroy(); 
	ob_start();
	?>
<!-- gọi hàm header -->
<?php 
// phần hiển thị ra thông báo nếu đổi pass thành công
if (isset($_GET['changepasswordok'])) {
	echo "<script>alert('Đổi Mật Khẩu Thành Công Mời Bạn Đăng Nhập Lại')</script>";
}
$notification=array();
if (isset($_GET['id'])) { 
	$notification['success']='<script>
    alert("register success.please Login");
</script>';
}else{
	$notification['success']=NULL;
	} ?>
<?php require_once 'templates/header.php'; ?>
<div class="container">
		<div class="content-top">
			

<form action="login.php" method="POST" >
<center style="color: red; padding-top: 20px;"><?php echo $notification['success']; ?></center>
<h4> ĐĂNG NHẬP</h4>
<table id="login">
<tr>
	<td>usename</td>
	<td><input type="text" name="txtname"></td>
</tr>
<tr>
	<td>password</td>
	<td><input type="password" name="txtpass"></td>
</tr>
<tr>
	<td></td>
	<td><button type="submit" name="check">LOGIN</button></td>
</tr>
<tr>
<td></td>
<td><p> Chưa Có Tài Khoản? <a href="register.php" title="">Đăng Kí</a></p></td>
</tr>
</table>
</form>
<br>
<center>
				<!-- code check login php -->
<?php 
$notification=array();

if (isset($_POST['check'])) {
require_once 'admin/dbconnect.php';
$conn=getconnection();
$query="select * from users";
$stmt=$conn->prepare($query);
$stmt->execute();
$result70 = $stmt->fetchAll();


if (empty($_POST['txtname'])) {
	$notification['error']="xin vui lòng nhập username";
}else{
	$use=$_POST['txtname'];

}
if (empty($_POST['txtpass'])) {
	$notification['error1']="xin vui lòng nhập Mật Khẩu";
}else{
	$pasw=md5($_POST['txtpass']);

}
//phân xac minh thanh vien va admin check pass trong sql
	foreach ($result70 as $item){
if (isset($use) && isset($pasw)){
	if ($use==$item['username'] && $pasw==$item['password']) {
		if ($item['level']=='1') { //nếu use va pass bang dong 1 và level bang 1 thi xac nhan la admin va gan bien sesionname
		$_SESSION['name'] = $item['username'];//gan session bang usename
		$_SESSION['fullname'] = $item['name'];
		$_SESSION['avatar'] = $item['avatar'];
		$_SESSION['users_id'] = $item['users_id'];
		ob_clean();
		header('location: admin/index.php');
		exit();
		}else {//neu level bang 2 thi xac nhan la thanh vien va gan bien sesion bang usename
		$_SESSION['name'] = $item['username'];//gan session bang usename
		$_SESSION['fullname'] = $item['name'];
		$_SESSION['users_id'] = $item['users_id'];
		$_SESSION['avatar'] = $item['avatar'];
		ob_clean();
		header('location: nguoidung/index.php');
	}
}
else{
		$notification['error']=" tài Khoản Hoặc Mật Khẩu Không Chính Xác nếu chưa có tài khoản vui lòng <a href='singup.php' style='color:green;'>Đăng Kí</a>" . '<br>';

		// neu check trong csdl khong co use va pass thi in ra thong bao khong co use name va quay tro lại trang chu
	}
}
}
}
$notification['error']=NULL;
$notification['error1']=NULL;
	echo $notification['error'].'</br>';
	echo $notification['error1'].'</br>';
	 
?>

</center>

<!-- ket thuc code php -->
</div>
</div>
<?php require_once 'templates/footer.php'; ?>
