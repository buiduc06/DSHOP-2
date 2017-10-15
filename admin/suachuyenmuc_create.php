<?php $checksesion=session_start(); ?><!-- gán hàm session bằng checksesion rồi vào header kiem tra neu bien này ton tai thi không bật sessionstart nữa -ducdeveloper -->
<?php if ($_SESSION['name']=='admin'){//check neu sesion name bâng admin thi cho vao
?>

<?php 
$checkdanhmuc=array();
$id=$_GET['id'];
$edit_name1=$_POST['edit_name'];
$edit_link=$_POST['edit_link'];
// phan upload hinh anh
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
$images=$imaup['ok'];
        // he phan upload hinh anh
if (is_string($edit_name1)) {
		$edit_name=$edit_name1;
}else{
	header("location: suachuyenmuc.php?id=$id&&check=kt");
}

// phần check xem chuyên mục đã tồn tại hay chưa
if (isset($edit_name)) {
	require_once 'dbconnect.php';
	$conn=getconnection();
	$query="SELECT * FROM categories WHERE cate_id!=$id";
	$stmt=$conn->prepare($query);
	$stmt->execute();
	$result12=$stmt->fetchall();

	foreach ($result12 as $value) {
		$checkdanhmuc[]=$value['cate_name']; // gán tất cả các chuyên mục vào 1 mảng
	}
	$checkdl=in_array($edit_name,$checkdanhmuc); // tìm trong mảng đó xem có tồn tại chuyên mục mà ng dùng nhập ko
	if ($checkdl==TRUE) {// nếu tên dmục bị trùng thì dừng và in ra thông báp
		header("location: suachuyenmuc.php?id=$id&&check=fl");

	}else{ 
// mở kết nối và chỉnh sửa danh mục trong database
	$conn=getconnection();
	$query1="UPDATE categories SET cate_name=:edit_name,cate_link=:edit_link,images=:images WHERE cate_id=:id";
	$stmt1=$conn->prepare($query1);
	$stmt1->bindvalue('id',$id);
	$stmt1->bindvalue('edit_name',$edit_name);
	$stmt1->bindvalue('edit_link',$edit_link);
	$stmt1->bindvalue('images',$images);
	$stmt1->execute();
	header('location: quanlychuyenmuc.php');
}
}
 ?>

 <?php 
	}else{
		echo "<center>xin lỗi bạn không được phép truy cập trang này nếu là quản trị viên vui lòng <a href='../login.php'>Đăng Nhập</a> lại";
	}
 ?>