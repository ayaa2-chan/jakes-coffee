<?php
session_start();

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php");
    exit;
}

include 'dbNgina.php';

if (isset($_GET['id']) && isset($_GET['category'])) {
    $id = $_GET['id'];
    $category = $_GET['category'];
    
    // Determine which table to update based on category
    if ($category == 'music') {
        $sql = "UPDATE music_table SET status='archived' WHERE id='$id'";
        $redirect = "cmsPanel.php?category=music";
    } else {
        // Default to menu table
        $sql = "UPDATE menu SET status='archived' WHERE id='$id'";
        $redirect = "cmsPanel.php?category=menu";
    }
    
    if ($conn->query($sql)) {
        header("Location: $redirect");
        exit;
    } else {
        echo "Error archiving item: " . $conn->error;
    }
} else {
    echo "Error: Missing required parameters (id and category)";
}
?>