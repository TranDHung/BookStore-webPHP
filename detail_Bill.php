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
      padding-left: 80px;
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
  </style>
  <script type="text/javascript">
    function submitBill() {
      document.getElementById("formBill").submit();
    }
  </script>
  
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
    <?php
          //$ma = $_SESSION['mahd'];
          $result1 = getDetailBillInfor($_SESSION['mahd']);
          if ($result1->num_rows > 0) {

              while($row1 = $result1->fetch_assoc()) {
                $tenkh = $row1['tenkh'];
                $sdt = $row1['sdt'];
                $tinh = $row1['tinh'];
                $huyen = $row1['huyen'];
                $xa = $row1['xa'];
                $diachi = $row1['diachi'];
                //echo $tenkh;
                //break;
              }
            }
          ?>
  <form method="post" id="formBill">
    <div class="customer-info">
    <div class="title-info" style="margin-left: 100px; margin-top: 20px;">
      Địa chỉ giao hàng
    </div><hr class="short-line">
    <div class="field">
      Họ và Tên: <?= $tenkh ?>
    </div>
    <div class="field">
      Số điện thoại: <?= $sdt ?>
    </div>
    <div class="field">
      Tỉnh/Thành phố: <?= $tinh ?>
    </div>
    <div class="field">
      Quận/Huyện: <?= $huyen ?>
    </div>
    <div class="field">
      Phường/Xã: <?= $xa ?>
    </div>
    <div class="field">
      Địa chỉ nhận: <?= $diachi ?>
    </div>
</div>
</form>
  <hr>
  <div class="title-cart" style="margin-left: 100px;">
    Mặt hàng
  </div>
  <hr class="short-line">
 <?php
          $mahd = $_SESSION['mahd'];
          $user = $_SESSION['user'];
          $result = getDetailBill($mahd,$user);
            if ($result->num_rows > 0) {

              while($row = $result->fetch_assoc()) {
                $result1 = getBookFromCart($user);
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
      <div class="price-total-in-cart"><?= product_price($_SESSION['tongTT']) ?>đ</div>
    </div>
  </div>
  </form>
</body>
</html>