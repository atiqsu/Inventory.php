<?php ?>
<?php if(isset($_POST['submit-button'])){

    // Load settings.
    require 'settings.php';

    // Verify password.
    if($_POST['password'] != $secret_password){
        header('Location:../?incorrect_password');
        exit;
    }

    // Load the database file.
    $db = fopen(
      $database_path,
      'a+'
    );

    // Lock the database file.
    if(flock($db, LOCK_EX)){

        // Insert item at the end of the database file.
        fwrite(
          $db,
          date('Y-m-d H:i:s')
          . '<'
          . htmlspecialchars(trim($_POST['title']))
          . '<'
          . htmlspecialchars(trim($_POST['amount']))
          . '<'
          . str_replace(
            array(
              "\r\n",
              "\n",
              "\r"
            ),
            '>>',
            htmlspecialchars(trim($_POST['description']))
          )
          . "\n"
        );

        // Unlock the database file.
        flock(
          $db,
          LOCK_UN
        );

        // Close the database file.
        fclose($db);
    }
}

// Return to the inventory index.
header('Location:..');
