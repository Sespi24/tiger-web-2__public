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


  <div>
    <table>
      <tr>
        <th>Course Id</th>
        <th>Title</th>
        <th>Course Codes</th>
        <th>Course Descriptions</th>
      </tr>
<?php
  /*class TableRows extends RecursiveIteratorIterator {
    function __contruct($it) {
      parent::__construct($it, self::LEAVES_ONLY);
    }

    function current() {
      return "<td>" . parent::current() . "</td>";
    }

    function beginChildren() {
      echo "<tr>";
    }

    function endChildren() {
      echo "</tr>" . "\n";
    }
}*/

    $sql = $pdo->prepare('SELECT * FROM class ORDER BY id ASC');
    $sql->execute();
    $classes = $sql->fetchAll();

    foreach($classes as $class) {
  ?>
      <tr>
        <td><?= $class['id']; ?></td>
        <td><?= $class['course_code']; ?></td>
        <td><?= $class['title']; ?></td>
        <td><?= $class['course_description']; ?></td>
      </tr>
 
<?php 
    }
?>
      </table>
    </div>
  </body>
</html>
