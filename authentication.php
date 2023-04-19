<?php
require_once 'base.php';

class Render extends Base {
    protected function content(): void
    {
    if (isset($_SESSION['username'])) {
        ?>
        <h3>이미 로그인되어 있습니다.</h3>
        <?php
    } else {
        ?>
<form method="POST"><input type="hidden" name="csrf_token" value="<?php echo $this->token->getToken() ?>">
    <div class="col-lg-3 col-md-5 col-sm-8">
        <div class="input-group mb-3">
            <span class="input-group-text" id="usericon-addon"><i class="fa fa-user"></i></span>
            <input type="text" name="username" class="form-control" placeholder="아이디" aria-label="Username" aria-describedby="usericon-addon">
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text" id="passicon-addon"><i class="fa fa-lock"></i></span>
            <input type="password" name="password" class="form-control" placeholder="비밀번호" aria-label="Password" aria-describedby="passicon-addon">
        </div>
    </div>
    <button type="submit" class="btn btn-primary mb-3">로그인</button>
</form>
        <?php
        }
    }
}

$error = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (CSRFToken::validateToken($_POST['csrf_token'])) { // CSRF 토큰 일치 여부 확인
        $username = $_POST['username'];
        $password = $_POST['password'];
        $db = new SQLite3('db.sqlite');
        $stmt = $db->prepare("SELECT * FROM users WHERE username = :username AND password = :password"); // SQL Prepared Statement
        $stmt->bindValue(':username', $username, SQLITE3_TEXT);
        $stmt->bindValue(':password', $password, SQLITE3_TEXT);
        $result = $stmt->execute(); // Query execution

        if ($result->fetchArray() !== false) {
            $_SESSION['username'] = $username; // 세션에 유저 정보 추가 (로그인)
            header('Location: index.php');
            exit();
        } else {
            $error = "<strong>경고!</strong> 아이디 혹은 비밀번호가 일치하지 않습니다. ";
        }

        $db->close();
    } else {
        $error = "<strong>경고!</strong> CSRF 검증에 실패하였습니다. 로그인을 중단합니다. ";
    }
}

$render = new Render('로그인', $error);
$render->render();
?>