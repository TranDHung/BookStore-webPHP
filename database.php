<link rel="stylesheet" href="style.css">
<?php
	define('HOST','127.0.0.1');
	define('USER','root');
	define('PASS','');
	define('DB','bookstore');
	
	function open_database(){
		$conn = new mysqli(HOST,USER,PASS,DB);
		if ($conn ->connect_error){
			die('Connect error: '.$conn->connect_error);
		}
		return $conn;
		
	}
	
	function login($user, $pass){
		$sql = "select * from user where tendangnhap = ?";
		$conn = open_database();
		
		$stm = $conn->prepare($sql);
		$stm -> bind_param('s',$user);
		if (!$stm -> execute()){
			return array('code' => 1, 'error' => 'Can not execute command');
		}
		$result = $stm->get_result();
		
		if($result->num_rows == 0){
			return array('code' => 1, 'error' => 'User does not exist');
		}
		
		$data = $result->fetch_assoc();
		
		$hashed_password = $data['matkhau'];
		if(!password_verify($pass, $hashed_password)){
			return array('code' => 2, 'error' => 'Invalid password');
		// }else if($data['activated'] == 0){
			// return array('code' => 3, 'error' => 'This account is not activated');
		}else
			return array('code' => 0, 'error' => '','data' => $data);
	}
	
	function register($user,$pass,$full_name,$bdate,$phoneN,$type){
		if(is_username_exists($user)){
			return array('code' => 3, 'error' =>'Tên đăng nhập đã tồn tại');
		}
		$hash = password_hash($pass, PASSWORD_DEFAULT);
		$sql = "insert into user(tendangnhap,matkhau,hoten,ngaysinh,sdt,type) value(?,?,?,?,?,?)";
		$conn = open_database();
		$stm = $conn->prepare($sql);
		$stm->bind_param('sssssi', $user,$hash,$full_name,$bdate,$phoneN,$type);
		if(!$stm->execute()){
			return array('code' => 2, 'error' => 'Can not execute command');
		}
		return array('code' => 0, 'error' => 'Create account successful');
		
	}
	
	function is_username_exists($user){
		$sql = "select hoten from user where tendangnhap = ?";
		$conn = open_database();
		
		$stm = $conn->prepare($sql);
		$stm->bind_param('s',$user);
		
		if (!$stm ->execute()){
			die('Query error: '.$stm->error);
		}
		
		$result = $stm->get_result();
		if($result->num_rows >0){
			return true;
		}
	}
	
	function editProfile($user,$full_name,$bdate,$phoneN){
		$conn = open_database();
		$sql = "UPDATE user SET hoten = '$full_name',ngaysinh='$bdate',sdt = '$phoneN' WHERE tendangnhap = '$user'";
		
		$stm = $conn->prepare($sql);
		if(!$stm->execute()){
			return array('code' => 1, 'error' => 'Can not execute command');
		}
		return array('code' => 0, 'error' => 'Update info successful');

		$conn->close();
	}

	function checkPass($user,$curPass){
		$sql = "select * from user where tendangnhap = ?";
		$conn = open_database();
		
		$stm = $conn->prepare($sql);
		$stm -> bind_param('s',$user);
		if (!$stm -> execute()){
			return false;
		}
		$result = $stm->get_result();
		
		$data = $result->fetch_assoc();
		
		$hashed_password = $data['matkhau'];
		if(!password_verify($curPass, $hashed_password)){
			return false;
		}else
			return true;
	}

	function changePass($user,$newPass){
		$hash = password_hash($newPass, PASSWORD_DEFAULT);
		$sql = "UPDATE user SET matkhau='$hash' WHERE tendangnhap='$user'";
		$conn = open_database();
		if($conn->query($sql) === TRUE){
			return array('code' => 0, 'error' => 'Update pass successful');
		}
		return array('code' => 1, 'error' => 'Can not execute command');

		$conn->close();
	}


	function getBookInfor(){
		$sql = "select * from book";
		$conn = open_database();
		
		return $result = $conn->query($sql);
		
	}

	function getDetailBookInfor($masach){
		$sql = "select * from book where masach = '$masach'";
		$conn = open_database();
		$result = $conn->query($sql);
		$data = $result->fetch_assoc();
		return $data;
		
	}

	function product_price($price) {
		$symbol_thousand = '.';
		$decimal_place = 0;
		$price = number_format($price, $decimal_place, '', $symbol_thousand);
		return $price;
	}

	function addToCart($user, $masach, $sl){
		$sql = "insert into giohang(tendangnhap,masach,soluong) value(?,?,?)";
		$conn = open_database();
		$stm = $conn->prepare($sql);
		$stm->bind_param('ssi', $user,$masach,$sl);
		if(!$stm->execute()){
			return array('code' => 1, 'error' => 'Can not execute command');
		}
		return array('code' => 0, 'error' => 'Create account successful');
	}

	function getBookFromCart($user){
		$sql = "select * from giohang where tendangnhap = '$user'";
		$conn = open_database();
		
		return $result = $conn->query($sql);
	}

	function getBookCart($masach){
		$sql = "select * from book where masach = '$masach'";
		$conn = open_database();
		
		return $result = $conn->query($sql);
	}

	function updatePNumber($user, $maS, $sl){
		$conn = open_database();
		
		if($sl == 50){}
		else
			$sl = $sl + 1;
			$sql = "UPDATE giohang SET soluong = '$sl' WHERE tendangnhap = '$user' and masach = '$maS'";
		
		$stm = $conn->prepare($sql);
		if(!$stm->execute()){
			return array('code' => 1, 'error' => 'Can not execute command');
		}
		return array('code' => 0, 'error' => 'Update info successful');

		$conn->close();
	}

	function updateMNumber($user, $maS, $sl){
		$conn = open_database();
		
		if($sl == 1){}
		else
			$sl = $sl - 1;
			$sql = "UPDATE giohang SET soluong = '$sl' WHERE tendangnhap = '$user' and masach = '$maS'";
		
		$stm = $conn->prepare($sql);
		if(!$stm->execute()){
			return array('code' => 1, 'error' => 'Can not execute command');
		}
		return array('code' => 0, 'error' => 'Update info successful');

		$conn->close();
	}

	function deleteItem($user, $maS){
		$conn = open_database();
		$sql = "delete from giohang WHERE tendangnhap = '$user' and masach = '$maS'";
		$stm = $conn->prepare($sql);
		if(!$stm->execute()){
			return array('code' => 1, 'error' => 'Can not execute command');
		}
		return array('code' => 0, 'error' => 'Update info successful');

		$conn->close();
	}


	function countNumberAccount($type){
		$conn = open_database();
		if($type == 1){
			$sql = "select * from user where type != 1";
		}
		if($type == 3 || $type == 4){
			$sql = "select * from user where type = 2";
		}
		$result=mysqli_query($conn,$sql);
		$rowcount=mysqli_num_rows($result);
		return $rowcount;
	}

	function countNumberBook($type, $vitri){
		$conn = open_database();
		if($type == 1){
			$sql = "select * from book where vitri = '$vitri'";
		}
		if($type == 3){
			$sql = "select * from book where vitri = 1";
		}
		if($type == 4){
			$sql = "select * from book where vitri = 2";
		}
		$result=mysqli_query($conn,$sql);
		$rowcount=mysqli_num_rows($result);
		return $rowcount;
	}

	function getUserAccount($type){
		if($type == 1){
			$sql = "select * from user where type != 1";
		}
		if($type == 3 || $type == 4){
			$sql = "select * from user where type = 2";
		}
		$conn = open_database();
		
		return $result = $conn->query($sql);
	}

	function deleteUserAccount($user){
		$conn = open_database();
		$sql = "delete from user WHERE tendangnhap = '$user'";
		$stm = $conn->prepare($sql);
		if(!$stm->execute()){
			return array('code' => 1, 'error' => 'Can not execute command');
		}
		return array('code' => 0, 'error' => 'Update info successful');

		$conn->close();
	}

	function getUserAccountInfor($ma){
		$sql = "select * from user where tendangnhap = '$ma'";
		$conn = open_database();
		$result = $conn->query($sql);
		$data = $result->fetch_assoc();
		return $data;

	}

	function editAccount($user,$mk,$ten,$ngays,$sdt,$type){
		$conn = open_database();
		if(empty($mk))
			$sql = "UPDATE user SET hoten = '$ten',ngaysinh='$ngays',sdt = '$sdt', type = '$type' WHERE tendangnhap = '$user'";
		else

			$sql = "UPDATE user SET hoten = '$ten',matkhau='$mk',ngaysinh='$ngays',sdt = '$sdt', type = '$type' WHERE tendangnhap = '$user'";
		$stm = $conn->prepare($sql);
		if(!$stm->execute()){
			return array('code' => 1, 'error' => 'Can not execute command');
		}
		return array('code' => 0, 'error' => 'Update info successful');

		$conn->close();
	}

	function getBookInforMana($vitri){
		$sql = "select * from book where vitri = '$vitri'";
		$conn = open_database();
		
		return $result = $conn->query($sql);
		
	}

	function deleteBookInfor($mas){
		$conn = open_database();
		$sql = "delete from book WHERE masach = '$mas'";
		$stm = $conn->prepare($sql);
		if(!$stm->execute()){
			return array('code' => 1, 'error' => 'Can not execute command');
		}
		return array('code' => 0, 'error' => 'Update info successful');

		$conn->close();
	}

	function editBookInfor($ma,$ten,$gia,$nxb,$ncc,$vitri,$anh,$bia,$tacgia){
		$conn = open_database();
		$sql = "UPDATE book SET tensach = '$ten',giasach='$gia',nxb = '$nxb', nhacungcap = '$ncc', vitri = '$vitri', anh = '$anh', hinhthucbia = '$bia', tacgia = '$tacgia' WHERE masach = '$ma'";

		$stm = $conn->prepare($sql);
		if(!$stm->execute()){
			return array('code' => 1, 'error' => 'Can not execute command');
		}
		return array('code' => 0, 'error' => 'Update info successful');

		$conn->close();
	}

	function countNumberCustom($type, $vitri){
		$conn = open_database();
		if($type == 1){
			$sql = "select * from nhanvien where vitri = '$vitri'";
		}
		if($type == 3){
			$sql = "select * from nhanvien where vitri = 1";
		}
		if($type == 4){
			$sql = "select * from nhanvien where vitri = 2";
		}
		$result=mysqli_query($conn,$sql);
		$rowcount=mysqli_num_rows($result);
		return $rowcount;
	}

	function getInforCustom($vitri){
	
		$sql = "select * from nhanvien where vitri = '$vitri'";
		
		$conn = open_database();
		
		return $result = $conn->query($sql);
	}

	function deleteCustom($us){
		$conn = open_database();
		$sql = "delete from nhanvien WHERE manv = '$us'";
		$stm = $conn->prepare($sql);
		if(!$stm->execute()){
			return array('code' => 1, 'error' => 'Can not execute command');
		}
		return array('code' => 0, 'error' => 'Update info successful');

		$conn->close();
	}

	function getDetailCustom($manv){
		$sql = "select * from nhanvien where manv = '$manv'";
		$conn = open_database();
		$result = $conn->query($sql);
		$data = $result->fetch_assoc();
		return $data;
	}

	function editCustom($ma,$ten,$gioi,$ngays,$vitri,$chucvu){
		$conn = open_database();
		$sql = "UPDATE nhanvien SET tennv = '$ten',gioitinh='$gioi',ngaysinh = '$ngays', vitri = '$vitri', chucvu = '$chucvu' WHERE manv = '$ma'";
		$stm = $conn->prepare($sql);
		if(!$stm->execute()){
			return array('code' => 1, 'error' => 'Can not execute command');
		}
		return array('code' => 0, 'error' => 'Update info successful');

		$conn->close();
	}

	function addBill($mahd,$user,$ten,$sdt,$tinh,$huyen,$xa,$diachi,$tongtien){
		
		$sql = "select * from giohang where tendangnhap = '$user'";
		$conn = open_database();
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
          while($row = $result->fetch_assoc()) {
          	$mas = $row['masach'];
          	$sql1 = "insert into hoadon(mahd,tenkh,sdt,tinh,huyen,xa,diachi,mauser,masach,tongtien) value(?,?,?,?,?,?,?,?,?,?)";
			$conn = open_database();
			$stm = $conn->prepare($sql1);
			$stm->bind_param('sssssssssi', $mahd,$ten,$sdt,$tinh,$huyen,$xa,$diachi,$user,$mas,$tongtien);
			if(!$stm->execute()){
				
			}
			}
		}

	}

	function getDetailBill($mahd,$user){
		$sql = "select * from hoadon where mahd = '$mahd' and mauser = '$user'";
		$conn = open_database();
		
		return $result = $conn->query($sql);
		
	}

	function getDetailBillInfor($mahd){
		$sql = "select * from hoadon where mahd = '$mahd'";
		$conn = open_database();
		
		return $result = $conn->query($sql);
		
	}

	function addCustom($ma,$ten,$gioi,$ngays,$vitri,$chucvu){
		$sql = "insert into nhanvien(manv,tennv,gioitinh,ngaysinh,vitri,chucvu) value(?,?,?,?,?,?)";
		$conn = open_database();
		$stm = $conn->prepare($sql);
		$stm->bind_param('ssssis', $ma,$ten,$gioi,$ngays,$vitri,$chucvu);
		if(!$stm->execute()){
			return array('code' => 1, 'error' => 'Can not execute command');
		}
		return array('code' => 0, 'error' => 'Create account successful');
	}

	function addAccount($user,$mk,$ten,$ngays,$sdt,$type){
		$sql = "insert into user(tendangnhap,matkhau,hoten,ngaysinh,sdt,type) value(?,?,?,?,?,?)";
		$conn = open_database();
		$stm = $conn->prepare($sql);
		$stm->bind_param('sssssi', $user,$mk,$ten,$ngays,$sdt,$type);
		if(!$stm->execute()){
			return array('code' => 1, 'error' => 'Can not execute command');
		}
		return array('code' => 0, 'error' => 'Create account successful');
	}

	function addBookInfor($ma,$ten,$gia,$nxb,$ncc,$vitri,$anh,$bia,$tacgia){
		$sql = "insert into book(masach,tensach,giasach,nxb,nhacungcap,vitri,anh,hinhthucbia,tacgia) value(?,?,?,?,?,?,?,?,?)";
		$conn = open_database();
		$stm = $conn->prepare($sql);
		$stm->bind_param('ssississs', $ma,$ten,$gia,$nxb,$ncc,$vitri,$anh,$bia,$tacgia);
		if(!$stm->execute()){
			return array('code' => 1, 'error' => 'Can not execute command');
		}
		return array('code' => 0, 'error' => 'Create account successful');
	}

	function getBill(){
		$sql = "select * from hoadon";
		$conn = open_database();
		
		return $result = $conn->query($sql);
		
	}

	function deleteBill($mahd){
		$conn = open_database();
		$sql = "delete from hoadon WHERE mahd = '$mahd'";
		$stm = $conn->prepare($sql);
		if(!$stm->execute()){
			return array('code' => 1, 'error' => 'Can not execute command');
		}
		return array('code' => 0, 'error' => 'Update info successful');

		$conn->close();
	}

	function editBill($mahd,$ten,$sdt,$tinh,$huyen,$xa,$diachi){
		$conn = open_database();
		$sql = "UPDATE hoadon SET tenkh = '$ten',sdt='$sdt',tinh = '$tinh', huyen = '$huyen', xa = '$xa',diachi = '$diachi' WHERE mahd = '$mahd'";
		$stm = $conn->prepare($sql);
		if(!$stm->execute()){
			return array('code' => 1, 'error' => 'Can not execute command');
		}
		return array('code' => 0, 'error' => 'Update info successful');

		$conn->close();
	}



	function random_string(){
        $rand = 0;
        $rand = rand(11111111,99999999);
        return $rand;
    }
	
	
?>