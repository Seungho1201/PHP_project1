<!DOCTYPE html>
<html>
<head> 
    <meta charset="utf-8">
    <title>PHP 프로그래밍 입문</title>
    <link rel="stylesheet" type="text/css" href="./css/common.css">
    <link rel="stylesheet" type="text/css" href="./css/member.css">
    <script type="text/javascript" src="./js/member_modify.js"></script>
    <script>
        function check_input() {
            if (!document.member_form.pass.value) {
                alert("비밀번호를 입력하세요!");    
                document.member_form.pass.focus();
                return;
            }
            if (!document.member_form.pass_confirm.value) {
                alert("비밀번호확인을 입력하세요!");    
                document.member_form.pass_confirm.focus();
                return;
            }
            if (!document.member_form.name.value) {
                alert("이름을 입력하세요!");    
                document.member_form.name.focus();
                return;
            }
            if (document.member_form.pass.value != document.member_form.pass_confirm.value) {
                alert("비밀번호가 일치하지 않습니다.\n다시 입력해 주세요!");
                document.member_form.pass.focus();
                document.member_form.pass.select();
                return;
            }
            document.member_form.submit();
        }

        function reset_form() {
            document.member_form.id.value = "";  
            document.member_form.pass.value = "";
            document.member_form.pass_confirm.value = "";
            document.member_form.name.value = "";
            document.member_form.email1.value = "";
            document.member_form.email2.value = "";  
            document.member_form.id.focus();
            return;
        }
    </script>
    <style>
        #round {
            border-radius: 15px;
        }
        body {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin: 0;
            padding: 0;
        }
        .header {
            text-align: center;
            width: 100%;
        }
        .container {
            border: 1px solid;
            width: 60%;
            height: 600px;
            margin: 20px;
            padding: 10px;
            border-radius: 15px;
            text-align: center;
        }
        .container h2 {
            text-align: center;
        }
        .container .form {
            margin: 10px 0;
        }
        .container .form .col1 {
            float: left;
            width: 100px;
            font-weight: bold;
        }
        .container .form .col2 {
            float: left;
            width: 200px;
        }
        .container .clear {
            clear: both;
        }
        .container .bottom_line {
            margin-top: 20px;
            border-bottom: 1px solid #ccc;
        }
        .container .buttons {
            margin-top: 20px;
        }
        .icon {
            width: 50px; /* 아이콘의 크기를 조절합니다 */
        }
    </style>
</head>
<body> 
    <?php
        // 세션 시작
        session_start();
        if (isset($_SESSION["id"])) $id = $_SESSION["id"];
        else $id = "";
        if (isset($_SESSION["name"])) $name = $_SESSION["name"];
        else $name = "";
        if (isset($_SESSION["grade"])) $grade = $_SESSION["grade"];
        else $grade = "";

        $con = mysqli_connect("localhost", "user1", "12345", "project1");
        // 현재로그인한 id와 일치하는 데이터 조회 쿼리문
        $sql    = "select * from members where id='$id'";
        $result = mysqli_query($con, $sql);
        $row    = mysqli_fetch_array($result);
        // 쿼리문 실행 결과 각 변수에 저장
        $pass = $row["passwd"];
        $name = $row["name"];
        $age = $row["age"];
        $hello = $row["hello"];
        mysqli_close($con);
    ?>

    <header>
    	<?php include "header.php";?>
    </header>

    <div class="container" id="round">
        <!-- 기능은 post 실행시 member_modify.php?id=로그인한아이디 로 이동 -->
        <form name="member_form" method="post" action="member_modify.php?id=<?=$id?>">
            <h2>회원 정보수정</h2>
            <div class="form">
                아이디: <?=$id?>
                <br>
                비밀번호 : <input type="password" name="pass" value="<?=$pass?>">
                <br>
                비밀번호 확인 : <input type="password" name="pass_confirm" value="<?=$pass?>">
                <br>
                이름 : <input type="text" name="name" value="<?=$name?>">
                <br>
                나이 : <input type="text" name="age" value="<?=$age?>">
                <br>
                가입인사 : <input type="textarea" name="hello" value="<?=$hello?>">
            </div>
            <div class="bottom_line"></div>
            <div class="buttons">
                <input class="icon" type="image" src="./icon/update_icon.jpg" onclick="check_input()">
            </div>
        </form>
    </div>
</body>
</html>
