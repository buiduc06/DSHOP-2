<!-- <?php 
	move_uploaded_file($_FILES["userfile"],["tmp_name"], "data/".$_FILES["userfile"]["name"]);
	echo "upload thanh cong";
 ?> -->



 <!DOCTYPE html>
<html>
    <head>
        <title></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    </head>
<body>
    <form method="post" action="upload.php" enctype="multipart/form-data">
        <input type="file" name="avatar"/>
        <input type="submit" name="uploadclick" value="Upload"/>
    </form>
    <?php // Xử Lý Upload
  
    // Nếu người dùng click Upload
    if (isset($_POST['uploadclick']))
    {
        // Nếu người dùng có chọn file để upload
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
                move_uploaded_file($_FILES['avatar']['tmp_name'], './folder/'.$_FILES['avatar']['name']);
                echo 'File Uploaded Thành Công';
            }
        }
        else{
            echo 'Bạn chưa chọn file upload';
        }
    }
?>
</body>
</html>