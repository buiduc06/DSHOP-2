<?php require_once 'header.php'; ?>
<?php if ($_SESSION['name']){//check neu sesion name bâng admin thi cho vao
?>
<?php 
// phần upload hình ảnh
if (isset($_POST['check'])) {
	$gender=$_POST['gender'];
	$name=$_POST['txtname'];
	$email=$_POST['txtemail'];
if ($_FILES['avatar']['name']!=NULL) {
        
        //phần config upload hình ảnh
        if (isset($_FILES['avatar']))
        {
            // Nếu file upload không bị lỗi,
            // Tức là thuộc tính error > 0
            if ($_FILES['avatar']['error'] > 0)
            {
                echo 'File Upload Bị Lỗi';
            }elseif ($_FILES['avatar']['type'] != 'image/jpeg' && $_FILES['avatar']['type'] != 'image/png') {
                echo "bạn chỉ được upload file dưới dạng PNG và JPEG";
            }elseif ($_FILES['avatar']['size']>2*1024*1024) {
                echo "bạn chỉ được tải lên file >2 MB";
            }
            else{
                // Upload file
                move_uploaded_file($_FILES['avatar']['tmp_name'], '../images/'.$_FILES['avatar']['name']);
                $imaup['ok']='images/'.$_FILES['avatar']['name'];
                // echo 'File Uploaded Thành Công';
            }
        }else{
        	
        }

        }else{
        		
        }
}
// nếu người dùng chọn chỉnh sửa tên và img thì thực hiện lệnh 1
if (isset($name)&&isset($imaup['ok'])) {
	$username=$_SESSION['name'];
	$avatar=$imaup['ok'];
	require_once '../admin/dbconnect.php';
	$conn=getconnection();
	$query="UPDATE users SET name=:name,avatar=:avatar,gender=:gender WHERE username=:username";
	$stmt=$conn->prepare($query);
	$stmt->bindvalue(':name',$name);
	$stmt->bindvalue(':avatar',$avatar);
	$stmt->bindvalue(':username',$username);
	$stmt->bindvalue(':gender',$gender);
	$stmt->execute();
	header('location: index.php?updateinfo=true');
}
// nếu người dùng chọn chỉnh sửa tên ko chỉnh sửa img thì thực hiện lệnh 2
if (isset($name)) {
	$username=$_SESSION['name'];
	require_once '../admin/dbconnect.php';
	$conn=getconnection();
	$query="UPDATE users SET name=:name,gender=:gender WHERE username=:username";
	$stmt=$conn->prepare($query);
	$stmt->bindvalue(':name',$name);
	$stmt->bindvalue(':username',$username);
	$stmt->bindvalue(':gender',$gender);
	$stmt->execute();
	header('location: index.php?updateinfo=true');
}

 ?>

 <!-- phan lay ra hinh anh -->
<?php 

$usename=$_SESSION['name'];
require_once '../admin/dbconnect.php';
$conn=getconnection();
$query=" SELECT * FROM users WHERE username='$usename'";
$stmt=$conn->prepare($query);
$stmt->execute();
$result2=$stmt->fetchall();
 ?>

<div class="content">
<h4>Chỉnh Sửa Thông Tin Cá Nhân</h4>
<form action="edit-info.php" method="POST" accept-charset="utf-8" enctype="multipart/form-data" >
<div class="content-col1">
<!-- phần hình ảnh -->
	<div class="content-col1-images">
	<?php foreach ($result2 as $value) {
	 ?>
	 <!-- nếu ko tồn tại ảnh thì gán ảnh bằng ảnh no_image.jpg -->
	 <?php if ($value['avatar']!=null) {
				$value['avatar'];
			}else{
				$value['avatar']='images/No_image.jpg';
				} ?>
	
		<img src="../<?= $value['avatar'] ?>" alt="">
		<?php } ?>
	</div>
				<input type="file" name="avatar">

</div>
<div class="content-col2">
	<table>
			<tr>
				<td>Full Name</td>
				<td><input type="text" name="txtname" value="<?= $value['name']; ?>" required></td>
			</tr>
			<tr>
				<td>Gender</td>
				<td><select name="gender" id="gender" required>
				<!-- nếu gender trong db bằng 1 thì mặc định chọn sẽ là nam -->
					<?php if ($value['gender']==1) {
					echo "<option value='1'>Nam</option>";
				}else{
					echo "<option value='2'>Nữ</option>";
					} ?>
					<!-- echo ra trường hợp ngược lại để người dùng nhập -->
					<?php if ($value['gender']==2) {
					echo "<option value='1'>Nam</option>";
				}else{
					echo "<option value='2'>Nữ</option>";
					} ?>
				</select></td>
			</tr>

			<tr>
				<td>Cấp Độ</td>
				<td><?php if ($value['level']==1) {
					echo "<b>Quản Trị Viên</b>";
				}else{
					echo "<b>Thành Viên</b>";
					} ?></td>
			</tr>
			
	</table>
</div>
		<tr>
				<td></td>
				<td><button type="submit" name="check">Chỉnh Sửa</button></td>
			</tr>
</form>
</div>

	<?php require_once 'aside.php'; ?>
<?php require_once 'footer.php'; ?>
<?php 
	}else{
		echo "<center>xin lỗi bạn không được phép truy cập trang này nếu là quản trị viên vui lòng <a href='../login.php'>Đăng Nhập</a> lại";
	}
 ?>