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
  <style type="text/css">
  body {
      font-family: Helvetica, sans-serif;
      margin: 0;
      padding: 0;
      background: #F2F2F2;
    }
    .field{
      padding-bottom: 30px;
      padding-right: 10px;
      margin-bottom: 25px;
    }
    .field span{
      float: left;
      padding-top: 17px;
      margin-top: -10px;
      margin-left: 100px;
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
      margin-right: 800px;
      margin-bottom: -10px;
      float: right;
      width: 300px;
    }
    .short-line{
      width: 1200px;
    }
    .form-control:focus {
    box-shadow: 1px;
    border-color: #01A9DB;
  }
  .img-product-in-cart{
    float: left;
    margin-left: 50px;
    width:150px;
    height: 170px;
  }
  .title-product-in-cart{
    float: left;
    width: 600px;
  }
  .price-book-in-cart{
    float: left;
    padding-left: 100px;
  }
  .quantity-in-cart{
    float: left;
    margin-left: 100px;
  }
  .price-product-in-cart{
    float: left;
    margin-left: 100px;
  }
  .unit-in-cart{
    display: table-row;
  }
  .div-of-unit{
    margin-top: 20px;
    margin-bottom: 15px;
  }
  .confirm-payment{
    width: 350px; 
    background-color: white; 
    z-index: 10; 
    text-align: center;
    position: fixed; 
    border-radius: 20px;
    right: 0; 
    top: 0; 
    height: 200px;
    margin-top: 70px;
    margin-right: 20px;
  }
  .total-bill{
    padding: 20px;
  }
  .price-total-in-cart{
    color: orange;
    font-size: 35px;
  }
  .confirm-btn{
    background: #FE9A2E;
    color: white;
    height: 50px;
    border-radius: 7px;
    border: none;
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
  </style>
  <script type="text/javascript">
    function submitBill() {
      document.getElementById("formBill").submit();
    }
  </script>
  <?php
  $error1 = '';
  $mahd = $_SESSION['mahd'];
  $user = $_SESSION['user'];
  $result = getDetailBillInfor($mahd);
    if ($result->num_rows > 0) {

        while($row1 = $result->fetch_assoc()) {
          $tenkh = $row1['tenkh'];
          $sdt = $row1['sdt'];
          $tinh = $row1['tinh'];
          $huyen = $row1['huyen'];
          $xa = $row1['xa'];
          $diachi = $row1['diachi'];
          $tongTT = $row1['tongtien'];
          //echo $tenkh;
          break;
        }
      }



  if(isset($_POST['update'])){
    //echo 'dàasfasfasfa';
  //}
  //if(isset($_POST['ten']) &&  isset($_POST['sdt']) && isset($_POST['tinh']) && isset($_POST['huyen']) && isset($_POST['xa']) && isset($_POST['diachi'])){
        $mahd = $_SESSION['mahd'];
        $ten =$_POST['ten'];
        $sdt = $_POST['sdt'];
        $tinh = $_POST['tinh'];
        $huyen = $_POST['huyen'];
        $xa = $_POST['xa'];
        $diachi = $_POST['diachi'];

        if (empty($ten)) {
            $error1 = 'Nhập họ tên đầy đủ';
        }
        else if (empty($sdt)) {
            $error1 = 'Nhập số điện thoại';
        }
        else if (empty($tinh)) {
            $error1 = 'Nhập tỉnh/thành phố';
        }
        else if (empty($huyen)) {
            $error1 = 'Nhập huyện/quận';
        }
        else if (empty($xa)) {
            $error1 = 'Nhập xã/phường';
        }
        else if (empty($diachi)) {
            $error1 = 'Nhập điạ chỉ chi tiết';
        }
        else {
            // change password
          $result = editBill($mahd,$ten,$sdt,$tinh,$huyen,$xa,$diachi);
           if ($result['code'] == 0){
               $infor = 'Sửa thông tin thành công';
              header('Location: index_Edit_Bill.php');
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
            <a class="nav-link" href="edit_profile.php"><i class='fas fa-user-edit' style='font-size:35px;color: white;padding-left: 35px'></i><div class="shop3">Hồ sơ cá nhân</div></a></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="logout.php" style="margin-top: 2px;padding-left: 50px">Đăng xuất</a>
          </li>
        </ul>
    </nav>
  <form method="post" id="formBill">
    <div class="customer-info">
    <div class="title-info" style="margin-left: 100px; margin-top: 20px;">
      Địa chỉ giao hàng
    </div><hr class="short-line">
    <div class="field">
      <span>Số hóa đơn:</span>
      <input class="form-control" type="text" name="ten" readonly value = "<?= $mahd ?>">
    </div>
    <div class="field">
      <span>Họ và Tên:</span>
      <input class="form-control" type="text" name="ten" value = "<?= $tenkh ?>">
    </div>
    <div class="field">
      <span>Số điện thoại:</span>
      <input class="form-control" type="text" name="sdt" value = "<?= $sdt ?>">
    </div>
    <div class="field">
      <span>Tỉnh/Thành phố:</span>
      <input class="form-control" type="text" name="tinh" value = "<?= $tinh ?>">
    </div>
    <div class="field">
      <span>Quận/Huyện:</span>
      <input class="form-control" type="text" name="huyen" value = "<?= $huyen ?>">
    </div>
    <div class="field">
      <span>Phường/Xã:</span>
      <input class="form-control" type="text" name="xa" value = "<?= $xa ?>">
    </div>
    <div class="field">
      <span>Địa chỉ nhận:</span>
      <input class="form-control" type="text" name="diachi" value = "<?= $diachi ?>">
    </div>
    <?php
        if (!empty($error1)) {
            echo "<div style = 'text-align: center; width: 440px;background-color:#F78181;border-radius:4px 4px 4px 4px; margin-left:100px;'>$error1</div>";
        }
    ?>
  </div>
  <div style="padding-top: 10px; width: 500px; padding-left: 110px">
    <a href="index_Edit_Bill.php" style="float: left; padding-top: 10px;">Quay lại</a>
    <button class="create-btn" type="submit" name="update">Cập nhật</button>
    <button class="return-btn">Reset</button>
  </div>
</form>
  <hr>
  <div class="title-cart" style="margin-left: 100px;">
    Mặt hàng
  </div>
  <hr class="short-line">
 <?php
          $mahd = $_SESSION['mahd'];
          $result = getDetailBillInfor($mahd);
            if ($result->num_rows > 0) {

              while($row = $result->fetch_assoc()) {
                $result1 = getBookFromCart($row['mauser']);
                if ($result1->num_rows > 0) {

                  while($row1 = $result1->fetch_assoc()) {
                $result2 = getBookCart($row1['masach']);
                if ($result2->num_rows > 0) {

                    while($row2 = $result2->fetch_assoc()) {
                        $gia = product_price($row2['giasach']);
                        $tong = product_price($row2['giasach'] * $row1['soluong']);
                        ?>
    
    <div class="product-in-cart">
    <div class="div-of-unit">
      <div class="unit-in-cart">
        <img class="img-product-in-cart"src="bookImage/<?= $row2['anh'] ?>">
        <div class="title-product-in-cart" style="padding-top: 60px; padding-left: 10px;"><?= $row2['tensach'] ?></div>
        <div class="price-book-in-cart" style="padding-top: 60px"><?= $gia?>đ</div>
        <div class="quantity-in-cart" style="padding-top: 60px"><?= $row1['soluong'] ?></div>
        <div class="price-product-in-cart" style="padding-top: 60px"><?= $tong ?>đ</div>
        <br>
      </div>
    </div>
  </div>
        <?php
      break;
    }

  }
}
}
break;
}
}
?>
<form>
  <div class="confirm-payment">
    <div class="div-of-total">
      <div class="total-bill">
        Tổng số tiền: 
      </div>
      <div class="price-total-in-cart"><?= product_price($tongTT) ?>đ</div>
    </div>
  </div>
  </form>
</body>
</html>