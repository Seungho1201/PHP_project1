<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>회원가입 페이지</title>
    <script>
        function check_input() {
            if (!document.member_insert.id.value) {
                alert("아이디를 입력하세요!");    
                document.member_insert.id.focus();
                return;
            }

            if (!document.member_insert.pass.value) {
                alert("비밀번호를 입력하세요!");    
                document.member_insert.pass.focus();
                return;
            }

            if (!document.member_insert.pass_confirm.value) {
                alert("비밀번호확인을 입력하세요!");    
                document.member_insert.pass_confirm.focus();
                return;
            }

            if (!document.member_insert.name.value) {
                alert("이름을 입력하세요!");    
                document.member_insert.name.focus();
                return;
            }

            if (document.member_insert.pass.value != document.member_insert.pass_confirm.value) {
                alert("비밀번호가 일치하지 않습니다.\n다시 입력해 주세요!");
                document.member_insert.pass.focus();
                return;
            }

            document.member_insert.submit();
        }
    </script>
</head>
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
    }
    .container h1 {
        text-align: center;
    }
    .container hr {
        width: 90%;
        margin: 0 auto;
    }
    .container p {
        margin-left: 5%;
        text-align: center;
    }
    .container img {
        display: block;
        margin: 0 auto;
        width: 50%;
    }
    .action-buttons {
        border: 1px solid;
        width: 60%;
        height: 50px;
        text-align: center;
        margin: 20px auto;
        border-radius: 15px;
    }
    .action-buttons button {
        margin: 0 10px;
    }
</style>

<body>
    <div class="header">
        <a href="main_page.php" style="text-decoration-line: none; color: black">
            <h1 style="font-size: 75px;">PHP PROJECT</h1>
        </a>
    </div>
    <div class="container" id="round">
        <h1>회원가입 페이지</h1>
        <!-- 기능은 post 실행시 member_insert.php로 이동 -->
        <form name="member_insert" method="post" enctype="multipart/form-data" action="member_insert.php">
            <!--이름-->
            <div>
                이름 : <input type="text" name="name">
            </div>
            <!--나이-->
            <div>
                나이 : <input type="text" name="age">
            </div>
            <!--아이디-->
            <div>
                아이디 : <input type="text" name="id">
            </div>
            <!--비밀번호-->
            <div>
                비밀번호 : <input type="password" name="pass">
            </div>
            <!--비밀번호 확인-->
            <div>
                비밀번호 확인 : <input type="password" name="pass_confirm">
            </div>
            <!--핸드폰 번호-->
            <div>
                전화번호: <input type="text" name="phone_num">
            </div>
            <!--주소-->
            <div>
                주소 : <input type="text" name="address">
            </div>
            <div>
                이미지: <input type="file" name="profile_img">
            </div>
            <div>
                가입인사 : <input type="textarea" name="hello">
            </div>
            <div>
                <input type="radio" name="gender" value="남" checked >남성
                <input type="radio" name="gender"value="여">여성
            </div>
            <div>
                <input type="radio" name="grade" value=1 checked >일반
                <input type="radio" name="grade"value=2>뮤지션
            </div>
            <div>
                <input type="checkbox" name="hobby[]" value="재즈"> 재즈 
                <input type="checkbox" name="hobby[]" value="클래식"> 클래식 
                <input type="checkbox" name="hobby[]" value="POP"> POP 
                <input type="checkbox" name="hobby[]" value="EDM"> EDM
                <input type="checkbox" name="hobby[]" value="아이돌"> 아이돌
            </div>
            <hr>
            <button type="button" onclick="check_input()">회원가입</button>                           
        </form>
    </div>
</body>
</html>
