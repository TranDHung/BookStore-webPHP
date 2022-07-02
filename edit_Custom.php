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
      background: #F2F2F2;
    }
    .navbar-expand-sm{
      background-color: #58ACFA;
    }
    .field{
      padding-bottom: 28px;
      padding-right: 10px;
      margin-bottom: 25px;
    }
    .field span{
      float: left;
      padding-top: 17px;
      margin-top: -10px;

    }
    .form-create{
      width: 500px;
      height: 502px;
      background: white;
      border-radius: 25px;
      padding-left: 20px;
      padding-top: 20px;
      margin: auto;
      margin-top: 20px;
    }
    .text-create{
      font-size: 30px;
      font-weight: bold;
      background: #58ACFA;
      margin-left: -20px;
      margin-top: -20px;
      padding: 10px;
      padding-left: 20px;
      border-top-left-radius: 25px;
      border-top-right-radius: 25px;
      color: white;
    }
    .form-control{
      border-radius: 5px;
      margin-right: 25px;
      margin-bottom: -10px;
      float: right;
      width: 300px;
    }
    .create-btn, .return-btn{
      margin-left: 148px;
      background: #2E64FE;
      color: white;
      height: 40px;
      border-radius: 7px;
      border: none;
    }
    .return-btn{
      background: lightgray;
      margin-left: 8px;
      color: black;
      width: 90px;
    }
    .form-control:focus {
    box-shadow: 1px;
    border-color: #01A9DB;
  }
  </style>
  <?php
    $manv = $_SESSION['manv'];
    $result = getDetailCustom($manv);

    $error1 = '';
    if(isset($_POST['manv']) &&  isset($_POST['tennv']) && isset($_POST['gioitinh']) && isset($_POST['ngaysinh']) && isset($_POST['vitri']) && isset($_POST['chucvu'])){

        $ma =$_POST['manv'];
        $ten = $_POST['tennv'];
        $gioi = $_POST['gioitinh'];
        $ngays = $_POST['ngaysinh'];
        $vitri = $_POST['vitri'];
        $chucvu = $_POST['chucvu'];

        if (empty($ten )) {
            $error1 = 'Nhập họ tên đầy đủ';
        }
        else if (empty($ngays)) {
            $error1 = 'Nhập ngày sinh';
        }
        else if (empty($gioi)) {
            $error1 = 'Nhập thông tin giới tính';
        }
        else if (empty($vitri)) {
            $error1 = 'Nhập vị trí nhân viên';
        }
        else if (empty($chucvu)) {
            $error1 = 'Nhập chức vụ nhân viên';
        }
        else {
            // change password
            $result = editCustom($ma,$ten,$gioi,$ngays,$vitri,$chucvu);
           if ($result['code'] == 0){
               $infor = 'Sửa thông tin thành công';
               header('Location: index_Edit_Custom.php');
           }else{
               $infor = 'Xảy ra lỗi. Vui lòng thử lại sau';
           }
        }
    }
    ?>
  </head>

<body>
  <nav class="navbar navbar-expand-sm navbar-infor">
    <a href="index_login.php" class="navbar-brand"><img src="bookstoreicon.png" class="float-left" width="45px" height="45px"></a>
    <a class="navbar-brand" href="index_login.php"><h3 style="color:white; margin-top: 1px">CỬA HÀNG SÁCH HUY HOÀNG</h3></a>
    <ul class="navbar-nav" style="padding-left: 500px; font-size: 20px">
   
                    <li class="nav-item">
                    <a href="index_manager.php" class="navbar-brand"><i class = "management"><img src="management.png"  width="55px" height="55px" style="padding-left: 15px"></i><div class="shop4">Quản Lý</div></a>
                  </li>
          <li class="nav-item">
            <a class="nav-link" href="edit_profile.php"><i class='fas fa-user-edit' style='font-size:35px;color: white;padding-left: 35px'></i><div class="shop3">Hồ sơ cá nhân</div></a></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="logout.php" style="margin-top: 5px;padding-left: 60px; color:white;">Đăng xuất</a>
          </li>
        </ul>
    </nav>

    <form class="form-create" method="post">
    <div class="text-create">Sửa nhân viên</div>
    <div class="field" style="margin-top: 30px;">
      <span>Mã nhân viên: </span>
      <input type="text" name="manv" class="form-control" value="<?= $result['manv'] ?>" readonly>
    </div>
    <div class="field">
      <span>Tên nhân viên: </span>
      <input type="text" name="tennv" class="form-control" value="<?= $result['tennv'] ?>">
    </div>
    <div class="field">
      <span>Giới tính: </span>
      <input type="text" name="gioitinh" class="form-control" value="<?= $result['gioitinh'] ?>">
    </div>
    <div class="field">
      <span>Ngày sinh: </span>
      <input type="date" name="ngaysinh" class="form-control" value="<?= $result['ngaysinh'] ?>">
    </div>
    <div class="field">
      <span>Vị trí: </span>
      <input type="text" name="vitri" class="form-control" value="<?= $result['vitri'] ?>">
    </div>
    <div class="field">
      <span>Chức vụ: </span>
      <input type="text" name="chucvu" class="form-control" value="<?= $result['chucvu'] ?>">
    </div>
    <?php
        if (!empty($error1)) {
            echo "<div style = 'width: 440px;background-color:#F78181;border-radius:4px 4px 4px 4px'>$error1</div>";
        }
    ?>
    <div style="padding-top: 10px;">
    <a href="index_Edit_Custom.php" style="float: left; padding-top: 10px;">Quay lại</a>
    <button class="create-btn" type="submit" name="update">Cập nhật</button>
    <button class="return-btn">Reset</button>
  </div>
  </form>

</body>
</html>