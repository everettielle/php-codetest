# Webtizen PHP 코딩 테스트
#### 이민준 (Apr 19 2023)

본 프로젝트는 다음과 같이 구성되어 있습니다. 

문제 관련 파일:
1. `age_verifier.php`: 첫 번째 문제; 주어진 나이를 바탕으로 성인/미성년자 여부를 판별하는 스크립트 입니다. 
2. `authentication.php`: 두 번째 문제; 아이디와 비밀번호를 입력받아 인증을 진행하는 스크립트입니다. 
3. `quicksort_form.php`: 세 번째 문제; 배열을 폼으로 입력받아 `quicksort.php`에 전송하는 스크립트입니다. 
    1. `quicksort.php`: Quicksort 정렬 알고리즘과 해당 알고리즘을 이용한 정렬 결과를 출력하는 스크립트입니다. 입력이 없을 경우 랜덤 배열을 생성합니다. 

기타 파일:
- `base.php`: [탬플릿 확장 기능](https://docs.djangoproject.com/en/4.2/ref/templates/language/#template-inheritance)을 구현하기 위하여 제작한 탬플릿 클래스입니다. 
- `index.php`: 메인 페이지를 담당하는 스크립트입니다. 
- `logout.php`: `authentication.php`를 이용한 로그인 이후 로그아웃을 구현하기 위한 스크립트입니다. 
- `csrf_token.php`: 폼에 CSRF Token 인증과정을 추가하여 CSRF 공격을 방지하기 위한 클래스입니다.
- `db.sqlite`: 유저의 정보 (`username=admin, password=admin`)가 저장되어 있는 데이터베이스 파일입니다. 포터블한 프로젝트 구동을 위해 SQLite3를 사용하였습니다. 

PHP 버전은 `8.2.5`를 기반으로 제작하였습니다. 

PHP extension의 경우 `sqlite3`를 사용하였습니다. (`extension=sqlite3`)
