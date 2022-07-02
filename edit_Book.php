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
      padding-bottom: 20px;
      padding-right: 10px;
      margin-bottom: 20px;
    }
    .field span{
      float: left;
      padding-top: 17px;
      margin-top: -10px;

    }
    .form-create{
      width: 500px;
      height: 560px;
      background: white;
      border-radius: 25px;
      padding-left: 20px;
      padding-top: 10px;
      margin: auto;
      margin-top: 15px;
    }
    .text-create{
      font-size: 30px;
      font-weight: bold;
      background: #2E64FE;
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
      margin-bottom: -20px;
      float: right;
      width: 300px;
      height: 30px;
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
      $masach = $_SESSION['masach'];
      $result = getDetailBookInfor($masach);
      $anh = $result['anh'];
      $error1 = '';
    if(isset($_POST['ma']) && isset($_POST['ten']) &&  isset($_POST['gia']) && isset($_POST['nxb']) && isset($_POST['ncc']) && isset($_POST['vitri']) && isset($_POST['anh']) && isset($_POST['bia']) && isset($_POST['tacgia'])) {

        $ma = $_POST['ma'];
        $ten =$_POST['ten'];
        $gia = $_POST['gia'];
        $nxb = $_POST['nxb'];
        $ncc = $_POST['ncc'];
        $vitri = $_POST['vitri'];
        if(!empty($_POST['anh'])){
            $anh = $_POST['anh'];
        }
        $bia = $_POST['bia'];
        $tacgia = $_POST['tacgia'];

        if (empty($ten )) {
            $error1 = 'Nhập tên sách';
        }
        else if (empty($gia)) {
            $error1 = 'Nhập giá sách';
        }
        else if (empty($nxb)) {
            $error1 = 'Nhập thông tin nhà xuất bản';
        }
        else if (empty($ncc)) {
            $error1 = 'Nhập thông tin nhà cung cấp';
        }
        else if (empty($vitri)) {
            $error1 = 'Nhập ví trí';
        }
        else if (empty($bia)) {
            $error1 = 'Nhập thông tin loại bìa';
        }
        else if (empty($tacgia)) {
            $error1 = 'Nhập thông tin tác giả';
        }
        //echo $anh;
        //echo $ten;
        else {
            // change password
            $result = editBookInfor($ma,$ten,$gia,$nxb,$ncc,$vitri,$anh,$bia,$tacgia);
           if ($result['code'] == 0){
              $check1 = true;
               $infor = 'Sửa thông tin thành công';
               header('Location: index_Edit_Book.php');
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
    <div class="text-create">Sửa sách</div>
    <div class="field" style="margin-top: 30px;">
      <span>Mã sách: </span>
      <input type="text" name="ma" class="form-control" value="<?= $result['masach'] ?>" readonly>
    </div>
    <div class="field">
      <span>Tên sách: </span>
      <input type="text" name="ten" class="form-control" value="<?= $result['tensach'] ?>">
    </div>
    <div class="field">
      <span>Giá sách: </span>
      <input type="text" name="gia" class="form-control" value="<?= $result['giasach'] ?>">
    </div>
    <div class="field">
      <span>Nhà xuất bản: </span>
      <input type="text" name="nxb" class="form-control" value="<?= $result['nxb'] ?>"> 
    </div>
    <div class="field">
      <span>Nhà cung cấp: </span>
      <input type="text" name="ncc" class="form-control" value="<?= $result['nhacungcap'] ?>">
    </div>
    <div class="field">
      <span>Vị trí: </span>
      <input type="text" name="vitri" class="form-control" value="<?= $result['vitri'] ?>">
    </div>
    <div class="field">
      <span>Ảnh: </span>
      <input name="anh" value = "<?= $anh ?>" id="picture" type="file" style="padding-left: 90px; ">
    </div>
    <div class="field">
      <span>Hình thức bìa: </span>
      <input type="text" name="bia" class="form-control" value="<?= $result['hinhthucbia'] ?>">
    </div>
    <div class="field">
      <span>Tác giả: </span>
      <input type="text" name="tacgia" class="form-control" value="<?= $result['tacgia'] ?>">
    </div>
    <?php
        if (!empty($error1)) {
            echo "<div style = 'width: 440px;background-color:#F78181;border-radius:4px 4px 4px 4px'>$error1</div>";
        }
    ?>
    <div style="padding-top: 10px;">
    <a href="index_Edit_Book.php" style="float: left; padding-top: 10px;">Quay lại</a>
    <button class="create-btn" type="submit" name="update">Cập nhật</button>
    <button class="return-btn">Reset</button>
  </div>
  </form>
    
    </body>
</html>