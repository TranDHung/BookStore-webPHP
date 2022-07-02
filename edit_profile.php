<?php
    session_start();
    require_once('database.php');
?>
<!DOCTYPE html>
<html>
<head>
    <title>Index</title>
    <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <style type="text/css" href = "style.css">
    body {
      font-family: Helvetica, sans-serif;
      margin: 0;
      padding: 0;
      text-align: center;
    } 
  </style>

  <?php
    $user = '';
    $bdate = $_SESSION['dateBirth'];
    $full_name = $_SESSION['fullname'];
    $phoneN = $_SESSION['sdt'];
    $newPass = '';
    $newPass_confirm = '';
    $curPass = '';
    $check = false;
    $check1 = false;
    $error = '';
    $infor = '';
    $error1 = '';

    if (isset($_POST['birthd']) &&  isset($_POST['name']) && isset($_POST['phoneN']))
    {
        $user = $_SESSION['user'];
        $bdate = $_POST['birthd'];
        $phoneN = $_POST['phoneN'];
        $full_name = $_POST['name'];
        
        if (empty($phoneN)) {
            $error = 'Nhập số điện thoại';
        }
        else if (empty($bdate)) {
            $error = 'Nhập ngày sinh';
        }
        else if (empty($full_name)) {
            $error = 'Nhập tên đầy đủ';
        }
        else {
            // edit account
           $result = editProfile($user,$full_name,$bdate,$phoneN);
           if ($result['code'] == 0){
              $check = true;
               $infor = 'Chỉnh sửa thông tin thành công';
               $_SESSION['fullname'] = $full_name;
                $_SESSION['dateBirth'] = $bdate;
                $_SESSION['sdt'] = $phoneN;
           }else{
               $infor = 'Xảy ra lỗi. Vui lòng thử lại sau';
           }
        }
    }else if(isset($_POST['curPass']) &&  isset($_POST['newPass']) && isset($_POST['newPass_confirm'])){

        $user = $_SESSION['user'];
        $curPass = $_POST['curPass'];
        $newPass = $_POST['newPass'];
        $newPass_confirm = $_POST['newPass_confirm'];
        $checkPass = checkPass($user,$curPass);

        if (empty($curPass)) {
            $error1 = 'Nhập mật khẩu hiện tại';
        }
        else if (empty($newPass)) {
            $error1 = 'Nhập mật khẩu mới';
        }
        else if (empty($newPass_confirm)) {
            $error1 = 'Nhập mật khẩu xác nhận';
        }
        else if (strlen($newPass) < 6) {
            $error1 = 'Mật khẩu mới phải nhiều hơn 6 kí tự';
        }
        else if ($newPass!= $newPass_confirm) {
            $error1 = 'Mật khẩu không khớp';
        }
        else if($checkPass == false){
            $error1 = 'Mật khẩu hiện tại không đúng';
        }
        else {
            // change password
           $result = changePass($user,$newPass);
           if ($result['code'] == 0){
              $check1 = true;
               $infor = 'Đổi mật khẩu thành công';
               header('Location: logout.php');
           }else{
               $infor = 'Xảy ra lỗi. Vui lòng thử lại sau';
           }

        }
    }
?>

</head>
<body>
    <nav class="navbar navbar-expand-sm bg-warning navbar-infor">
    <a href="index_login.php" class="navbar-brand"><img src="bookstoreicon.png" class="float-left" width="45px" height="45px"></a>
    <a class="navbar-brand" href="index_login.php"><h3 style="color:white; margin-top: 1px">CỬA HÀNG SÁCH HUY HOÀNG</h3></a>

      <ul class="navbar-nav" style="padding-left: 450px; font-size: 20px">
          <?php
            $tp = $_SESSION['type'];
            if($tp == 2){
                ?>
          <li class="nav-item">
            <a class="nav-link" href="#"><i id="noti" class="fa fa-bell" style="font-size:35px;color:red;"></i><div class="shop1">Thông báo</div></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="index_cart.php"><i class="fa fa-shopping-cart" style="font-size:35px;color:red;padding-left: 15px"></i><div class="shop2">Giỏ hàng</div></a>
          </li>
          <?php
            }else{
                ?>
                    <li class="nav-item">
                    <a href="index_manager.php" class="navbar-brand"><i class = "management"><img src="management.png"  width="55px" height="55px" style="padding-left: 15px"></i><div class="shop4">Quản Lý</div></a>
                  </li>
                <?php
                }
            ?>
          <li class="nav-item">
            <a class="nav-link" href="edit_profile.php"><i class='fas fa-user-edit' style='font-size:35px;color:white;padding-left: 35px'></i><div class="shop2">Hồ sơ cá nhân</div></a></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="logout.php" style="margin-top: 2px;padding-left: 50px">Đăng xuất</a>
          </li>
        </ul>
    </nav>
    <div class="container rounded bg-white mt-5 mb-5">
    <div class="row">
        <div class="col-md-6 border-right">
            <div class="p-3 py-5">
                <form method="post">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="text-right">Thay đổi thông tin cá nhân</h4>
                </div>
                <div class="row mt-3">
                    <div class="col-md-12"><label class="labels">Họ Tên</label><input name="name" type="text" class="form-control" placeholder="" value="<?= $full_name?>"></div>
                    <div class="col-md-12"><label class="labels">Ngày sinh</label><input name="birthd" type="date" class="form-control" placeholder="" value="<?= $bdate?>"></div>
                    <div class="col-md-12"><label class="labels">Số điện thoại</label><input name="phoneN" type="text" class="form-control" placeholder="" value="<?= $phoneN?>"></div>
                    
                </div>
                <?php
                            if (!empty($error)) {
                                echo "<div class='alert alert-danger'>$error</div>";
                            }
                    ?>
                <?php
                    if(!$check)
                        ?>
                        <div class="mt-2 text-center"><button class="btn btn-success float-right">Thay đổi thông tin</button></div>
                    <?php
                    if($check)
                         echo "<div class='alert alert-success' style= 'text-align:center;'>$infor</div>";
                ?>
            </form>
            </div>
        </div>
        <div class="col-md-6">
            <div class="p-3 py-5">
                <form method="post">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="text-right">Thay đổi mật khẩu</h4>
                </div>
                <div class="row mt-3">
                    <div class="col-md-12"><label class="labels">Mật khẩu cũ</label><input name="curPass" type="password" class="form-control" placeholder="Nhập mật khẩu cũ" value=""></div>
                    <div class="col-md-12"><label class="labels">Mật khẩu mới</label><input name="newPass"type="password" class="form-control" placeholder="Nhập mật khẩu mới" value=""></div>
                    <div class="col-md-12"><label class="labels">Xác nhận MK mới</label><input name="newPass_confirm" type="password" class="form-control" placeholder="Nhập mật khẩu mới" value=""></div>
                </div>
                <?php
                            if (!empty($error1)) {
                                echo "<div class='alert alert-danger' style= 'text-align:center;'>$error1</div>";
                            }
                    ?>
                <?php
                    if(!$check1)
                        ?>
                        <div class="mt-2 text-center"><button class="btn btn-success float-right">Thay đổi mật khẩu</button></div>
                    <?php
                    if($check1)
                        echo "<div class='alert alert-success' style= 'text-align:center;'>$infor</div>";
                ?>

            </form>
        </div>
        
    </div>
</div>
</body>