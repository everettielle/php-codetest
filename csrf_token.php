<?php
class CSRFToken {
    private string $token;

    /**
     * @throws Exception
     */
    public function __construct() {
        if (!isset($_SESSION['csrf_token'])) {
            $this->token = bin2hex(random_bytes(32)); // 랜덤 CSRF 토큰 생성
            $_SESSION['csrf_token'] = $this->token; // 세션에 기록
        }
        $this->token = $_SESSION['csrf_token'];
    }

    public function getToken(): string
    {
        return $this->token;
    }

    /**
     * @throws Exception
     */
    public function setToken(): void
    {
        $this->token = bin2hex(random_bytes(32));
        $_SESSION['csrf_token'] = $this->token;
    }

    public static function validateToken($request_token): bool
    {
        if (isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $request_token)) { // 세션의 토큰과 입력값의 토큰이 같은지 확인 (Timing attack prevention with hash_equals)
            return true;
        } return false;
    }
}
?>