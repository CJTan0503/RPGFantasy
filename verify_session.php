<?php
session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['user_id']) || !isset($_SESSION['username'])) {
    echo json_encode(['isValid' => false]);
    exit;
}

// Check if the stored session username matches localStorage
if (!isset($_SESSION['username']) || $_SESSION['username'] !== $_SESSION['username']) {
    echo json_encode(['isValid' => false]);
    exit;
}

echo json_encode(['isValid' => true]);