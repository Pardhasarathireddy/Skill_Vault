<?php
include 'db.php';
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.html");
}

$sql = "SELECT * FROM students";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="icon" href="assets/images/Vignan_logo.png">
    <script src="assets/js/scripts.js"></script>

    <style>
        #main-heading {
            text-align: center;
            font-size: 2.5em;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <h1 id="main-heading">Skill Vault</h1>
    <nav class="navbar">
        <div class="logo">
            <img src="assets\images\Vignan_logo.png" alt="College Logo">
        </div>
        <ul>
            <li><a href="#">Home</a></li>
            <li><a href="#">Support</a></li>
            <li><a href="#">About</a></li>
            <li><a href="#">Help</a></li>
            <li><a href="login.html">Logout</a></li>
        </ul>
    </nav>
    <div class="cards">
        <?php 
        $delay = 0;
        while ($row = $result->fetch_assoc()) { 
        ?>
            <div class="card" style="animation-delay: <?php echo $delay; ?>s;">
                <div class="card-content">
                    <h3><?php echo $row['name']; ?></h3>
                    <p>Year: <?php echo $row['year']; ?></p>
                    <p>Skills: <?php echo $row['skills']; ?></p>
                    <p>Ranking: <?php echo $row['ranking']; ?></p>
                    <a href="student_details.php?id=<?php echo $row['id']; ?>" class="more-details">More Details →</a>
                </div>
            </div>
        <?php 
            $delay += 0.1;
        } 
        ?>
    </div>

    <footer>
        <p>&copy; 2024 Skill Vault | All rights reserved.</p>
    </footer>
    <script src="assets/js/scripts.js"></script>
</body>
</html>
