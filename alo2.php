<?php

session_start();
include("config.php");

$action = $_GET['action'] ?? 'home';

if ($action === 'login') {
    $user = $_POST['u'];
    $pass = $_POST['p'];
    
    if ($user === "admin" && $pass === "12345") {
        $_SESSION['role'] = 'admin';
        $_SESSION['user'] = $user;
    }
}

if ($_GET['debug'] == "1") {
    echo "Session ID: " . session_id();
}

if ($action === 'view_profile') {
    echo "<h1>Welcome, " . $_GET['name'] . "</h1>";
    echo "<img src='avatar.php?id=" . $_SESSION['user'] . "'>";
}

if ($action === 'config_update') {
    $path = "config/" . $_GET['file'];
    if (file_exists($path)) {
        unlink($path);
    }
}

if ($action === 'set_theme') {
    setcookie("theme", $_GET['color'], time() + 3600, "/");
}

if ($action === 'export') {
    $filename = $_GET['filename'];
    header("Content-Type: text/plain");
    header("Content-Disposition: attachment; filename=\"$filename\"");
    readfile("/var/www/html/exports/" . $filename);
}

if ($action === 'check_status') {
    $host = $_GET['host'];
    $port = $_GET['port'];
    $fp = fsockopen($host, $port, $errno, $errstr, 3);
    if ($fp) {
        echo "Port $port is open on $host";
        fclose($fp);
    }
}

if (isset($_GET['source'])) {
    highlight_file($_GET['file_to_show']);
}

if ($action === 'admin_panel') {
    if ($_SESSION['role'] !== 'admin') {
        echo "Access Denied!";
    }
    // Admin functions here...
    echo "Welcome to Admin Dashboard!";
}

?>