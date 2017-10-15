<?php require_once 'header.php'; ?>
<?php if ($_SESSION['name']){//check neu sesion name bâng admin thi cho vao
?>
<?php 
require_once '../admin/dbconnect.php';
$conn=getConnection();
$query=" SELECT * FROM categories";
$stmt=$conn->prepare($query);
$stmt->execute();
$laydanhmuc=$stmt->fetchall();
 ?>


 <?php 
 $namepost=$_SESSION['users_id'];// laays use id cua nguoi dung thong qua sesssion
 $notification=array();
 $notification['error']=NULL;
if (isset($_POST['check'])) {

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
        	$imaup['ok']='images/no-image.jpg';
        }

        }else{
        		$imaup['ok']='images/no-image.jpg';
        }

	if (is_numeric($_POST['txtprice'])!=TRUE) {
		$notification['error']="* Giá không được viết bằng chữ";
	}else{
		$price=$_POST['txtprice'];

	}
		$name=$_POST['txtname'];
		$danhmuc=$_POST['txtdanhmuc'];
		$info=$_POST['txtinfo'];
		$images=$imaup['ok'];
if (isset($price) && isset($name) && isset($danhmuc) && isset($images) && isset($namepost) && isset($info)) {
require_once '../admin/dbconnect.php';
$conn=getConnection();
$query="INSERT INTO products(product_name,price,cate_id,image,namepost,detail_info)
		VALUES (:product_name, :price, :cate_id, :image, :namepost, :detail_info)";
$stmt=$conn->prepare($query);
$stmt->bindvalue(':product_name',$name);
$stmt->bindvalue(':price',$price);
$stmt->bindvalue(':cate_id',$danhmuc);
$stmt->bindvalue(':image',$images);
$stmt->bindvalue(':namepost',$namepost);
$stmt->bindvalue(':detail_info',$info);
$stmt->execute();
header('location: danhsachspcuathanhvien.php?notification=createspok');
}
}

  ?>
<div class="content" style="background: #fff7ee;">
<div class="createsp">
<form action="themsanpham.php" method="POST" accept-charset="utf-8" enctype="multipart/form-data">
<h2>ĐĂNG TIN</h2>
	<table>
		<tr>
		<td>Danh Mục</td>
		<td><select name="txtdanhmuc" required>
		<!-- lây ra cac danh mục có trong hệ thông -->
		<?php foreach ($laydanhmuc as $value) {?>
			<option value="<?= $value['cate_id'] ?>" ><?= $value['cate_name'] ?></option>
			<?php } ?>
		</select></td>
	</tr>

	<tr>
		<td>Tên Sản Phẩm</td>
		<td><input type="text" name="txtname" value="" placeholder="Ex: máy tính" required></td>
	</tr>
	<tr>
		<td>giá</td>
		<td><input type="text" name="txtprice" value="" placeholder="200.000.000" required>
		<?php echo  '<br>'.'<p style="color:red;font-size:14px;margin-left:20px">'.$notification['error'].'</p>'; ?></td>
	</tr>
	<tr>
		<td>Mô Tả Sản Phẩm</td>
		<td><textarea name="txtinfo" required placeholder="ghi mô tả sản phẩm ở đây"></textarea></td>
	</tr>
	<tr>
		<td>Hình ảnh</td>
		<td><input type="file" name="avatar" required></td>
	</tr>
	<tr>
		<td></td>
		<td><input type="submit" name="check" value="Đăng Sản Phẩm" id="submit"></td>
	</tr>
	</table>
</form>
</div>
</div>
	<?php require_once 'aside.php'; ?>
</div>
<?php require_once 'footer.php'; ?>
<?php 
	}else{
		echo "<center><img src='../images/knight.png'><p style='color:green;font-size:40px;margin-left:20px;'>Security</p></center>";
		echo "<center>Bạn Phải Đăng Nhập Mới Được Vào Trang Này <a href='../login.php'>Đăng Nhập</a> hoặc trở về <a href='../index.php'>TrangChủ</a>";
	}
 ?>