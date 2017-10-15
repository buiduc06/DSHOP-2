<?php $checksesion=session_start(); ?><!-- gán hàm session bằng checksesion rồi vào header kiem tra neu bien này ton tai thi không bật sessionstart nữa -ducdeveloper -->
<?php if ($_SESSION['name']=='admin'){//check neu sesion name bâng admin thi cho vao
?>
<?php 
// <!-- phần kết nối và lấy dữ liệu cho vào phần hình ảnh nếu người dùng không chọn hình ảnh -->
    $id=$_GET['id']; //dùng hàm get lấy thứ tự ID
    require_once "dbconnect.php";//mở kết nối đến cơ sở dữ liệu
    $conn=getconnection();
    $query="SELECT image FROM products INNER JOIN categories ON products.cate_id = categories.cate_id WHERE products_id=$id"; //câu lệnh lấy dữ liệu từ mysql
    $stmt=$conn->prepare($query);
    $stmt->execute();
    $result9=$stmt->fetchall();

 ?>
<?php 
$idd=$_GET['id'];
$imagesup=array();
        // Nếu người dùng có chọn file để upload
        if (isset($_FILES['avatar']))
        {
            if ($_FILES['avatar']['name']!=NULL) {//nếu arr avatar->name mà khác rống thì thực hiện công vc bến dưới ko ko thì thự hiẹn lênh else
                # code...
            
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
                $imagesup['im']='images/'.$_FILES['avatar']['name'];
                echo 'File Uploaded Thành Công';
            
        }
    }
        else{
            echo 'Bạn chưa chọn file upload';
            foreach ($result9 as $value) {
            $imagesup['im']=$value['image'];
        }
        }
    }else{
            echo 'Bạn chưa chọn file upload';
           
        }
	$edit_name=$_POST['edit_name'];
	$edit_price=$_POST['edit_price'];
	$edit_info=$_POST['edit_info'];
        $edit_img=$imagesup['im'];
    $cate_id=$_POST['categories'];
	require_once "dbconnect.php";
	$conn=getconnection();
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$query=" UPDATE products 
			SET product_name='$edit_name',price=$edit_price,detail_info='$edit_info',image='$edit_img',cate_id=$cate_id
			WHERE products_id=$idd";
	$stmt=$conn->prepare($query);
	$stmt->execute();
	header('location: quanlysanpham.php');

?>


<?php 
    }else{
        echo "<center>xin lỗi bạn không được phép truy cập trang này nếu là quản trị viên vui lòng <a href='../login.php'>Đăng Nhập</a> lại";
    }
 ?>