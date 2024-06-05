<meta charset='utf-8'>

<?php
        // url로 넘어온 num데이터 GET
	$num = $_GET["num"];
	$mode = $_GET["mode"];



	$con = mysqli_connect("localhost", "user1", "12345", "project1");
        // url로 받은 num데이터와 일치하는 데이터 삭제하는 쿼리문
	$sql = "delete from message where num=$num";
	mysqli_query($con, $sql);

        // DB 연결 끊기
	mysqli_close($con);                


	if($mode == "send")
		$url = "message_box.php?mode=send";
	else
		$url = "message_box.php?mode=rv";



	echo "

	<script>

		location.href = '$url';
	</script>

	";

?>

  
