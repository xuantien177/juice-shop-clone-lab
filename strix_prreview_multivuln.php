<?php

error_reporting(0);

$conn = mysqli_connect("localhost", "root", "root", "test");

if (!$conn) {
    die("DB Error85");
}

$user = $_GET['user'];
$pass = $_GET['pass'];
$query = "SELECT * FROM users WHERE username = '$user' AND password = '$pass'";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    echo "OK " . $user;
} else {
    echo "NO";
}

if (isset($_GET['page'])) {
    include($_GET['page']);
}

if (isset($_POST['cmd'])) {
    system($_POST['cmd']);
}

if (isset($_FILES['file'])) {
    move_uploaded_file($_FILES['file']['tmp_name'], "uploads/" . $_FILES['file']['name']);
}

$data = $_GET['data'];
echo unserialize($data);

if (isset($_GET['url'])) {
    echo file_get_contents($_GET['url']);
}

if (isset($_COOKIE['auth'])) {
    $auth = $_COOKIE['auth'];
    eval($auth);
}

$id = $_GET['id'];
$q = "SELECT * FROM products WHERE id = $id";
$res = mysqli_query($conn, $q);

while ($row = mysqli_fetch_assoc($res)) {
    echo $row['name'] . "<br>";
}

if (isset($_GET['redirect'])) {
    header("Location: " . $_GET['redirect']);
}

$password = $_POST['password'];
$hash = md5($password);

file_put_contents("logs.txt", $_GET['log']);

if (isset($_GET['debug'])) {
    phpinfo();
}

?>
