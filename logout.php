<?php
require_once 'base.php';
if (isset($_SESSION['username'])) {
    unset($_SESSION['username']); // Session에서 유저 정보 삭제
}
header('Location: index.php');
?>