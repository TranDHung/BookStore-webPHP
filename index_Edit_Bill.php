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
    .table{
      background: white;
      text-align: center;
      width: 1250px;
      border-radius: 7px;
      margin: 20px;
      padding-bottom: 3px;
      float: left;
    }
    .row-header{
      background: #58ACFA;
      border-top-right-radius: 7px;
      border-top-left-radius: 7px;
      color: white;
    }
    .cell{
      display: table-cell;
      padding: 15px;
      width: 200px;
    }
    .cell-icon{
      display: table-cell;
      padding: 15px;
      width: 50px;
    }
    .row{
      display: table-row;
    }
    .row hr{
      padding: 0px;
      margin: 0px;
    }
    .circle {
      margin-top: 35px;
      width: 50px;
      height: 50px;
      line-height: 50px;
      border-radius: 50%;
      font-size: 25px;
      background: white;
      float: left;
    }
    .fa-plus{
      padding-top: 12px;
      color: #58ACFA;
    }
    .circle:hover{
      width: 51px;
      height: 51px;
      box-shadow: 1px 2px gray;
    }
  </style>
  <script type="text/javascript">
  </script>
  <?php
    //$user = $_SESSION['user'];
    //$result = getBookInfor($user);
    if(isset($_POST['deleteConfirm'])) {
        $mahd = $_POST['deleteConfirm'];
        deleteBill($mahd);
        header('Location: index_Edit_Bill.php');
    }
    if(isset($_POST['editConfirm'])) {
        //$us = $_POST['editConfirm'];
        $_SESSION['mahd'] = $_POST['editConfirm'];
        header('Location: edit_Bill.php');
    }
  ?>
</head>

<body>
  <nav class="navbar navbar-expand-sm navbar-infor">
    <a href="index_login.php" class="navbar-brand"><img src="bookstoreicon.png" class="float-left" width="45px" height="45px"></a>
    <a class="navbar-brand" href="index_login.php"><h3 style="color:white; margin-top: 1px">C???A H??NG S??CH HUY HO??NG</h3></a>
    <ul class="navbar-nav" style="padding-left: 500px; font-size: 20px">
   
                    <li class="nav-item">
                    <a href="index_manager.php" class="navbar-brand"><i class = "management"><img src="management.png"  width="55px" height="55px" style="padding-left: 15px"></i><div class="shop4">Qu???n L??</div></a>
                  </li>
          <li class="nav-item">
            <a class="nav-link" href="edit_profile.php"><i class='fas fa-user-edit' style='font-size:35px;color: white;padding-left: 35px'></i><div class="shop3">H??? s?? c?? nh??n</div></a></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="logout.php" style="margin-top: 5px;padding-left: 60px; color:white;">????ng xu???t</a>
          </li>
        </ul>
    </nav>
    <div class="table">
  <div class="row-header">
    <div class="cell">S??? h??a ????n</div>
    <div class="cell">H??? t??n kh??ch h??ng</div>
    <div class="cell">S??? ??i???n tho???i</div>
    <div class="cell">T???nh/Th??nh ph???</div>
    <div class="cell">Huy???n/Qu???n</div>
    <div class="cell">X??/Ph?????ng</div>
    <div class="cell">?????a ch???</div>
    <div class="cell-icon"></div>
    <div class="cell-icon"></div>
  </div>
  <div class="row">
  <?php
  $mahd = '';
    $result = getBill();
        if ($result->num_rows > 0) {

          while($row = $result->fetch_assoc()) {
              //$name = $row['tendangnhap'];
              if($mahd == $row['mahd']){}
              else{

              $mahd = $row['mahd'];
            ?>
    <form method="post" id="form" action="">
    <div class="row-content">
    <div class="cell"><?= $row['mahd'] ?></div>
    <div class="cell"><?= $row['tenkh'] ?></div>
    <div class="cell"><?= $row['sdt'] ?></div>
    <div class="cell"><?= $row['tinh'] ?></div>
    <div class="cell"><?= $row['huyen'] ?></div>
    <div class="cell"><?= $row['xa'] ?></div>
    <div class="cell"><?= $row['diachi'] ?></div>
    <div class="cell-icon"><button type="submit" style="background-color:white; border: none;" name="editConfirm" value="<?= $row['mahd'] ?>"><span class="fa fa-wrench"></span></button></div>
    <div class="cell-icon"><button onclick="return confirm('B???n c?? ch???c ch???n mu???n x??a?')" type="submit" style="background-color:white; border: none;" name="deleteConfirm" value="<?= $row['mahd'] ?>"><span class="fa fa-close" style="color: red"></span></button></div>
  </div>
  
  </form>
  <hr>
      <?php
    }
    }
  }
?>


  </div>
</div>

</body>
</html>