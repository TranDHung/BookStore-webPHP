<?php
    session_start();
	require_once('database.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
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
    <style type="text/css">
        body{
            background-image: url("bookbg.jpg");
            background-repeat: no-repeat;
            background-size: cover;
        }
        .container{
            float:right;
        }
    </style>
</head>
<body>
<div class="grove">
<div id="div" class="fancy">
    <img id="img" src="faIcon.jpg">
</div>  
</div>

<?php

    $error = '';
    $user = '';
    $pass = '';

    if (isset($_POST['user']) && isset($_POST['pass'])) {
        $user = $_POST['user'];
        $pass = $_POST['pass'];

        if (empty($user)) {
            $error = 'Làm ơn! Nhập tên đăng nhập';
        }
        else if (empty($pass)) {
            $error = 'Làm ơn! Nhập mật khẩu';
        }
        else if (strlen($pass) < 6) {
            $error = 'Mật khẩu phải dài hơn 6 ký tự nhé!';
        }
        else{
			$result = login($user, $pass);
			if ($result['code'] ==0){
				$data = $result['data'];
				$_SESSION['user'] = $user;
                $_SESSION['pass'] = $pass;
				$_SESSION['fullname'] = $data['hoten'];
                $_SESSION['dateBirth'] = $data['ngaysinh'];
                $_SESSION['sdt'] = $data['sdt'];
                $_SESSION['type'] = $data['type'];
				header('Location: index_login.php');
				exit();
			}else {
				$error = $result['error'];
			}
        }
    }
?>
	<div class="container col-4 mx-2" style="color:darkblue">
    <div class="row">
        <div class="mt-3" style="width:90%;">
            <form method="post" action="" class="border rounded w-100 mb-5 mx-auto px-4 pt-3 mt-5" style="background-color: #CCFFFF">
                <h1 class="text-center mt-4 mb-3">Đăng nhập</h1>
				<div class = "text-center mb-4 text-info font-weight-bold">Sử dụng Tài khoản Hệ thống của bạn</div>
				
				<div class="form-group">
                    <label for="user">Tên đăng nhập</label>
                    <input  name="user" value="<?= $user ?>" id="user" type="text" class="form-control" placeholder="Tên đăng nhập">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input id="input"name="pass" value="<?= $pass ?>" id="password" type="password" class="form-control" placeholder="Password">
                </div>
                <!-- <div class="form-group custom-control custom-checkbox"> -->
                    <!-- <input  name="remember" type="checkbox" class="custom-control-input" id="remember"> -->
                    <!-- <label class="custom-control-label" for="remember">Remember login</label> -->
                <!-- </div> -->
                <div class="form-group text-right">
					<?php
                        if (!empty($error)) {
                            echo "<div class='alert alert-danger'>$error</div>";
                        }
                    ?>
                    <button class="btn btn-primary px-3 mt-4 mb-4">Đăng nhập</button>
                </div>
                <div class="form-group">
                    <p>Bạn chưa có tài khoản? <a href="register.php" class = "font-italic font-weight-bold">Tạo tài khoản</a>.</p>
                    <p>Quên mật khẩu? <a href="#" class = "font-italic font-weight-bold">Đặt lại mật khẩu</a>.</p>
                </div>
            </form>
            
        </div>
    </div>
</div>
</body>
</html>