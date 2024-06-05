<?php
    // url에서 넘어온 id 데이터 GET
    $id = $_GET["id"];
    // member_modify_form.php에서 넘어온 데이터 각 변수에 저장
    $pass = $_POST["pass"];
    $name = $_POST["name"];
    $age = $_POST["age"];
    $hello = $_POST["hello"];

          
    $con = mysqli_connect("localhost", "user1", "12345", "project1");
    // url로 받은 id와 일치하는 데이터 update
    $sql = "update members set passwd='$pass', name='$name', age='$age', hello = '$hello'";
    $sql .= " where id='$id'";
    mysqli_query($con, $sql);

    // DB 연결 종료
    mysqli_close($con);    

    echo "
	      <script>
	          location.href = 'index.php';
	      </script>
	  ";
?>

   
