<?php
// Initialize the session
session_start();

// If session variable is not set it will redirect to login page
if (!isset($_SESSION['username']) || empty($_SESSION['username'])) {
    header("Location: ./auth/homeScreen/homeScreen.php");
    exit;
} else {
    header("Location:./tabs/index.php");
}
