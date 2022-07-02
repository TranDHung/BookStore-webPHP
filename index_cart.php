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
    body{
      background: #F2F2F2;
    }
    form{
      display: inline;
    }
    .empty-cart{
      text-align: center;
    }
    .empty-cart-text{
      padding-top: 35px;
      font-size: 35px;
      color: #585858;
    }
    .div-of-empty{
      margin: auto;
      padding-top: 30px;
      border-radius: 8px;
      background: white;
      width: 1300px;
      height: 550px;
    }
    .cart-empty-image{
      height: 400px;
      width: 800px;
    }
  </style>
  <?php
    
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
 
    
    <?php
     $user = $_SESSION['user'];
      $re = getBookFromCart($user);
      if ($re->num_rows > 0) {
        ?>
        <br><h2 class="line"><span style="background-color: #F2F2F2;">GIỎ HÀNG</span></h2><br>
  <div class="div-of-form">
  

    <div class="card-ui-content row">
      <div>
        <div class="product-cart-left">
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
                    if (isset($_POST['plus'])){
                      $maS = $_POST['plus'];
                      $sl = $_POST['input'];
                      //echo "          n".$sl;
                      updatePNumber($user, $maS, $sl);
                      header('Location: index_cart.php');
                    }
                    if (isset($_POST['minus'])){
                      $maS = $_POST['minus'];
                      $sl = $_POST['input'];
                      updateMNumber($user, $maS, $sl);
                      header('Location: index_cart.php');
                    }
                    if (isset($_POST['remove'])){
                      $maS = $_POST['remove'];
                      deleteItem($user, $maS);
                      header('Location: index_cart.php');
                    }
                    if (isset($_POST['thanhtoan'])){
                      header('Location: index_Bill.php');
                    }
              ?>
          <form action="" method="post">
          <div class="item-product-cart">
            <div class="div-of-btn-remove-cart">
              <a class="btn-remove-cart" type="submit" href=""><button name = "remove" value = "<?= $row['masach']?>" class="fa fa-close" style="font-size:24px; color:red; background-color:white; border: none;"></button></a>
            </div>
            <div class="img-product-cart">
              <a class="product-image" href=""><img src="bookImage/<?= $row1['anh'] ?>" width="150px" height="150px"></a>
            </div>
            <div class="group-product-info">
              <div class="info-product-cart">
                <h4 class="product-name" ><?= $row1['tensach'] ?></h4>
                <span class="price" style="font-weight: bold; font-size: 20px"><?= $gia?>đ</span>
              </div>
              <div class="number-product-cart">
                <div class="product-quantity">
                  <button class="fa fa-minus" style="background-color:white; border: none;" name="minus" value = "<?= $row['masach']?>"></button>
                  <input name="input" class="quantity" style="width: 30px; height: 20px; text-align: center;" type="text" value="<?= $row['soluong'] ?>">
                  <button class="fa fa-plus" style="background-color:white; border: none;" name="plus" value = "<?= $row['masach']?>"></button>
                </div>
                <div class="cart-price">
                  <br>
                  <span class="text-price-total">Thành tiền:</span><br>
                  <span class="total-price" style="font-weight: bold; color: orange; font-size: 25px"><?= $tong ?></span>
                </div>
              </div>
            </div>
          </div>
        
        <?php
        }
      }
      }
    }
      ?>
          <!--  -->
          
          <!-- -->
        </div><br>
      </div>
    </div>

    <div class="block-total-cart">
      <div class="total-cart-page" style="font-size: 25px;">
        Tổng số tiền là: 
      </div><br>
      <div class="number-cart-page">
        <span class="price" style="color: orange; font-size: 50px"><?= product_price($tongTT) ?></span>
      </div>
      <button class="checkout-btn" type="submit" name="thanhtoan">THANH TOÁN</button>
    </div>
  </div>
  </form>
  <?php
  }else{
    ?>

   <div class="div-of-empty" >
      <div class="empty-cart">
        <img class="cart-empty-image" src="emptyCart.png">
        <p class="empty-cart-text">Chưa có sản phẩm nào trong giỏ hàng</p>  
      </div>
    </div><br>
    <?php
  }
  ?>
</body>