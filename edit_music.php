<?php
include 'dbNgina.php';

$id = $_GET['id'];

// Fetch music item
$sql = "SELECT * FROM music_table WHERE id = $id";
$result = $conn->query($sql);
$item = $result->fetch_assoc();

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    
    $update_sql = "UPDATE music_table SET title='$title' WHERE id=$id";
    
    if ($conn->query($update_sql)) {
        header("Location: cmsPanel.php?category=music&success=1");
        exit();
    } else {
        $error = "Error updating record: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Music - Jake's Coffee Shop</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5dc;
            min-height: 100vh;
            padding: 20px;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            background-color: white;
            border: 3px solid #4a2c2a;
            border-radius: 10px;
            overflow: hidden;
        }

        header {
            background-color: #c9a961;
            padding: 30px;
            text-align: center;
            border-bottom: 3px solid #4a2c2a;
        }

        header h1 {
            color: #4a2c2a;
            font-size: 2em;
            margin-bottom: 5px;
        }

        .form-container {
            padding: 30px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #4a2c2a;
            font-weight: bold;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            border: 2px solid #c9a961;
            border-radius: 5px;
            font-size: 1em;
        }

        .btn-group {
            display: flex;
            gap: 10px;
            margin-top: 30px;
        }

        .btn {
            flex: 1;
            padding: 12px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            font-size: 1em;
            transition: background-color 0.3s;
        }

        .btn-primary {
            background-color: #4a2c2a;
            color: white;
        }

        .btn-primary:hover {
            background-color: #6b4423;
        }

        .btn-secondary {
            background-color: #e8dbb5;
            color: #4a2c2a;
            border: 2px solid #c9a961;
        }

        .btn-secondary:hover {
            background-color: #c9a961;
        }

        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
        }

        .alert-error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        @media (max-width: 768px) {
            .container {
                border: 2px solid #4a2c2a;
            }
            
            header h1 {
                font-size: 1.5em;
            }
            
            .form-container {
                padding: 20px;
            }
            
            .btn-group {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <header>
        <h1>Edit Music Track</h1>
    </header>

    <div class="form-container">
        <?php if (isset($error)): ?>
            <div class="alert alert-error"><?= $error ?></div>
        <?php endif; ?>

        <form method="POST">
            <div class="form-group">
                <label for="title">Song Title:</label>
                <input type="text" name="title" id="title" value="<?= htmlspecialchars($item['title']) ?>" required>
            </div>

            <div class="btn-group">
                <button type="submit" class="btn btn-primary">Save Changes</button>
                <a href="cmsPanel.php?category=music" class="btn btn-secondary" style="text-align: center; text-decoration: none; line-height: 1.5;">Cancel</a>
            </div>
        </form>
    </div>
</div>

</body>
</html>