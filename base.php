<?php
/* PHP 디자인 설명
 * 본 PHP 프로젝트는 class를 이용하여 탬플릿 확장 기능을 구현하였습니다.
 * 아래의 render() 함수 내부의 내용을 기반으로 하여 다른 PHP 파일의 디자인을 일괄 적용할 수 있습니다.
 * 데이터베이스는 프로젝트 공유의 유동성을 위해 SQLite를 사용하였습니다.
 */
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once 'csrf_token.php';

class Base {
    protected string $title; // HTML 페이지 제목 설정
    protected string $lang = "ko"; // HTML 언어 설정
    protected string $encode = "utf-8"; // HTML 인코딩 설정
    protected string $error = ""; // 오류 메시지 변수
    public CSRFToken $token;

    public function __construct($title, $error) {
        $this->title = $title;
        $this->error = $error;
        $this->token = new CSRFToken();
    }

    protected function content() { // HTML 탬플릿 안에 포함될 내용 설정 (자식 class에서 설정됨)

    }

    public function render() { // HTML 탬플릿의 내용을 포함한 함수
?>
<!DOCTYPE HTML>
<html lang="<?php echo $this->lang ?>">
    <head>
        <meta charset="<?php echo $this->encode ?>">
        <title><?php echo $this->title ?> | Webtizen</title>

        <!-- Bootstrap 5 -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <!-- Icons -->
        <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
        <link href="css/font-awesome.css" rel="stylesheet">
        <!-- Noto Sans KR font -->
        <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
        <style>
            body {
                font-family: 'Noto Sans KR', sans-serif;
            }
        </style>
    </head>
    <body>
        <header>
            <!-- 내비게이션 바 시작 -->
            <nav class="navbar navbar-expand-md navbar-dark bg-dark">
                <div class="container-fluid">
                    <a class="navbar-brand" href="/index.php"><span class="navbar-brand mb-0 h1">Webtizen</span></a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav me-auto mb-2 mb-md-0">
                            <li class="nav-item">
                                <a class="nav-link <?php if ($_SERVER['SCRIPT_NAME'] == '/index.php' or $_SERVER['SCRIPT_NAME'] == '') echo 'active' ?>" aria-current="page" href="/index.php">메인 페이지</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?php if ($_SERVER['SCRIPT_NAME'] == '/age_verifier.php') echo 'active' ?>" href="/age_verifier.php">나이 판별기</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?php if ($_SERVER['SCRIPT_NAME'] == '/authentication.php') echo 'active' ?>" href="/authentication.php">로그인</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?php if ($_SERVER['SCRIPT_NAME'] == '/quicksort.php' or $_SERVER['SCRIPT_NAME'] == '/quicksort_form.php') echo 'active' ?>" href="/quicksort_form.php">퀵 정렬</a>
                            </li>
                        </ul>
                        <?php
                        if (isset($_SESSION['username'])) {
                            ?>
                            <div class="d-flex">
                                <span class="navbar-text mx-1">환영합니다, <?php echo $_SESSION['username'] ?>님</span>
                                <a href="./logout.php"><button class="btn btn-primary">로그아웃</button></a>
                            </div>
                            <?php
                        } else {
                            ?>
                            <div class="d-flex">
                                <a href="./authentication.php"><button class="btn btn-primary">로그인</button></a>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </nav>
            <!-- 내비게이션 바 끝 -->
        </header>
        <main>
            <!-- Error alert 시작 -->
<?php
    if (!empty($this->error)) {
        ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <div><i class="fa fa-warning"></i> <?php echo $this->error ?></div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php
    }
?>
            <!-- Error alert 끝 -->
            <div class="container">
                <h1 class="mt-5"><?php echo $this->title ?></h1>
                <!-- Block content 시작 -->
                <?php $this->content() ?>
                <!-- Block content 끝 -->
                <?php
                if ($this->title != "메인 페이지") {
                    echo '<a href="index.php"><button class="btn btn-dark btn-lg mt-5"><i class="fa fa-backward"></i> 메인으로 돌아가기</button></a>';
                }
                ?>
            </div>
        </main>
        <!-- JQuery -->
        <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
        <!-- Bootstrap 5 -->
        <script src="js/bootstrap.bundle.min.js"></script>
    </body>
</html>
<?php
    }
}
?>