<?php ?>
<?php if(isset($_POST['submit-button'])){

    // load settings
    require 'settings.php';

    // verify password
    if($_POST['password'] != $secret_password){
        header('Location:../?incorrect_password');
        exit;
    }

    // load the database file
    $db = fopen(
      $database_path,
      'a+'
    );

    // lock the database file
    if(flock($db, LOCK_EX)){

        // write blog post at the end of the database file
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

        // unlock the database file
        flock(
          $db,
          LOCK_UN
        );

        // close the database file
        fclose($db);
    }
}

// return to the blog index
header('Location:..');
