<?php
    session_start();
	require_once('database.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Tạo tài khoản</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $("#input").focusout(function(){
                $("#div").animate({width: '0px', height: '0px'});
                $("#img").animate({width: '0px', height: '0px'});
                $("#div").fadeOut();
            });
            $("#input").focusin(function(){
                $("#div").animate({width: '500px', height: '500px'});
                $("#img").animate({width: '300px', height: '300px'});
                $("#div").css({display: 'block'})
            });
        });
    </script>
    <style type="text/css">
        body{
            background: lightgray
        }
        .fancy{
            border-radius: 90% 10% 84% 16% / 15% 82% 18% 85% ;
            width: 500px;
            height: 500px;
            background: white;
            margin-top: 100px;
            margin-left: 100px;
            animation-name: fancy;
            animation-duration: 2.5s;
            text-align: center;
        }
        .grove{
            margin-bottom: 100px;
            animation: grove 9s linear infinite;
            height: 500px;
            margin-left: 100px;
            position: absolute;
            left: 0;
            bottom: 0;
        }
        .fancy img{
            height: 300px;
            width: 300px;
            margin: auto;
            margin-top: 90px;
            opacity: 0;
            animation: appear 1.2s;
            animation-delay: 2s;
            animation-fill-mode: forwards;
        }
        @keyframes appear{
            from{opacity: 0}
            to{opacity: 1}
        }
        @keyframes grove {
            0%, 100% {
              bottom: 0;
            }
            50% {
              bottom: 155px;
            }
        }
        @keyframes fancy {
          from {border-radius: 16% 84% 6% 94% / 90% 13% 87% 10% }
          to {border-radius: 90% 10% 84% 16% / 15% 82% 18% 85%}
          from{background: #DF0101}
          to{background:  white;}
        }
    </style>
</head>

<?php
    $error = '';
	$success = '';
	$user = '';
	$bdate = '';
    $full_name = '';
	$phoneN = '';
    $pass = '';
    $pass_confirm = '';
	$check = false;

    if (isset($_POST['username']) && isset($_POST['birthd']) &&  isset($_POST['name']) && isset($_POST['pass'])
    && isset($_POST['pass-confirm']) && isset($_POST['phoneN']))
    {
		$user = $_POST['username'];
		$bdate = $_POST['birthd'];
		$phoneN = $_POST['phoneN'];
        $full_name = $_POST['name'];
        $pass = $_POST['pass'];
        $pass_confirm = $_POST['pass-confirm'];
		$type = 2;
		
		if (empty($phoneN)) {
            $error = 'Nhập số điện thoại';
        }
		else if (empty($user)) {
            $error = 'Nhập tên đăng nhập';
        }
		else if (empty($bdate)) {
            $error = 'Nhập ngày sinh';
        }
        else if (empty($full_name)) {
            $error = 'Nhập tên đầy đủ';
        }
        else if (empty($pass)) {
            $error = 'Nhập mật khẩu';
        }
        else if (strlen($pass) < 6) {
            $error = 'Mật khẩu phải nhiều hơn 6 kí tự';
        }
        else if ($pass != $pass_confirm) {
            $error = 'Mật khẩu không khớp';
        }
        else {
            // register a new account
           $result = register($user,$pass,$full_name,$bdate,$phoneN,$type);
		   if ($result['code'] == 0){
			  $check = true;
			   $success = 'Đăng ký thành công';
		   }else if ($result['code'] ==3){
				$error = 'Tên đăng nhập đã tồn tại';
		   }else{
			   $error = 'Xảy ra lỗi. Vui lòng thử lại sau';
		   }
        }
    }
?>

<style type="text/css">
        body{
            background-image: url("bookbg.jpg");
            background-repeat: no-repeat;
            background-size: cover;
        }
        .container{
            float: right;
        }
    </style>
<body>
    <div class="grove">
    <div id="div" class="fancy">
        <img id="img" src="faIcon.jpg">
    </div>  
    </div>
    <div class="container col-4">
        <div class="row">
            
			<?php
				if(!$check){
					?>
            <div class="border p-3 rounded mx-3" style="background-color: #CCFFFF; width: 100%;">
                <form method="post" action="" novalidate style="height: 100%">
					<h3 class="text-center text-secondary">Tạo tài khoản</h3>
					<div class="form-group">
                        <label for="pass">Tên đăng nhập</label>
                        <input name="username" required class="form-control" value = "<?= $user ?>" type="text" placeholder="Username" id="username">
                    </div>
					<div class="form-group">
                        <label for="pass">Mật khẩu</label>
                        <input name="pass" required class="form-control" value = "<?= $pass ?>" type="password" placeholder="Password" id="pass">
                        <div class="invalid-feedback">Password is not valid.</div>
                    </div>
                    <div class="form-group">
                        <label for="fullname">Họ và Tên</label>
                        <input name="name" required class="form-control" value = "<?= $full_name ?>" type="text" id="fullname">
                    </div>
					<div class="form-group">
                        <label for="birthd">Ngày sinh</label>
                        <input name="birthd" required class="form-control" value = "<?= $bdate ?>" type="date"  id="birthd">
                    </div>
                    <div class="form-group">
                        <label for="phoneN">Số điện thoại</label>
                        <input name="phoneN" required class="form-control" value = "<?= $phoneN ?>" type="text" id="phoneN">
                    </div>
                    <div class="form-group">
                        <label for="pass2">Nhập lại mật khẩu</label>
                        <input name="pass-confirm" required class="form-control" value = "<?= $pass_confirm ?>" type="password" placeholder="Confirm Password" id="pass2">
                        <div class="invalid-feedback">Password is not valid.</div>
                    </div>

                    <div class="form-group mt-4 mr-4">
						<?php
                            if (!empty($error)) {
                                echo "<div class='alert alert-danger'>$error</div>";
                            }
                        ?>
                        <button class="btn btn-success float-right">Đăng kí</button>
						<p>Đã có tài khoản? <a href="login.php">Login</a> now.</p>
                    </div>
                </form>
            </div>
				<?php
				}else{
			?>
             <div class="border p-3 rounded mx-3" style="background-color: #FFF; width: 100%;padding-top: 240px;">
				<form method="post" action="" novalidate >
					<h3 class="text-center text-secondary mt-1 mb-2">Tạo tài khoản</h3>
                    <div class="form-group mt-3">
                        <?php
                            if (!empty($success)) {
                                echo "<div class='alert alert-success' style= 'text-align:center;'>$success</div>";
                            }
                        ?>
                        <p class="btn btn-primary px-3 mt-4 mb-4" style="float:right" ><a href="login.php" style="color: white;">Login</a></p>
                    </div>
                </form>
            </div>
				<?php
				}
				?>
				
        </div>

    </div>
</body>
</html>

