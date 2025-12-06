<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php");
    exit;
}

include 'dbNgina.php';

// Get category from URL or default to 'menu'
$current_category = isset($_GET['category']) ? $_GET['category'] : 'menu';

// Fetch data based on category
if ($current_category == 'menu') {
    $sql = "SELECT * FROM menu WHERE status='active' ORDER BY category, name";
} elseif ($current_category == 'music') {
    $sql = "SELECT * FROM music_table WHERE status='active' ORDER BY id";
}

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jake's Coffee Shop - Admin Panel</title>
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

        .admin-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            padding-bottom: 15px;
            border-bottom: 2px solid #c9a961;
        }

        .admin-header h2 {
            color: #4a2c2a;
            font-size: 1.8em;
        }

        /* Buttons */
        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #4a2c2a;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            border: none;
            cursor: pointer;
            font-weight: bold;
            transition: background-color 0.3s;
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

        .btn-danger {
            background-color: #c94545;
        }

        .btn-danger:hover {
            background-color: #a93535;
        }

        .btn-small {
            padding: 5px 12px;
            font-size: 0.9em;
        }

        /* Category Filters */
        .category-filters {
            margin-bottom: 20px;
            display: flex;
            gap: 10px;
        }

        .category-filters button {
            padding: 8px 16px;
            background-color: #e8dbb5;
            border: 2px solid #c9a961;
            color: #4a2c2a;
            cursor: pointer;
            font-weight: bold;
            border-radius: 5px;
            transition: all 0.3s;
        }

        .category-filters button:hover,
        .category-filters button.active {
            background-color: #c9a961;
        }

        /* Table */
        table {
            width: 100%;
            border-collapse: collapse;
            background-color: white;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        table thead {
            background-color: #4a2c2a;
            color: white;
        }

        table th {
            padding: 12px;
            text-align: left;
            font-weight: bold;
            border: 1px solid #ddd;
        }

        table td {
            padding: 10px 12px;
            border: 1px solid #ddd;
        }

        table tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        table tbody tr:hover {
            background-color: #f0e6d2;
        }

        .action-links {
            display: flex;
            gap: 10px;
        }

        .action-links a {
            color: #4a2c2a;
            text-decoration: none;
            font-weight: bold;
            padding: 5px 10px;
            border-radius: 3px;
            transition: background-color 0.3s;
        }

        .action-links a:hover {
            background-color: #e8dbb5;
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

        footer a:hover {
            text-decoration: underline;
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
            
            .admin-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }
            
            .admin-header h2 {
                font-size: 1.4em;
            }
            
            .category-filters {
                flex-wrap: wrap;
            }
            
            table {
                font-size: 0.85em;
            }
            
            table th,
            table td {
                padding: 8px 6px;
            }
            
            .action-links {
                flex-direction: column;
                gap: 5px;
            }
        }
        
        @media (max-width: 480px) {
            header h1 {
                font-size: 1.5em;
            }
            
            header p {
                font-size: 0.9em;
            }
            
            table {
                font-size: 0.75em;
            }
            
            .btn {
                padding: 8px 15px;
                font-size: 0.9em;
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
            <a href="cmsPanel.php?category=menu" class="<?= $current_category == 'menu' ? 'active' : '' ?>">Menu Items</a>
            <a href="cmsPanel.php?category=music" class="<?= $current_category == 'music' ? 'active' : '' ?>">Music Playlist</a>
            
            <div class="section-title">ACTIONS</div>
            <a href="addPanel.php?category=<?= $current_category ?>">+ Add New</a>
            <a href="archived.php?category=<?= $current_category ?>">📦 View Archived</a>
            
            <div class="section-title">SITE</div>
            <a href="jakesCoffeesShop.php" target="_blank">View Website</a>
            <a href="logout.php">Logout</a>
        </nav>

        <main class="right-column">
            
            <div class="admin-header">
                <h2><?= $current_category == 'menu' ? 'Menu Management' : 'Music Playlist Management' ?></h2>
                <a href="addPanel.php?category=<?= $current_category ?>" class="btn btn-success">+ Add New Item</a>
            </div>

            <?php if ($current_category == 'menu'): ?>
                <!-- Category Filters for Menu -->
                <div class="category-filters">
                    <button class="active" onclick="filterTable('all')">All Items</button>
                    <button onclick="filterTable('coffee')">Coffee</button>
                    <button onclick="filterTable('pastry')">Pastries</button>
                </div>

                <!-- Menu Table -->
                <table id="menuTable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Category</th>
                            <th>Name</th>
                            <th>Medium Price</th>
                            <th>Large Price</th>
                            <th>Addition</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php while($row = $result->fetch_assoc()): ?>
                        <tr data-category="<?= $row['category'] ?>">
                            <td><?= $row['id'] ?></td>
                            <td><strong><?= ucfirst($row['category']) ?></strong></td>
                            <td><?= $row['name'] ?></td>
                            <td><?= $row['price_medium'] ?></td>
                            <td><?= $row['price_large'] ?? 'N/A' ?></td>
                            <td><?= $row['addition'] ?? '-' ?></td>
                            <td>
                                <div class="action-links">
                                    <a href="edit_menu.php?id=<?= $row['id'] ?>">✏️ Edit</a>
                                    <a href="archivePanel.php?id=<?= $row['id'] ?>&category=menu" onclick="return confirm('Archive this item?')" style="color: #c94545;">🗑️ Archive</a>
                                </div>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                    </tbody>
                </table>

            <?php elseif ($current_category == 'music'): ?>
                <!-- Music Table -->
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Track #</th>
                            <th>Song Title</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                    $track = 1;
                    while($row = $result->fetch_assoc()): 
                    ?>
                        <tr>
                            <td><?= $row['id'] ?></td>
                            <td><strong><?= $track++ ?></strong></td>
                            <td><?= $row['title'] ?></td>
                            <td>
                                <div class="action-links">
                                    <a href="edit_music.php?id=<?= $row['id'] ?>">✏️ Edit</a>
                                    <a href="archivePanel.php?id=<?= $row['id'] ?>&category=music" onclick="return confirm('Archive this song?')" style="color: #c94545;">🗑️ Archive</a>
                                </div>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                    </tbody>
                </table>
            <?php endif; ?>

        </main>

    </div>

    <footer>
        <p>Copyright © 2011 Jake's Coffee House - Admin Panel</p>
        <a href="mailto:jake@jcoffee.com">jake@jcoffee.com</a>
    </footer>
</div>

<script>
// Filter table by category
function filterTable(category) {
    const rows = document.querySelectorAll('#menuTable tbody tr');
    const buttons = document.querySelectorAll('.category-filters button');
    
    // Update button states
    buttons.forEach(btn => btn.classList.remove('active'));
    event.target.classList.add('active');
    
    // Filter rows
    rows.forEach(row => {
        if (category === 'all') {
            row.style.display = '';
        } else {
            row.style.display = row.dataset.category === category ? '' : 'none';
        }
    });
}

// Toggle mobile menu
function toggleMenu() {
    const menu = document.getElementById('sideMenu');
    menu.classList.toggle('active');
}
</script>

</body>
</html>