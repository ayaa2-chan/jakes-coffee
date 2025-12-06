<?php include 'dbNgina.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jake's Coffee Shop - Music</title>
    <link rel="stylesheet" href="Exercise2design.css">
    <style>
        /* Table Styles */
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            background-color: #fff;
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
        
        /* Number column styling */
        .track-number {
            text-align: center;
            font-weight: bold;
            color: #000000ff;
            width: 60px;
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

            <h2>Music Playlist</h2>
            <table>
                <thead>
                    <tr>
                        <th>Song No.</th>
                        <th>Title</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $music = mysqli_query($conn, "SELECT * FROM music_table WHERE status='active'");
                $track_number = 1;
                while ($row = mysqli_fetch_assoc($music)) {
                    echo "<tr>";
                    echo "<td class='track-number'>{$track_number}</td>";
                    echo "<td>{$row['title']}</td>";
                    echo "</tr>";
                    $track_number++;
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