<?php
require_once 'base.php';

class Render extends Base {
    protected function content(): void
    {
        ?>
        <ol>
            <li><h2><a class="text-black" href="age_verifier.php"><i class="fa fa-clock"></i> 나이 판별기</a></h2></li>
            <li><h2><a class="text-black" href="authentication.php"><i class="fa fa-lock"></i> 로그인</a></h2></li>
            <li><h2><a class="text-black" href="quicksort_form.php"><i class="fa fa-sort"></i> 퀵 정렬</a></h2></li>
        </ol>
        <?php
    }
}

$error = "";

$render = new Render('메인 페이지', $error);
$render->render();
?>