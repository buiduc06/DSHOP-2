<?php $checksesion=session_start(); ?><!-- gán hàm session bằng checksesion rồi vào header kiem tra neu bien này ton tai thi không bật sessionstart nữa -ducdeveloper -->
<?php if ($_SESSION['name']=='admin'){//check neu sesion name bâng admin thi cho vao
?>


<!-- phần lấy dữ liệu cho vào phần danh lựa chọn danh mục -->
   <?php 
 	require_once "dbconnect.php";//mở kết nối đến cơ sở dữ liệu
	$conn=getconnection();
 	$query="SELECT * FROM categories ";
 	$stmt=$conn->prepare($query);
	$stmt->execute();
	$result2=$stmt->fetchall();
  ?>
<!-- đóng -->
<?php require_once 'header.php';  ?>
		<div class="content">
			<form action="themsanpham.php" method="POST" accept-charset="utf-8" id="createcategories" enctype="multipart/form-data">
			<table>
			<br><b>Thêm Sản Phẩm Mới</b>
			<tr>
				<td>Tên Sản Phẩm</td>
				<td><input type="text" name="product_name"></td>
				<td></td>
			</tr>
			<tr>
				<td>giá</td>
				<td><input type="text" name="price" ></td>
			</tr>
			<tr>
				<td>Chi Tiết Sản Phẩm</td>
				<td><textarea name="detail_info"></textarea></td>
			</tr>
			<tr>
				<td>Chuyên Mục</td>
				<td><select name="categories" required>
					<option value="0">chọn</option>
					<!-- VÒNG LẶP 2 -->
					<?php foreach ($result2 as $key => $value) { // vòng lặp foreach lấy cate_id và cate_name ra màn hình để người dùng lựa chọn
			?>
					<option value="<?= $value['cate_id'] ?>"><?= $value['cate_name'] ?></option>
					<?php } ?>
				</select></td>
			</tr>
			<tr>
				<td>Hình ảnh</td>
        		<td><input type="file" name="avatar"/></td>
    </td>
			</tr>
			<tr>
                <td></td>
				<td><button type="submit" value="check" name="check">Thêm</button></td>
			</tr>
			</table>
			</form>
			<CENTER>
			<!-- code php -->
<?php 
$notification=array();//mảng thông báo lỗi
$imaup=array();
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
                echo 'File Uploaded Thành Công';
            }
        }else{
        		$imaup['ok']='images/no-image.jpg';
        }

        }else{
        		$imaup['ok']='images/no-image.jpg';
        }
    

	if (empty($_POST['product_name']) ||empty($_POST['price']) ||empty($_POST['detail_info']) ) { 
	//check xem các ô có được nhập dữ liệu hay k?
		$notification['loirong']="vui lòng lựa chọn hết các dữ liệu";
	}
	else{ 
	// nếu có dữ liệu thì gán dữ liệu cho biến
		$product_name=$_POST['product_name'];
		$price=$_POST['price'];
		$detail_info=$_POST['detail_info'];
		$image=$imaup['ok'];
		$cate_id=$_POST['categories'];
		$namepost=$_SESSION['users_id'];

	}
	//check xem có tồn tại các biến đã gná không nếu tồn tại thì mở kết nối dữ liệu
	if (isset($product_name) && isset($price) && isset($detail_info) && isset($image) && isset($namepost)) {
	require_once'dbconnect.php';
	$conn=getconnection();
//câu lệnh insert dữ liệu vào bảng
	$query="INSERT INTO products(product_name,image,price,detail_info,cate_id,namepost)
			VALUES (:product_name, :image, :price,:detail_info,:cate_id,:namepost)";
	$stmt=$conn->prepare($query);
	$stmt->bindvalue(':product_name',$product_name);
	$stmt->bindvalue(':image',$image);
	$stmt->bindvalue(':price',$price);
	$stmt->bindvalue(':detail_info',$detail_info);
	$stmt->bindvalue(':cate_id',$cate_id);
	$stmt->bindvalue(':namepost',$namepost);
	$stmt->execute();
	header('location: quanlysanpham.php');

}
else{
	print_r($notification['loirong']);
}
}

 ?>
 </CENTER>
		</div>

<?php require_once 'footer.php'; ?>


<?php 
	}else{
		echo "<center>xin lỗi bạn không được phép truy cập trang này nếu là quản trị viên vui lòng <a href='../login.php'>Đăng Nhập</a> lại";
	}
 ?>