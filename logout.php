 <?php 
 	session_start();
	session_destroy();
 ?>
 <!DOCTYPE html>
 <html>
 <head>
 	<meta charset="utf-8">
 	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<style type="text/css">
	p{
		font-size: 18px;
		color: black;
		font-family: arial;
		text-align: center;
	}

		#textbox{
	border: none;
	width: 10px;
	color: red;
	font-size: 20px; 
	margin:0 10px 0 10px;
		}
	</style>
 </head>
 <body>

 	<p>đăng xuất thành công sẽ tự động trở về trang chủ sau <input type="text" id="textbox" ></p>
 <script>
		var number=5;
		function demnguoc() {
			number=number-1;
			if (number !=0) {
				document.getElementById("textbox").value=number;
				setTimeout("demnguoc()",500);
			}else{
				window.location.href="index.php";
			}
		}
		demnguoc();
	</script>

 </body>
 </html>