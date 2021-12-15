<?php include '../classes/loginMyAccount.php'; ?>
<?php
$class = new loginMyAccount();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$user = $_POST['user'];
	$password = $_POST['password'];

	$login_check = $class->loginMyAccount($user, $password);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<title>Life Skills Assistance</title>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="description" content="Flash Able Bootstrap admin template made using Bootstrap 4 and it has huge amount of ready made feature, UI components, pages which completely fulfills any dashboard needs." />
	<meta name="keywords" content="admin templates, bootstrap admin templates, bootstrap 4, dashboard, dashboard templets, sass admin templets, html admin templates, responsive, bootstrap admin templates free download,premium bootstrap admin templates, Flash Able, Flash Able bootstrap admin template">
	<meta name="author" content="Codedthemes" />

	<!-- Favicon icon -->
	<link rel="icon" href="./assets/images/favicon.ico" type="image/x-icon">
	<!-- fontawesome icon -->
	<link rel="stylesheet" href="./assets/fonts/fontawesome/css/fontawesome-all.min.css">
	<!-- animation css -->
	<link rel="stylesheet" href="./assets/plugins/animation/css/animate.min.css">

	<!-- vendor css -->
	<link rel="stylesheet" href="./assets/css/style.css">
</head>

<!-- [ auth-signin ] start -->
<div class="auth-wrapper">
	<div class="auth-content container">
		<div class="card">
			<div class="row align-items-center">
				<div class="col-md-6">
					<form action="./login.php" method="post">
						<div class="card-body">
							<h1 class="mb-3 f-w-400">LIFE SKILLS ASSISTANCE</h1>
							<div class="input-group mb-2">
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="feather icon-mail"></i></span>
								</div>
								<input type="text" class="form-control" name="user" placeholder="Nhập mã số sinh viên">
							</div>
							<div class="input-group mb-3">
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="feather icon-lock"></i></span>
								</div>
								<input type="password" class="form-control" name="password" placeholder="Nhập mật khẩu">
							</div>
							<div id="my_message" class="aleat pl-0 mb-3" style="color: red;">
								<?php
								if (isset($login_check)) {
									echo $login_check;
								}
								?>
							</div>
							<button class="btn btn-primary mb-4">Đăng nhập</button>
							<p class="mb-2 text-muted">Quên mật khẩu? </p>
							<p class="mb-0 text-muted">Nếu quên mật khẩu bạn vui lòng liên hệ quản trị viên để cấp lại.</p>
						</div>
					</form>
				</div>
				<div class="col-md-6 d-none d-md-block">
					<img src="./assets/images/logo_login.png" alt="" class="img-fluid">
				</div>
			</div>
		</div>
	</div>
</div>
<!-- [ auth-signin ] end -->

<!-- Required Js -->
<script src="./assets/js/vendor-all.min.js"></script>
<script src="./assets/plugins/bootstrap/js/bootstrap.min.js"></script>
<script>
	$('#my_message').fadeIn();
	setTimeout(function() {
		$('#my_message').fadeOut(2000);
	}, 1000);
</script>
</body>

</html>