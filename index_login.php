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
      background-color: #F2F2F2;
    }
    .shop-btn{
        background: #F2F2F2;
    }
    .shop{
            width: 450px;
            height: 350px;
            margin-top: 100px;
            position: relative;
            margin-left: 12%;
            float: left;
        }
        .shop-img{
            width: 440px;
            height: 349px;
        }
        .overlay {
          position: absolute;
          margin-left: 5px;
          bottom: 0;
          left: 0;
          right: 0;
          background-color: #008CBA;
          overflow: hidden;
          width: 430px;
          height: 0;
          opacity: 0.7;
          transition: .5s ease;
        }
        .shop:hover .overlay {
          height: 350px;
          width: 440px;
        }

        .text {
          color: white;
          font-weight: bold;
          font-size: 16px;
          position: absolute;
          top: 50%;
          left: 50%;
          -webkit-transform: translate(-50%, -50%);
          -ms-transform: translate(-50%, -50%);
          transform: translate(-50%, -50%);
          text-align: center;
        }
        .line span{
          background: #F2F2F2;
        }
  </style>
  <?php
    //$user = $_SESSION['user'];
    //$result = getBookInfor($user);
  if (isset($_POST['book'])){
    $_SESSION['masach'] = $_POST['book'];
    header('Location: index_book.php');
  }
  if(isset($_POST['store1'])){
    $_SESSION['vitri'] = $_POST['store1'];
    header('Location: index_manager.php');
  }
  if(isset($_POST['store2'])){
    $_SESSION['vitri'] = $_POST['store2'];
    header('Location: index_manager.php');
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
    <?php
    $tp = $_SESSION['type'];
        if($tp == 1){
    ?>
    <form method="post">
    <div class="list-shop">
    <div class="shop">
        <button class="shop-btn" type="submit" style="border: none;" name="store1" value="1">
            <img class="shop-img" src="https://theme.hstatic.net/200000017360/1000606256/14/store_img_2.png?v=120">
            <div class="overlay">
                <div class="text"><p>Địa chỉ: A17 Tạ Quang Bửu, Bách Khoa, Hai Bà Trưng, Hà Nội</p><br><p>Liên hệ: 0243.736.5958</p></div>
            </div>
        </button>
    </div>
    <div class="shop">
       <button class="shop-btn" type="submit" style="border: none;" name="store2" value="2">
            <img class="shop-img" src="https://theme.hstatic.net/200000017360/1000606256/14/store_img_1.png?v=120">
            <div class="overlay" style="background: #04B404">
                <div class="text"><p>Địa chỉ: 357A Lê Văn Sỹ, Phường 1, Quận Tân Bình, TP.HCM</p><br><p>Liên hệ: 0283.991.3636</p></div>
            </div>
        </button>
    </div>
</div>
</form>
    <?php
        }else{
            ?>
    <div id="slideshow">
  <div class="slide-wrapper">
    <div class="slide"><img class = "img" src="https://wallpaperaccess.com/full/922681.jpg"></div>
    <div class="slide"><img class = "img" src="https://wallpaperaccess.com/full/922661.jpg"></div>
    <div class="slide"><img class = "img" src="https://images.unsplash.com/photo-1507842217343-583bb7270b66?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxleHBsb3JlLWZlZWR8Mnx8fGVufDB8fHx8&w=1000&q=80"></div>
    <div class="slide"><img class = "img" src="https://cdn.concreteplayground.com/content/uploads/2014/08/Ampersand-cafe_5_supplied.jpg"></div>
    <div class="slide"><img class = "img" src="https://images.squarespace-cdn.com/content/v1/5db3e7736420426c4887b285/1572956120163-2ZK29DL317JWL7D44U3O/ke17ZwdGBToddI8pDm48kIazNX5WCIxa6KfsgxATnCh7gQa3H78H3Y0txjaiv_0fDoOvxcdMmMKkDsyUqMSsMWxHk725yiiHCCLfrh8O1z5QPOohDIaIeljMHgDF5CVlOqpeNLcJ80NK65_fV7S1Uf1HSLJBB7PG4oxigkCpZGDr7TDW4kGc_b3WE7iqShcAnEc_74TPHgCoAez_i3HsLQ/13585032_10154397964924604_5223958515764989457_o.jpg"></div>
  </div>
</div>

<section>
  <div class="container">
    <h2 class="line"><span>BOOKS</span></h2>
  </div>
  <ul id = "product-grid" class = "product-grid fhs-top" style="list-style-type:none;">
    <?php
      $result = getBookInfor();
        if ($result->num_rows > 0) {

          while($row = $result->fetch_assoc()) {
            $price = $row['giasach'];
            $gia = product_price($price);
            ?>
          <form method="post" id="form">
        <li>
          <button type="submit" style="background-color:white; border: none; " name="book" value = "<?= $row['masach']?>">
            <div class = "item-inner">
                <div class = "ma-box-content">
                    <div class = "product clearfix">
                        <div class = "product image-container">
                            <a href = "#" class = "product-image" type="submit">
                                <span class = "product-image">
                                    <img class=" lazyloaded" src="bookImage/<?= $row['anh']?>"width="200" height="200">   
                                </span>
                                
                            </a>
                        </div>
                    </div>
                    <h2 class = "product-names p-name-list">
                        <a href="" title="" id="tensach"><span><?= $row['tensach'] ?></span></a>
                    </h2>
                    
                    <div class = "price-label">
                        <span id = "product-price-11111" class>
                                <span class="price"><?= $gia ?>&nbsp;đ</span>
                        </span>
                    </div>
                </div>
            </div>
          </button>
        </li>
        </form>
        <?php
        }
      }
      ?>

        
    </ul>
  
     
</section>

<footer>
  <span style="color:white;">
    Made by group 31
  </span>
</footer>
<?php
}
?>
</body>
</html>