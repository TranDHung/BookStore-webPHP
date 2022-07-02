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

  <script type="text/javascript">
        function showPlusNumber(){
           var x = parseInt(document.getElementById("input").value);
           if (x<10)
            document.getElementById("input").value = x+1;
            else
                document.getElementById("input").value = 10;
      }

      function showMinusNumber(){
           var x = parseInt(document.getElementById("input").value);
           if (x>1)
            document.getElementById("input").value = x-1;
            else
                document.getElementById("input").value = 1;
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
        $user = $_SESSION['user'];
        $sl = 1;
        $masach =  $_SESSION['masach'];
        $result = getDetailBookInfor($masach);
        $price = $result['giasach'];
        $gia = product_price($price);
        if(isset($_POST['them'])){
            $sl = $_POST['numberInput'];
            addToCart($user, $masach, $sl);
            $_SESSION['tensach'] = $result['tensach'];
            $_SESSION['giasach'] = $gia;
            $_SESSION['anh'] = $result['anh'];
            header('Location: index_cart.php');
        }
        if(isset($_POST['mua'])){
            $sl = $_POST['numberInput'];
            //addToCart($user, $masach, $sl);
            $_SESSION['tensach'] = $result['tensach'];
            $_SESSION['giasach'] = $gia;
            $_SESSION['anh'] = $result['anh'];
            header('Location: index_Bill.php');
        }
    ?>
    <form method = "post">
    <div class = "product-view kaisoo" style="text-align: left;">
        
        <div id = "post" class = "product-media">
            <div class = "product-view-image">
                <div class = "product-view-image-product">
                    <img id="image" class="fhs-p-img" src="bookImage/<?= $result['anh']?>">
                </div>
            </div>
            <div class = "product_view_add_box">
                <button type = "submit" title="Thêm vào giỏ hàng" name="them">
                    <div class="shopping-cart-icon"></div>
                    <span>Thêm vào giỏ hàng</span>
                </button>
                <button type = "submit" title="Mua ngay" name="mua">
                    <span>Mua ngay</span>
                </button>
            </div>
        </div>
     
        <div id = "slidebar" class = "product-detail">
            <h1>
                <div class = "fhs_delivery_label_icon" style="display: none;"></div>
                
                <?= $result['tensach']?>
                
            </h1>
            <div class= "product-view-sa">
                <div class = "product-view-sa-one">
                    <div class = "product-view-sa-supplier">
                        <span>Nhà cung cấp:</span>
                        <span><?= $result['nhacungcap']?></span>
                    </div><br>
                    <div class = "product-view-sa-author" style="margin-left: 0px; padding-top:10px; ">
                        <span>Tác giả:</span>
                        <span><?= $result['tacgia']?></span>
                    </div>
                </div>
                <div class = "product-view-sa-two">
                    <div class = "product-view-sa-NXB">
                        <span>Nhà xuất bản:</span>
                        <span><?= $result['nxb']?></span>
                    </div>
                    <div class = "product-view-sa-bia">
                        <span>Hình thức bìa:</span>
                        <span><?= $result['hinhthucbia']?></span>
                    </div>
                </div>
            </div>
            <div class = "view-rate row">
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star" style="padding-top: 18px;"></span>
            </div>
            <div class = "price-block">
                <span class="price" id="product-price-285358"><?= $gia?>&nbsp;đ</span>
            </div>
            <div class = "expected-deliver">
                <div id = "expected-deliver-address">
                    <div>Thời gian giao hàng</div>
                    <div>
                        <span>Địa điểm giao hàng: </span>
                        <span>Thay đổi</span> 
                    </div>
                </div>
                <div id = "expected-return-product-policy">
                    <div>Chính sách đổi trả</div>
                    <div>
                        <span>Đổi trả sản phẩm trong 30 ngày: </span>
                        <span>Xem thêm</span> 
                    </div>
                </div>
            </div>
            <div id = "catalog-product-detail-number">
                <label id="qty" style="padding-top: 3px;">Số lượng:</label>
                <div id = "product-view-quantity-box-block" class = "rounded">
                    <div class="product-quantity" style="text-align: center; padding-top: 5px;">
                      <a href="#" onclick="showMinusNumber()"><i class="fa fa-minus"></i></a>
                      <input name = 'numberInput' id = "input" class="quantity" style="width: 30px; height: 20px; text-align: center; margin-left: 8px; margin-right: 8px;" type="numeric" value="1">
                      <a href="#" onclick="showPlusNumber()"><i class="fa fa-plus"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class = "clear"></div>
    </div>
</form>
<footer>
  <span style="color:white;">
    CCCCCC
  </span>
</footer>

</body>
</html>