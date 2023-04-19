<?php
require_once 'base.php';

class Render extends Base {
    protected function content(): void
    {
        $age = mt_rand(1, 100); // 랜덤 번호 생성 (Mersenne Twister 사용)
        if ($age >= 20) {
            $state = "성인";
        } else {
            $state = "미성년자";
        }
?>
    <!-- Statement 생성 -->
<h3><?php echo "당신은 $age"."살로 $state"."입니다. " ?></h3>
<?php
    }
}

$render = new Render('나이 판별기', "");
$render->render();
?>