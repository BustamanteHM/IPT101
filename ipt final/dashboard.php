<?php

session_start();
include 'db.php';
$messages = include 'en.php';

// Check if user is logged in
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}

// Fetch messages
$sql = "SELECT * FROM email ORDER BY created_at DESC";
$result = $conn->query($sql);

// Delete message
if (isset($_GET['delete_id'])) {
    $delete_id = intval($_GET['delete_id']);
    $conn->query("DELETE FROM email WHERE id = $delete_id");
    echo "<script>alert('Message deleted successfully!'); window.location='dashboard.php';</script>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Dashboard</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: #f8f9fa;
      display: flex;
      min-height: 100vh;
      color: #333;
    }
    .sidebar {
      width: 250px;
      background: #212529;
      color: white;
      padding: 20px;
      position: fixed;
      top: 0;
      left: 0;
      bottom: 0;
      transition: transform 0.3s ease-in-out;
      z-index: 100;
    }
    .sidebar h2 {
      text-align: center;
      font-size: 1.5rem;
      margin-bottom: 30px;
      color: #f8f9fa;
    }
    .sidebar a {
      display: block;
      text-decoration: none;
      color: #f8f9fa;
      padding: 12px;
      margin-bottom: 15px;
      border-radius: 8px;
      transition: background 0.3s ease;
      font-size: 1rem;
    }
    .sidebar a:hover {
      background: #495057;
    }
    .sidebar.hidden {
      transform: translateX(-100%);
    }
    .table-container {
      overflow-x: auto;
      background: #fff;
      border-radius: 10px;
      padding: 15px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.05);
      display: flex;
      justify-content: center;
    }
    table {
      width: auto;
      min-width: 650px;
      border-collapse: collapse;
    }
    .main-content {
      flex: 1;
      padding: 25px;
      margin-left: 250px;
      transition: margin-left 0.3s ease-in-out;
      width: 100%;
    }
    .sidebar.hidden + .main-content {
      margin-left: 0;
    }
    .main-content h1 {
      margin-bottom: 25px;
      font-size: 2rem;
      font-weight: bold;
      color: #212529;
    }
    table th, table td {
      border-bottom: 1px solid #dee2e6;
      padding: 12px 10px;
      text-align: left;
    }
    table th {
      background: #4CAF50;
      color: white;
      text-transform: uppercase;
      font-size: 14px;
    }
    table tr:hover {
      background: #f1f3f5;
    }
    .actions {
      display: flex;
      gap: 10px;
      justify-content: center;
    }
    .action-btn {
      border: none;
      cursor: pointer;
      padding: 8px;
      font-size: 16px;
      border-radius: 50%;
      transition: transform 0.2s ease, background 0.3s ease;
    }
    .view-btn {
      background: #2196F3;
      color: white;
    }
    .view-btn:hover {
      background: #1e88e5;
      transform: scale(1.1);
    }
    .delete-btn {
      background: #f44336;
      color: white;
    }
    .delete-btn:hover {
      background: #e53935;
      transform: scale(1.1);
    }
    .hamburger {
      display: none;
      position: fixed;
      top: 15px;
      left: 15px;
      background: #212529;
      color: white;
      border: none;
      padding: 10px 15px;
      font-size: 20px;
      cursor: pointer;
      border-radius: 5px;
      z-index: 101;
    }
    @media (max-width: 768px) {
      .hamburger {
        display: block;
      }
      .sidebar {
        transform: translateX(-100%);
      }
      .sidebar.active {
        transform: translateX(0);
      }
      .main-content {
        margin-left: 0;
        padding: 15px;
      }
      table th, table td {
        font-size: 14px;
        padding: 8px;
      }
      .action-btn {
        font-size: 14px;
        padding: 6px;
      }
    }
    @media (max-width: 480px) {
      table th, table td {
        font-size: 12px;
      }
      .action-btn {
        font-size: 12px;
        padding: 5px;
      }
    }
  </style>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body>
  <!-- Hamburger Button -->
  <button class="hamburger" onclick="toggleSidebar()">☰</button>

  <!-- Sidebar -->
  <div class="sidebar" id="sidebar">
    <h2>Admin Panel</h2>
    <a href="dashboard.php"><i class="fa-solid fa-envelope"></i> Emails</a>
    <a href="index.php"><i class="fa-solid fa-house"></i> Back to Website</a>
    <a href="logout.php"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
  </div>

  <!-- Main Content -->
  <div class="main-content">
    <h1>Messages</h1>
    <div class="table-container">
      <table>
        <thead>
          <tr>
            <th>Name</th>
            <th>Subject</th>
            <th>Message</th>
            <th>Date Submitted</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
              <td><?= htmlspecialchars($row['name']); ?></td>
              <td><?= htmlspecialchars($row['subject']); ?></td>
              <td><?= htmlspecialchars(substr($row['message'], 0, 30)); ?>...</td>
              <td><?= htmlspecialchars($row['created_at']); ?></td>
              <td class="actions">
                <!-- View Button -->
                <button class="action-btn view-btn"
                  onclick="viewMessage(
                    '<?= htmlspecialchars($row['name']); ?>',
                    '<?= htmlspecialchars($row['subject']); ?>',
                    `<?= htmlspecialchars($row['message']); ?>`,
                    '<?= htmlspecialchars($row['created_at']); ?>'
                  )">
                  <i class="fa-solid fa-eye"></i>
                </button>
                <!-- Delete Button -->
                <a class="action-btn delete-btn" 
                   href="dashboard.php?delete_id=<?= $row['id']; ?>"
                   onclick="return confirm('Are you sure you want to delete this message?');">
                  <i class="fa-solid fa-trash"></i>
                </a>
              </td>
            </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    </div>
  </div>

  <script>
    // Toggle sidebar for mobile
    function toggleSidebar() {
      document.getElementById('sidebar').classList.toggle('active');
    }

    // View message alert box
    function viewMessage(name, subject, message, date) {
      alert(
        "Name: " + name + "\n" +
        "Subject: " + subject + "\n" +
        "Message: " + message + "\n" +
        "Date Submitted: " + date
      );
    }
  </script>
</body>
</html>