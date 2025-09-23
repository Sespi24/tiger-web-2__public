<?php 
  declare(strict_types = 1);                                                                  // Use strict typing
  include 'db.php';                                                                           // Database connection

// Initializing variables that the PHP code needs
  $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);                                   // Get id and validate


// Initializing variables that the HTML page needs
  $class = [
    'id'                  => $id,
    'course_code'         => null,
    'title'               => '',
    'course_description'  => '',
  ];                                                                                          // Class data

  if ($id) {                                                                                  // If have id
    $sql    = "SELECT c.id, c.course_code, c.title, c.course_description
                 FROM class AS c
                WHERE c.id = :id";                                                            // SQL to get the class
    $stmt   = $pdo->prepare($sql);
    $class  = ($stmt->execute($id))->fetch();                                                 // Get class data
    if (!$class) {                                                                            // If no class
      $parameters = ['failure' => 'Class not found'];
      $qs = $parameters ? '?' . http_build_array($parameters) : '';
      $location = 'add_class.php' . $qs;
      header('Location: ' . $location, true, 302);
      exit();                                                                                 // Redirect
    }
  }

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {                                                 // If form submitted
    // Get class data
    $class['title']               = $_POST['title'];
    $class['course_code']         = $_POST['course_code'];
    $class['course_description']  = $_POST['course_description'];
  }

  $arguments = $class;                                                                        // Save class data
  try {                                                                                       // Try to insert data
    $pdo->beginTransaction();                                                                 // Start transaction
    /*if ($id) {
      $sql    = "UPDATE class
                    SET title = :title, course_code = :course_code, course_description = :course_description
                  WHERE id = :id;";                                                           // SQL to update class
    } else {*/
      unset($arguments['id']);                                                                //  Remove id
      $sql    = "INSERT INTO class (title, course_code, course_description)
                      VALUES (:title, :course_code, :course_description);";
    //}                                                                                         // SQL to create class
    $stmt = $pdo->prepare($sql);
    $stmt->execute($arguments);                                                               // Run SQL to add class
    $pdo->commit();                                                                           // Commit changes
    
    $parameters = ['success' => 'Class added'];
    $qs = $parameters ? '?' . http_build_array($parameters) : '';
    $location = 'add_class.php' . $qs;
    header('Location: ' . $location, true, 302);
  
    exit();                                                                                   // Redirect
  } catch (PDOException $e) {                                                                 // If PDOException is thrown
    $pdo->rollBack();                                                                         // Rollback SQL changes
    echo $sql . '<br>' . $e->getMessage();                                                    // Print error message to screen
    throw($e);                                                                                // Rethrow exception
  }
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Add Class</title>
    <link rel='stylesheet' href='style.css'>
  </head>

  <body>
    <h1>Add Class</h1>
    <form method='post'>
      <input type='text' name='title' placeholder='Class Name' required>
      <input type='text' name='course_code' placeholder='Course Code' required>
      <textarea name='course_description' placeholder='Course Description' rows='5' cols='40'></textarea>
      <button type='submit'>Save</button>
      <button onclick='Location.href="index.php"' type='button'>Back</button>
    </form>
  </body>
</html>




