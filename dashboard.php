
<?php
session_start();

// Check if the user is logged in, if not redirect them to login
if (!isset($_SESSION['user_id'])) {
    header("Location: ../index.html"); // Redirect to login page
    exit; // Always exit after header redirect
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <link rel="stylesheet" href="../css/style.css">
</head>
<body>
  <nav class="navbar">
    <div class="nav-container">
      <a href="dashboard.php" class="logo">
        <i class="fas fa-music"></i> MelodyHub
      </a>
      <div class="nav-links">
        <span>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?></span>
        <a href="dashboard.php">My Songs</a>
        <a href="#" id="logoutBtn">Logout</a>
      </div>
    </div>
  </nav>

  <div class="container">
    <h2>Add New Song</h2>
    <form id="songForm" action="addSong.php" method="post">
      <input type="text" id="title" name="title" placeholder="Song Title" required>
      <input type="text" id="artist" name="artist" placeholder="Artist" required>
      <button type="submit">Add Song <i class="fas fa-plus"></i></button>
    </form>

    <div id="message"></div>

    <h2>Your Playlist</h2>
    <div id="songList"></div>
  </div>

  <script>
    // Add logout functionality
    document.getElementById('logoutBtn').addEventListener('click', function() {
      fetch('logout.php')
        .then(() => {
          window.location.href = '../index.html';
        });
    });
  </script>
  <script src="../js/script.js"></script>
</body>
</html>

