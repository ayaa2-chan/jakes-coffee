<?php include 'dbNgina.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jake's Coffee Shop - Menu</title>
    <link rel="stylesheet" href="Exercise2design.css">
    <style>
        /* Table Styles */
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            background-color: #fff;
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
    
        h2 {
            color: #4a2c2a;
            margin-top: 30px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

<div id="bigBox">

    <header>
        <h1>Jake's Coffee Shop</h1>
    </header>

    <div class="content-area">
        
        <nav class="left-column">
            <a href="jakesCoffeesShop.php">Home</a>
            <a href="menu.php">Menu</a>
            <a href="music.php">Music</a>
            <a href="jobs.php">Jobs</a>
        </nav>

        <main class="right-column">

            <h2>Coffee</h2>
            <table>
                <thead>
                    <tr>
                        <th>Menu</th>
                        <th>Price Medium</th>
                        <th>Price Large</th>
                        <th>Addition</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $coffee = mysqli_query($conn, "SELECT * FROM menu WHERE category='coffee' AND status='active'");
                while ($row = mysqli_fetch_assoc($coffee)) {
                    echo "<tr>";
                    echo "<td>{$row['name']}</td>";
                    echo "<td>₱ {$row['price_medium']}</td>";
                    echo "<td>₱ {$row['price_large']}</td>";
                    echo "<td>{$row['addition']}</td>";
                    echo "</tr>";
                }
                ?>
                </tbody>
            </table>

            <h2>Pastries</h2>
            <table>
                <thead>
                    <tr>
                        <th>Menu</th>
                        <th>Price</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $pastry = mysqli_query($conn, "SELECT * FROM menu WHERE category='pastry' AND status='active'");
                while ($row = mysqli_fetch_assoc($pastry)) {
                    echo "<tr>";
                    echo "<td>{$row['name']}</td>";
                    echo "<td>₱ {$row['price_medium']}</td>";
                    echo "</tr>";
                }
                ?>
                </tbody>
            </table>

        </main>

    </div>

    <footer>
        <p>Copyright © 2011 Jake's Coffee House</p>
        <a href="mailto:jake@jcoffee.com">jake@jcoffee.com</a>
    </footer>

</div>

</body>
</html>