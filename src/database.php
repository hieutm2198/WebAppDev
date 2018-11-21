<?php 

session_start();

$hostname = 'localhost';
$username = 'root';
$password = 'starman';
$db = 'quanlycuusv';

$connection = new mysqli($hostname, $username, $password, $db);
if($connection -> connect_error) {
    exit('Kết nối CSDL không thành công. Lỗi: ' . $connection -> connect_error);
}
    $_SESSION['MaSV'] = $_SESSION['name_account'];
?>
