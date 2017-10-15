<?php 
$checkuse=array();//tạo mảng để check xem use và email đã tồn tại trong database chưa
$checkemail=array();
$notification=array();//tạo mảng in ra thông báo
$notification['erroruse']=NULL;
$notification['errorpws']=NULL;
$notification['errorrpws']=NULL;
$notification['erroremail']=NULL;
$notification['errorruse2']=NULL;
$notification['errorruse1']=NULL;
$notification['errorgd']=NULL;

// check xem người dùng đã nhập đúng các điều kiện chưa?
if (isset($_POST['check'])) {
	// usename
	if (empty($_POST['usename'])) {
		$notification['erroruse']='* xin vui lòng nhập tên tài khoản';
	}else{
		$usename=$_POST['usename'];
	}
	if (empty($_POST['password']) || empty($_POST['re-password'])) {
		$notification['errorpws']='* xin vui lòng nhập mật khẩu';
	}else{
		if ($_POST['password']!=$_POST['re-password']) {
		$notification['errorrpws']='* 2 mật khẩu phải trùng nhau';
	}
	else{
		if (strlen($_POST['password'])>=7) {
		$password=$_POST['password'];
	}else{
	$notification['errorpws']='* Mật Khẩu Phải < 7 kí tự';
	}
}
}
	if (empty($_POST['email'])) {
		$notification['erroremail']='* xin vui lòng nhập địa chỉ email';
	}else{
		$email=$_POST['email'];
	}
if (empty($_POST['gender'])) {
		$notification['errorgd']='* xin vui lòng chọn giới tính';
	}else{
		$gender=$_POST['gender'];
	}


// lấy dữ liệu và so sanh xem có tồn tại trong bảng hay không 
if (isset($usename) && isset($password) && isset($email) && isset($gender)) {
	require_once 'admin/dbconnect.php';
	$conn=getConnection();
	$query="SELECT username,email FROM users";
	$stmt=$conn->prepare($query);
	$stmt->execute();
	$kqq=$stmt->fetchall();
	foreach ($kqq as $value) {
	$checkuse[]=$value['username'];//tiến hành thêm dữ liệu vào mảng để check
	$checkemail[]=$value['email'];//tiến hành thêm dữ liệu vào mảng để check
}
	//dùng hàm in_array() kiểm tra trong mảng check use va checkemail xem đã tồn tại usename va email đó chưa nếu đã tồn tại thì in ra thông báo va gan cac gia tri de dua vao cau dk
	$aa=in_array($usename, $checkuse);
	$dd=in_array($email, $checkemail);

	if ($aa==TRUE) {
		$notification['errorruse1']='* Tên Tài Khoản Đã Tồn Tại';
	
	}else{
		$okuse=$value['username'];
	}
	if ($dd==TRUE) {
		$notification['errorruse2']='* Địa Chỉ Email Đã Tồn Tại';
		
	}else{
		$okemail=$value['email'];
	}
}

// nếu dữ liệu sạch thì tiến hành insert vào mysql
if (isset($usename) && isset($password) && isset($email) && isset($okuse) && isset($okemail) && isset($gender)) {
	require_once 'admin/dbconnect.php';
	$conn=getConnection();
	$query=" INSERT INTO users(username,password,email,level,gender)
			VALUES (:username, :password, :email, :level, :gender)";
	$stmt=$conn->prepare($query);
	$stmt->bindvalue(':username',$usename);
	$stmt->bindvalue(':password',md5($password));
	$stmt->bindvalue(':email',$email);
	$stmt->bindvalue(':level',2);
	$stmt->bindvalue(':gender',$gender);
	$stmt->execute();
	header('location: login.php?id="success"');
}
} ?>

<?php require_once 'templates/header.php'; ?>

<div class="container">
	<form action="register.php" method="POST" accept-charset="utf-8">
	<h4> ĐĂNG KÍ</h4>
		<table id="login">
			<tr>
				<td>usename</td>
				<td><input type="text" name="usename"></td>
				<td><h5><?php echo $notification['erroruse']; ?></h5></td>
			</tr>
			<tr>
				<td>password</td>
				<td><input type="password" name="password" ></td>
				<td><h5><?php echo $notification['errorpws']; ?></h5></td>
				<td><h5><?php echo $notification['errorrpws']; ?></h5></td>
			</tr>
			<tr>
				<td>re-password</td>
				<td><input type="password" name="re-password" ></td>
				<td><h5><?php echo $notification['errorpws']; ?></h5></td>
				<td><h5><?php echo $notification['errorrpws']; ?></h5></td>
			</tr>
			<tr>
				<td>email</td>
				<td><input type="email" name="email" ></td>
				<td><h5><?php echo $notification['erroremail']; ?></h5></td>
			</tr>
			<tr>
			<td>Gender</td>
			<td>Male<input type="radio" name="gender" value="1" id="gender" >
				Female<input type="radio" name="gender" value="2" id="gender" >
			</td>
			<td><h5><?php echo $notification['errorgd']; ?></h5></td>
		</tr>

			<tr>
				<td></td>
				<td><button type="submit" name="check" >Đăng Kí</button></td>
			</tr>
			<tr>
			<td></td>
			<td><p>Đã Có Tài Khoản?<a href="login.php" style="color: green;"> Đăng Nhập</a></p></td>
			</tr>
			<tr>
			<td></td>
				<td><h5><?php echo $notification['errorruse2']; ?></h5>
				<h5><?php echo $notification['errorruse1']; ?></h5></td>
			</tr>
		</table>
	</form>
</div>

<?php require_once 'templates/footer.php'; ?>