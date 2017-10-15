<?php require_once 'templates/header.php'; ?>
<?php 
$notifcation=array();
$notifcation['errorpw']=NULL;
$notifcation['errorpw1']=NULL;
$notifcation['errorpw2']=NULL;
$notifcation['errorpw3']=NULL;
$notifcation['errornowpwscheck']=NULL;
	$updatepwsuse=$_SESSION['name']; // lấy username của người dùng thông qua session
if (isset($_POST['check'])) {
	// phần check dữ liệu sạch
		if (empty($_POST['nowpass'])) {
			$notifcation['errorpw']="Xin Vui Lòng Nhập Mật Khẩu";
		}else if (empty($_POST['newpass']) || empty($_POST['re-newpass'])){
			$notifcation['errorpw1']="Xin Vui Lòng Nhập Mật Khẩu";
		}elseif ($_POST['newpass']!=$_POST['re-newpass']) {
			$notifcation['errorpw2']="2 Mật Khẩu Không Trùng Nhau";
		}elseif (strlen($_POST['newpass'])<7) {
			$notifcation['errorpw3']="Mật Khẩu Phải Lớn Hơn 7 kí Tự";
		}
		else{
			$newpass=md5($_POST['newpass']);
			$renewpass=md5($_POST['re-newpass']);
			$nowpass=md5($_POST['nowpass']);
		}
//check pass cũ
//mở kết nối csdl check xem có đúng password nhập vào= pass trong csdl hay ko
		if (isset($nowpass) && isset($newpass) && isset($renewpass)) {
			$checkpws2=array();
			require_once 'admin/dbconnect.php';
			$conn=getConnection();
			$query="SELECT password FROM users WHERE username='$updatepwsuse'";
			$stmt=$conn->prepare($query);
			$stmt->execute();
			$checkpass1=$stmt->fetchall();
			foreach ($checkpass1 as $value) {
				$checkpws2[]=$value['password'];
			}
				if ($nowpass==$value['password']) {
					$nowpassok=$nowpass;
				}else{
					$notifcation['errornowpwscheck']="Sai Mật Khẩu cũ";
				}
			}

//mở cơ ở dữ liệu và sủa mật khẩu cho người dùng
		if (isset($nowpass) && isset($newpass) && isset($renewpass)&& isset($nowpassok)) {
			require_once 'admin/dbconnect.php';
			$conn=getConnection();
			$query1="UPDATE users SET password=:password WHERE username=:updatepwsuse";//vi keiu string nen phai co dau ngoac nhe
			$stmt1=$conn->prepare($query1);
			$stmt1->bindvalue('password',$newpass);
			$stmt1->bindvalue('updatepwsuse',$updatepwsuse);
			$stmt1->execute();
			header('location: login.php?changepasswordok=true');
		}
	}
 ?>
<div class="container">
	<form action="changepassword.php" method="POST" style="margin-top: 50px;margin-bottom: 100px;">
	<h4>ĐỔI MẬT KHẨU</h4>
		<table id="login">
			<tr>
				<td>Mật Khẩu Hiện Tại</td>
				<td><input type="password" name="nowpass"></td>
				<td><?php echo $notifcation['errorpw']; ?>
					<?php echo $notifcation['errornowpwscheck']; ?>
				</td>
			</tr>

			<tr>
				<td>Mật khẩu mới</td>
				<td><input type="password" name="newpass"></td>
				<td><?php echo $notifcation['errorpw1']; ?>
					<?php echo $notifcation['errorpw2']; ?>
					<?php echo $notifcation['errorpw3']; ?>
				</td>
			</tr>

			<tr>
				<td>Nhập lại mật khẩu mới</td>
				<td><input type="password" name="re-newpass"></td>
				<td><?php echo $notifcation['errorpw']; ?>
					<?php echo $notifcation['errorpw2']; ?></td>
			</tr>
			<tr>
				<td></td>
				<td><button type="submit" name="check">Đổi Mật Khẩu</button></td>
			</tr>
		</table>
	</form>
</div>

<?php require_once 'templates/footer.php'; ?>