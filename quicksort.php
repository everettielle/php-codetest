<?php
require_once 'base.php';

class Render extends Base {

    public function quicksort(array $arr) {
        if (count($arr) <= 1) {
            return $arr;
        }

        $pivot = (int) (count($arr) / 2); // 대부분의 상황에서 최적의 퍼포먼스를 위해 pivot 값은 중앙으로 설정
        $left = array();
        $right = array();

        for ($i = 0; $i < count($arr); $i++) {
            if ($i == $pivot) { // $arr[$pivot]은 건너뛰도록 설정
                continue;
            }
            if ($arr[$i] < $arr[$pivot]) { // $arr[$i]가 $arr[$pivot]보다 작은 경우 $left 배열에 append
                $left[] = $arr[$i];
            } else { // $arr[$i]가 $arr[$pivot]과 같거나 큰 경우 $right 배열에 append
                $right[] = $arr[$i];
            }
        }
        return array_merge($this->quicksort($left), array($arr[$pivot]), $this->quicksort($right)); // 최종적으로 $left, $arr[$pivot], $right merge 하여 return
    }
    protected function content(): void
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["input"] != "") {
            $input = $_POST["input"];
            $arr = explode("\n", $input); // escape를 기준으로 array 생성
            $arr = array_map('intval', $arr); // str -> int
            $count = $arr[0];
            $arr = array_slice($arr, 1, count($arr)); // 첫 번째 값을 제외한 나머지 값으로 최종 array 생성
            echo "<p>유저 입력 배열 원소 개수: $count</p>";
        } else {
            $count = rand(10, 1000);
            $arr = array();
            for ($i = 0; $i < $count; $i++) {
                $arr[] = rand(0, 1000);
            }
            shuffle($arr);
            echo "<h6><span class='text-danger'>경고:</span> 배열이 입력되지 않아 랜덤 배열로 설정되었습니다. </h6>";
        }
        ?>
        <p>실제 배열 원소 개수: <?php echo count($arr) ?></p>
        <!-- 정렬 전 -->
        <h3>정렬 전: </h3>
        <p>[<?php echo implode(', ', $arr) ?>]</p>
        <?php
        $arr = $this->quicksort($arr);
        ?>
        <!-- 정렬 후 -->
        <h3>정렬 후:</h3>
        <p>[<?php echo implode(', ', $arr) ?>]</p>
        <?php
    }
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!CSRFToken::validateToken($_POST['csrf_token'])) {
        header('Location: quicksort_form.php');
    }
}

$render = new Render('퀵 정렬 결과', "");
$render->render();
?>