<?php
require_once 'base.php';

class Render extends Base {

    protected function content(): void
    {
?>
        <form method="POST" action="/quicksort.php">
            <div class="mb-3">
            <label for="input" class="form-label">배열 정보 입력: </label>
                <textarea class="form-control" name="input" id="input" rows="5"
                          placeholder=
"10 (배열 원소 개수)
1 (배열 내용)
2
3
..."></textarea>
                <p>입력이 존재하지 않을 시, 랜덤으로 생성된 배열로 정렬이 진행됩니다. </p>
            </div>
            <button class="btn btn-primary" type="submit">제출</button>
        </form>
<?php
    }
}

$render = new Render('퀵 정렬', "");
$render->render();
?>