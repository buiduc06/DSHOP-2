<?php 
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
$id=$_GET['id'];
$name=$_POST['txtname'];
$price=$_POST['txtprice'];
$image=$imaup['ok'];
$detail_info=$_POST['detail_info'];
$danhmuc=$_POST['danhmuc'];
if (isset($name) &&isset($price) &&isset($image) &&isset($detail_info) &&$danhmuc) {
    require_once '../admin/dbconnect.php';
    $conn=getconnection();
    $query=" UPDATE products SET image=:image,product_name=:product_name,price=:price,detail_info=:detail_info,cate_id=:cate_id WHERE products_id=:products_id ";
    $stmt=$conn->prepare($query);
        $stmt->bindvalue(':products_id',$id);
    $stmt->bindvalue(':image',$image);
    $stmt->bindvalue(':product_name',$name);
    $stmt->bindvalue(':price',$price);
    $stmt->bindvalue(':detail_info',$detail_info);
    $stmt->bindvalue(':cate_id',$danhmuc);
    $stmt->execute();
    header('location: danhsachspcuathanhvien.php?check=ok');
}


 ?>