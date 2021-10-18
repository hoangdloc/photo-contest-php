<?php session_start();
require_once('controller/dbconnection.php');
if (isset($_SESSION['id'])) {
	header('Location: index.php');
	exit();
}

//Code for Registration 
if (isset($_POST['signup'])) {
	$fname = $_POST['fname'];
	$lname = $_POST['lname'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$contact = $_POST['contact'];
	$enc_password = $password;
	$sql = mysqli_query($con, "select id from user where email='$email'");
	$row = mysqli_num_rows($sql);
	if ($row > 0) {
		echo "<script>alert('Địa chỉ email đã tồn tại. Vui lòng nhập lại địa chỉ email !');</script>";
	} else {
		$msg = mysqli_query($con, "insert into user(fname,lname,email,password,contactno) values('$fname','$lname','$email','$enc_password','$contact')");

		if ($msg) {
			echo "<script>alert('Đăng ký thành công');</script>";
		}
	}
}

// Code for login 
if (isset($_POST['login'])) {
	$password = $_POST['password'];
	$dec_password = $password;
	$useremail = $_POST['uemail'];
	$ret = mysqli_query($con, "SELECT * FROM user WHERE email='$useremail' and password='$dec_password'");
	$num = mysqli_fetch_array($ret);
	if ($num > 0) {
		$extra = "index.php";
		$_SESSION['login'] = $_POST['uemail'];
		$_SESSION['id'] = $num['id'];
		$_SESSION['name'] = $num['fname'];
		$host = $_SERVER['HTTP_HOST'];
		$uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
		header("location:http://$host$uri/$extra");
		exit();
	} else {
		echo "<script>alert('Thông tin đăng nhập sai !');</script>";
		$extra = "login.php";
		$host  = $_SERVER['HTTP_HOST'];
		$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
		//header("location:http://$host$uri/$extra");
		exit();
	}
}

//Code for Forgot Password

if (isset($_POST['send'])) {
	$femail = $_POST['femail'];

	$row1 = mysqli_query($con, "select email,password from users where email='$femail'");
	$row2 = mysqli_fetch_array($row1);
	if ($row2 > 0) {
		$email = $row2['email'];
		$subject = "Information about your password";
		$password = $row2['password'];
		$message = "Your password is " . $password;
		mail($email, $subject, $message, "From: $email");
		echo  "<script>alert('Your Password has been sent Successfully');</script>";
	} else {
		echo "<script>alert('Email not register with us');</script>";
	}
}

?>
<!DOCTYPE html>
<html>

<head>
	<title>Photogram</title>
	<link href="css/style-login.css?v=<?php echo time(); ?>" rel='stylesheet' type='text/css' />
	<link rel="icon" type="image/x-icon" href="images/logo.png" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<script type="application/x-javascript">
		addEventListener("load", function() {
			setTimeout(hideURLbar, 0);
		}, false);

		function hideURLbar() {
			window.scrollTo(0, 1);
		}
	</script>
	</script>
	<script src="js/jquery.min.js"></script>
	<script src="js/easyResponsiveTabs.js" type="text/javascript"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			$('#horizontalTab').easyResponsiveTabs({
				type: 'default',
				width: 'auto',
				fit: true
			});
		});
	</script>
	<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,400,600,700,200italic,300italic,400italic,600italic|Lora:400,700,400italic,700italic|Raleway:400,500,300,600,700,200,100' rel='stylesheet' type='text/css'>
</head>

<body>
	<div class="main">
		<h1>Tham gia cuộc thi về chụp ảnh ngay hôm nay</h1>
		<div class="sap_tabs">
			<div id="horizontalTab" style="display: block; width: 100%; margin: 0px;">
				<ul class="resp-tabs-list">
					<li class="resp-tab-item" aria-controls="tab_item-0" role="tab">
						<div class="top-img"><img src="images/top-note.png" alt="" /></div><span>Đăng ký</span>

					</li>
					<li class="resp-tab-item" aria-controls="tab_item-1" role="tab">
						<div class="top-img"><img src="images/top-lock.png" alt="" /></div><span>Đăng nhập</span>
					</li>
					<li class="resp-tab-item lost" aria-controls="tab_item-2" role="tab">
						<div class="top-img"><img src="images/top-key.png" alt="" /></div><span>Quên mật khẩu ?</span>
					</li>
					<div class="clear"></div>
				</ul>

				<div class="resp-tabs-container">
					<div class="tab-1 resp-tab-content" aria-labelledby="tab_item-0">
						<div class="facts">

							<div class="register">
								<form name="registration" method="post" action="" enctype="multipart/form-data">
									<p>Tên</p>
									<input type="text" class="text" value="" name="fname" required>
									<p>Họ</p>
									<input type="text" class="text" value="" name="lname" required>
									<p>Email</p>
									<input type="text" class="text" value="" name="email">
									<p>Password </p>
									<input type="password" value="" name="password" required>
									<p>Số điện thoại</p>
									<input type="text" value="" name="contact" required>
									<div class="sign-up">
										<input type="reset" value="Reset">
										<input type="submit" name="signup" value="Đăng ký">
										<div class="clear"> </div>
									</div>
								</form>

							</div>
						</div>
					</div>
					<div class="tab-2 resp-tab-content" aria-labelledby="tab_item-1">
						<div class="facts">
							<div class="login">
								<div class="buttons">


								</div>
								<form name="login" action="" method="post">
									<p>Email</p>
									<input type="text" class="text" name="uemail" value="" placeholder="Nhập email"><a href="#" class=" icon email"></a>
									<p>Mật khẩu</p>
									<input type="password" value="" name="password" placeholder="Nhập password"><a href="#" class=" icon lock"></a>

									<div class="p-container">

										<div class="submit two">
											<input type="submit" name="login" value="Đăng nhập">
										</div>
										<div class="clear"> </div>
									</div>

								</form>
							</div>
						</div>
					</div>
					<div class="tab-2 resp-tab-content" aria-labelledby="tab_item-1">
						<div class="facts">
							<div class="login">
								<div class="buttons">


								</div>
								<form name="login" action="" method="post">
									<input type="text" class="text" name="femail" value="" placeholder="Nhập email đã đăng ký" required><a href="#" class=" icon email"></a>

									<div class="submit three">
										<input type="submit" name="send" onClick="myFunction()" value="Gửi Email">
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

</body>

</html>