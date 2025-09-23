<?php include 'db.php'; ?>

<!DOCTYPE html>
<html>
  <head>
    <title>TigerWeb</title>
    <link rel='stylesheet' href='style.css'>
  </head>

  <body>
    <div class="container">
      <h1>Class Registration</h1>
      <p><a href='add_class.php'>Add New Class</a></p>
    </div>

    <?php
    $result = $pdo->query('SELECT * FROM class ORDER BY id DESC');
    while($row = $result->fetch_assoc()):
    ?>
    
    <table>
      <tr>
        <th colspan="3">Class List:</th>
      </tr>
      <tr>
        <td><?= htmlspecialchars($row['title']) ?></td>
        <td><?= htmlspecialchars($row['course_description']) ?></td>
        <td><?= $row['seats_available'] ?></td>
      </tr>
    </table>
    <?php endwhile; ?>
  </body>
</html>
