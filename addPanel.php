<?php
session_start();

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php");
    exit;
}

include 'dbNgina.php';

$category = isset($_GET['category']) ? $_GET['category'] : 'menu';

if (isset($_POST['save'])) {
    if ($category == 'menu') {
        $name = $_POST['name'];
        $cat = $_POST['category'];
        $med = $_POST['price_medium'];
        $large = $_POST['price_large'];
        
        // Automatically set addition based on category
        $add = ($cat == 'coffee') ? 'w/ free glazed donut x1' : '';

        $sql = "INSERT INTO menu (name, category, price_medium, price_large, addition, status)
                VALUES ('$name', '$cat', '$med', '$large', '$add', 'active')";
    } elseif ($category == 'music') {
        $title = $_POST['title'];
        
        $sql = "INSERT INTO music_table (title, status)
                VALUES ('$title', 'active')";
    }

    if ($conn->query($sql)) {
        header("Location: cmsPanel.php?category=$category");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jake's Coffee Shop - Add New Item</title>
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
        }

        #bigBox {
            max-width: 1400px;
            margin: 20px auto;
            border: 3px solid #4a2c2a;
            background-color: #f5f5dc;
        }

        /* Header */
        header {
            background-color: #c9a961;
            padding: 30px;
            text-align: center;
            border-bottom: 3px solid #4a2c2a;
        }

        header h1 {
            color: #4a2c2a;
            font-size: 2.5em;
            margin-bottom: 5px;
        }

        header p {
            color: #4a2c2a;
            font-size: 1.1em;
            font-style: italic;
        }

        /* Content Area */
        .content-area {
            display: flex;
            min-height: 500px;
        }

        /* Left Sidebar Navigation */
        .left-column {
            width: 200px;
            background-color: #e8dbb5;
            border-right: 3px solid #4a2c2a;
            padding: 20px 0;
            flex-shrink: 0;
        }
        
        /* Mobile Menu Toggle */
        .menu-toggle {
            display: none;
            background-color: #4a2c2a;
            color: white;
            padding: 15px;
            text-align: center;
            cursor: pointer;
            font-weight: bold;
            border: none;
            width: 100%;
        }
        
        .menu-toggle:hover {
            background-color: #6b4423;
        }

        .left-column a {
            display: block;
            padding: 15px 20px;
            color: #4a2c2a;
            text-decoration: none;
            font-weight: bold;
            border-bottom: 1px solid #c9a961;
            transition: background-color 0.3s;
        }

        .left-column a:hover,
        .left-column a.active {
            background-color: #c9a961;
        }

        .left-column .section-title {
            padding: 15px 20px;
            font-weight: bold;
            color: #4a2c2a;
            background-color: #c9a961;
            margin-top: 10px;
        }

        /* Main Content */
        .right-column {
            flex: 1;
            padding: 30px;
            background-color: #f5f5dc;
        }

        .form-header {
            margin-bottom: 30px;
            padding-bottom: 15px;
            border-bottom: 2px solid #c9a961;
        }

        .form-header h2 {
            color: #4a2c2a;
            font-size: 1.8em;
            margin-bottom: 10px;
        }

        /* Form Styling */
        .form-container {
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            max-width: 600px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            color: #4a2c2a;
            font-weight: bold;
            margin-bottom: 8px;
            font-size: 1em;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 12px;
            border: 2px solid #c9a961;
            border-radius: 5px;
            font-size: 1em;
            font-family: Arial, sans-serif;
            transition: border-color 0.3s;
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #4a2c2a;
        }

        .form-group small {
            display: block;
            color: #666;
            margin-top: 5px;
            font-style: italic;
        }

        /* Buttons */
        .btn {
            display: inline-block;
            padding: 12px 30px;
            background-color: #4a2c2a;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            border: none;
            cursor: pointer;
            font-weight: bold;
            font-size: 1em;
            transition: background-color 0.3s;
            margin-right: 10px;
        }

        .btn:hover {
            background-color: #6b4423;
        }

        .btn-success {
            background-color: #5a8f5a;
        }

        .btn-success:hover {
            background-color: #4a7a4a;
        }

        .btn-secondary {
            background-color: #888;
        }

        .btn-secondary:hover {
            background-color: #666;
        }

        .form-actions {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 2px solid #e8dbb5;
        }

        /* Footer */
        footer {
            background-color: #c9a961;
            padding: 20px;
            text-align: center;
            border-top: 3px solid #4a2c2a;
        }

        footer p {
            color: #4a2c2a;
            margin-bottom: 5px;
        }

        footer a {
            color: #4a2c2a;
            text-decoration: none;
            font-weight: bold;
        }
        
        /* Responsive Design */
        @media (max-width: 768px) {
            #bigBox {
                margin: 10px;
                border: 2px solid #4a2c2a;
            }
            
            header h1 {
                font-size: 1.8em;
            }
            
            .menu-toggle {
                display: block;
            }
            
            .content-area {
                flex-direction: column;
            }
            
            .left-column {
                width: 100%;
                border-right: none;
                border-bottom: 3px solid #4a2c2a;
                display: none;
            }
            
            .left-column.active {
                display: block;
            }
            
            .right-column {
                padding: 15px;
            }
            
            .form-container {
                padding: 20px;
            }
            
            .form-actions {
                display: flex;
                flex-direction: column;
                gap: 10px;
            }
            
            .btn {
                text-align: center;
            }
        }
        
        @media (max-width: 480px) {
            header h1 {
                font-size: 1.5em;
            }
            
            header p {
                font-size: 0.9em;
            }
            
            .form-container {
                padding: 15px;
            }
            
            .btn {
                padding: 10px 20px;
            }
        }
    </style>
</head>
<body>

<div id="bigBox">
    <header>
        <h1>Jake's Coffee Shop</h1>
        <p>Administration Panel</p>
    </header>

    <button class="menu-toggle" onclick="toggleMenu()">☰ Menu</button>

    <div class="content-area">
        
        <nav class="left-column" id="sideMenu">
            <div class="section-title">MANAGE</div>
            <a href="cmsPanel.php?category=menu" class="<?= $category == 'menu' ? 'active' : '' ?>">Menu Items</a>
            <a href="cmsPanel.php?category=music" class="<?= $category == 'music' ? 'active' : '' ?>">Music Playlist</a>
            
            <div class="section-title">ACTIONS</div>
            <a href="addPanel.php?category=<?= $category ?>">Add New</a>
            <a href="archived.php?category=<?= $category ?>">View Archived</a>
            
            <div class="section-title">SITE</div>
            <a href="jakesCoffeesShop.php" target="_blank">View Website</a>
            <a href="logout.php">Logout</a>
        </nav>

        <main class="right-column">
            
            <div class="form-header">
                <h2><?= $category == 'menu' ? 'Add New Menu Item' : 'Add New Song' ?></h2>
                <a href="cmsPanel.php?category=<?= $category ?>" style="color: #4a2c2a; text-decoration: none;">← Back to List</a>
            </div>

            <div class="form-container">
                <form method="POST">
                    
                    <?php if ($category == 'menu'): ?>
                        <!-- Menu Form -->
                        <div class="form-group">
                            <label for="category">Category *</label>
                            <select name="category" id="category" required>
                                <option value="">-- Select Category --</option>
                                <option value="coffee">Coffee</option>
                                <option value="pastry">Pastry</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="name">Item Name *</label>
                            <input type="text" name="name" id="name" placeholder="e.g., Cappuccino" required>
                        </div>

                        <div class="form-group">
                            <label for="price_medium">Medium Price *</label>
                            <input type="number" name="price_medium" id="price_medium" placeholder="150" required>
                            <small>Enter price without currency symbol</small>
                        </div>

                        <div class="form-group">
                            <label for="price_large">Large Price</label>
                            <input type="number" name="price_large" id="price_large" placeholder="165">
                            <small>Leave blank if not applicable (e.g., for pastries)</small>
                        </div>

                    <?php elseif ($category == 'music'): ?>
                        <!-- Music Form -->
                        <div class="form-group">
                            <label for="title">Song Title *</label>
                            <input type="text" name="title" id="title" placeholder="e.g., Smooth Jazz Vibes" required>
                        </div>

                    <?php endif; ?>

                    <div class="form-actions">
                        <button type="submit" name="save" class="btn btn-success">💾 Save Item</button>
                        <a href="cmsPanel.php?category=<?= $category ?>" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>

        </main>

    </div>

    <footer>
        <p>Copyright © 2011 Jake's Coffee House - Admin Panel</p>
        <a href="mailto:jake@jcoffee.com">jake@jcoffee.com</a>
    </footer>
</div>

<script>
function toggleMenu() {
    const menu = document.getElementById('sideMenu');
    menu.classList.toggle('active');
}
</script>

</body>
</html>