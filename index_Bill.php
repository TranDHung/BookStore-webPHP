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
  </style>
  <script type="text/javascript">
    function submitBill() {
      document.getElementById("formBill").submit();
    }
  </script>
  <?php
  $error1 = '';
  $user = $_SESSION['user'];
  if(isset($_POST['mua'])){
    //echo 'd??asfasfasfa';
  //}
  //if(isset($_POST['ten']) &&  isset($_POST['sdt']) && isset($_POST['tinh']) && isset($_POST['huyen']) && isset($_POST['xa']) && isset($_POST['diachi'])){
        $mahd = random_string();
        $ten =$_POST['ten'];
        $sdt = $_POST['sdt'];
        $tinh = $_POST['tinh'];
        $huyen = $_POST['huyen'];
        $xa = $_POST['xa'];
        $diachi = $_POST['diachi'];

        if (empty($ten)) {
            $error1 = 'Nh???p h??? t??n ?????y ?????';
        }
        else if (empty($sdt)) {
            $error1 = 'Nh???p s??? ??i???n tho???i';
        }
        else if (empty($tinh)) {
            $error1 = 'Nh???p t???nh/th??nh ph???';
        }
        else if (empty($huyen)) {
            $error1 = 'Nh???p huy???n/qu???n';
        }
        else if (empty($xa)) {
            $error1 = 'Nh???p x??/ph?????ng';
        }
        else if (empty($diachi)) {
            $error1 = 'Nh???p ??i??? ch??? chi ti???t';
        }
        else {
            // change password
          $tongtien = $_SESSION['tongTT'];
          addBill($mahd,$user,$ten,$sdt,$tinh,$huyen,$xa,$diachi,$tongtien);
          $_SESSION['mahd'] = $mahd;
          //echo $_SESSION['mahd'];
          header('Location: detail_Bill.php');
        }
    }
    ?>
</head>

<body>
	<nav class="navbar navbar-expand-sm bg-warning navbar-infor">
    <a href="index_login.php" class="navbar-brand"><img src="bookstoreicon.png" class="float-left" width="45px" height="45px"></a>
    <a class="navbar-brand" href="index_login.php"><h3 style="color:white; margin-top: 1px">C???A H??NG S??CH HUY HO??NG</h3></a>

      <ul class="navbar-nav" style="padding-left: 450px; font-size: 20px">
        <?php
            $tp = $_SESSION['type'];
            if($tp == 2){
                ?>
          <li class="nav-item">
            <a class="nav-link" href="#"><i id="noti" class="fa fa-bell" style="font-size:35px;color:red;"></i><div class="shop1">Th??ng b??o</div></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="index_cart.php"><i class="fa fa-shopping-cart" style="font-size:35px;color:red;padding-left: 15px"></i><div class="shop2">Gi??? h??ng</div></a>
          </li>
          <?php
            }else{
                ?>
                    <li class="nav-item">
                    <a href="index_manager.php" class="navbar-brand"><i class = "management"><img src="management.png"  width="55px" height="55px" style="padding-left: 15px"></i><div class="shop4">Qu???n L??</div></a>
                  </li>
                <?php
                }
            ?>
          <li class="nav-item">
            <a class="nav-link" href="edit_profile.php"><i class='fas fa-user-edit' style='font-size:35px;color: white;padding-left: 35px'></i><div class="shop3">H??? s?? c?? nh??n</div></a></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="logout.php" style="margin-top: 2px;padding-left: 50px">????ng xu???t</a>
          </li>
        </ul>
    </nav>
  <form method="post" id="formBill">
    <div class="customer-info">
    <div class="title-info" style="margin-left: 100px; margin-top: 20px;">
      ?????a ch??? giao h??ng
    </div><hr class="short-line">
    <div class="field">
      <span>H??? v?? T??n:</span>
      <input class="form-control" type="text" name="ten">
    </div>
    <div class="field">
      <span>S??? ??i???n tho???i:</span>
      <input class="form-control" type="text" name="sdt">
    </div>
    <div class="field">
      <span>T???nh/Th??nh ph???:</span>
      <input class="form-control" type="text" name="tinh">
    </div>
    <div class="field">
      <span>Qu???n/Huy???n:</span>
      <input class="form-control" type="text" name="huyen">
    </div>
    <div class="field">
      <span>Ph?????ng/X??:</span>
      <input class="form-control" type="text" name="xa">
    </div>
    <div class="field">
      <span>?????a ch??? nh???n:</span>
      <input class="form-control" type="text" name="diachi">
    </div>
    <?php
        if (!empty($error1)) {
            echo "<div style = 'width: 440px;background-color:#F78181;border-radius:4px 4px 4px 4px; margin-left:100px;'>$error1</div>";
        }
    ?>
  </div>
</form>
  <hr>
  <div class="title-cart" style="margin-left: 100px;">
    Ki???m tra l???i gi??? h??ng
  </div>
  <hr class="short-line">
 <?php
          $tongTT = 0;
          $user = $_SESSION['user'];
          $result = getBookFromCart($user);
            if ($result->num_rows > 0) {

              while($row = $result->fetch_assoc()) {
                $result1 = getBookCart($row['masach']);
                if ($result1->num_rows > 0) {

                    while($row1 = $result1->fetch_assoc()) {
                        $gia = product_price($row1['giasach']);
                        $tong = product_price($row1['giasach'] * $row['soluong']);
                        $tongTT = $tongTT + ($row1['giasach'] * $row['soluong']);
                        ?>
    
    <div class="product-in-cart">
    <div class="div-of-unit">
      <div class="unit-in-cart">
        <img class="img-product-in-cart"src="bookImage/<?= $row1['anh'] ?>">
        <div class="title-product-in-cart" style="padding-top: 60px; padding-left: 10px;"><?= $row1['tensach'] ?></div>
        <div class="price-book-in-cart" style="padding-top: 60px"><?= $gia?>??</div>
        <div class="quantity-in-cart" style="padding-top: 60px"><?= $row['soluong'] ?></div>
        <div class="price-product-in-cart" style="padding-top: 60px"><?= $tong ?>??</div>
        <br>
      </div>
    </div>
  </div>
      <?php
    }
  }
}
}
$_SESSION['tongTT'] = $tongTT;
?>
<form>
  <div class="confirm-payment">
    <div class="div-of-total">
      <div class="total-bill">
        T???ng s??? ti???n: 
      </div>
      <div class="price-total-in-cart"><?= product_price($tongTT) ?>??</div>
      <button form="formBill" class="confirm-btn" type="submit" name="mua" value="<?=$tongTT ?>">X??C NH???N THANH TO??N</button>
    </div>
  </div>
  </form>
</body>
</html>