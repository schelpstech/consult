<?php
// begin or resume session
session_start();

// Define global application name constant
if (!defined("APP_NAME")) {
    define("APP_NAME", "ATIBA ODL");
}

// Include necessary files
require_once __DIR__ . '/db.inc.php';
require_once __DIR__ . '/user.class.php';
require_once __DIR__ . '/model.class.php';
require_once __DIR__ . '/utility.class.php';
require_once __DIR__ . '/qrcode.class.php';
require_once __DIR__ . '/paystack.class.php';
require_once __DIR__ . '/mailer.class.php';

// Database access parameters
$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';
$db_name = 'atiba';

// Initialize database connection
try {
    $db = new DatabaseConnection($db_host, $db_name, $db_user, $db_pass);
    $db_conn = $db->prepare("SELECT 1"); // quick test query to validate connection

    // Initialize core classes
    $model = new Model($db->getConnection()); // pass PDO wrapper into Model
    $utility = new Utility();
    $generator = new QRCodeGenerator();
    $paystack = new PaystackPayment();
    $user = new User($model);
    $mailer = new Mailer();

} catch (PDOException $e) {
    // Handle connection failure gracefully
    die("Database connection failed: " . $e->getMessage());
}
