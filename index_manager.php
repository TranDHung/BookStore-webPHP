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
  <style type="text/css" href="style.css">
    body{
        font-family: Helvetica, sans-serif;
        margin: 0;
        padding: 0;
        text-align: center;
        background: lightgray;
    }
    .row-management{
      display: table-cell;
      padding-left: 30px;
      padding-top: 10px;
      text-align: center;
      align-content: center;
    }
    .row-content{
      width: 600px;
      height: 250px;
      margin: 15px;
      border-radius: 120px;
      background: white;
    }
    .row-content:hover{
      box-shadow: 3px 3px 2px gray;
      background: #EFFBFB;
    }
    .row-content:hover .icon{
      margin-left: -180px; 
    }
    .row-content:hover .animation-text{
      visibility: visible;
      opacity: 1;
    }
    .icon{
      padding-top: 50px;
      margin-bottom: -30px;
      font-size: 130px;
      margin-left: 0px;
      transition: margin-left 0.4s; 
    }
    .animation-text{
      float: right;
      color: black;
      font-size: 30px;
      padding-top: 30px;
      margin-left: -300px;
      margin-right: 130px;
      width: 142px;
      visibility: hidden;
      opacity: 0;
      font-weight: bold;
      transition: visibility 0s, opacity 1.3s;
    }
    .quantity{
      font-weight: bold;
      font-size: 30px;
      color: black;
      padding-top: 40px;
    }
    .navbar-expand-sm{
      background-color: #58ACFA;
    }

  </style>
  <?php
    //$user = $_SESSION['user'];
    //$result = getBookInfor($user);
    $vitri = '';
    $type =  $_SESSION['type'];
    //echo $type;
   if($type == 1){
      $vitri = $_SESSION['vitri'];
   }
   elseif($type == 3){
    $vitri = 1;
   }
   elseif($type == 4){
      $vitri = 2;
    }

    if($type)
    $countA = countNumberAccount($type);
    $countB = countNumberBook($type,$vitri);
    $countC = countNumberCustom($type,$vitri);
    $_SESSION['vitri'] = $vitri;

    $countD = -1;
    $mahd = '';
    $result = getBill();
    if ($result->num_rows > 0) {

      while($row = $result->fetch_assoc()) {
          //$name = $row['tendangnhap'];
          if($mahd == $row['mahd']){}
          else{
          $countD = $countD+1;
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

  <div class="row-management">
    <div class="row-content">
      <a href="index_Edit_User.php">
        <div class="icon">
                <span class="fas fa-user-circle"></span>
                <h1 class="animation-text">Quản lý tài khoản</h1>
        </div>
      </a>
      <div class="quantity"><?= $countA ?> Tài khoản</div>
    </div>
    <div class="row-content">
      <a href="index_Edit_Book.php">
        <div class="icon">
                <span class="fas fa-book"></span>
                <h1 class="animation-text">Quản lý sách</h1>
        </div>
      </a>
      <div class="quantity"><?= $countB ?> Sách</div>
    </div>
  </div>
  <div class="row-management">
    <div class="row-content">
      <a href="index_Edit_Bill.php">
        <div class="icon">
                <span class="fas fa-money-check-alt"></span>
                <h1 class="animation-text">Quản lý hóa đơn</h1>
        </div>
      </a>
      <div class="quantity"><?= $countD?> Hóa đơn</div>
    </div>
    <div class="row-content">
      <a href="index_Edit_Custom.php">
        <div class="icon">
                <span class="fas fa-user-tie"></span>
                <h1 class="animation-text">Quản lý nhân viên</h1> 
        </div>
      </a>
      <div class="quantity"><?= $countC ?> Nhân viên</div>
    </div>
  </div>
</body>
</html>