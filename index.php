  <html>

  <head>

   <Title>Registration Form</Title>

   <link rel="stylesheet" href="./material.min.css">

   <script src="./material.min.js"></script>

   

   <style type="text/css">

    /*body { background-color: #fff; border-top: solid 10px #000;

        color: #333; font-size: .85em; margin: 20; padding: 20;

        font-family: "Segoe UI", Verdana, Helvetica, Sans-Serif;

    }

    h1, h2, h3,{ color: #000; margin-bottom: 0; padding-bottom: 0; }

    h1 { font-size: 2em; }

    h2 { font-size: 1.75em; }

    h3 { font-size: 1.2em; }

    table { margin-top: 0.75em; }

    th { font-size: 1.2em; text-align: left; border: none; padding-left: 0; }

    td { padding: 0.25em 2em 0.25em 0em; border: 0 none; }*/

  </style>

</head>

<body>

  <div class="mdl-layout mdl-js-layout">
    <header class="mdl-layout__header">
      <div class="mdl-layout__header-row">
        <span class="mdl-layout__title">Register Here!</span>
      </div>
    </header>
    <main class="mdl-layout__content">
      <div class="mdl-grid">
        <div class="mdl-cell mdl-cell--6-col">

          <div class="ml-card-square mdl-card mdl-shadow--2dp">
            <div class="mdl-card__title mdl-card--expand" style="background-color:purple">
              <h2 class="mdl-card__title-text">Fill in your name and email address, then click Submit to register.</h2>
            </div>
            <div class="mdl-card__supporting-text">
              <form method="post" action="index.php" enctype="multipart/form-data" >
                <table>
                  <tr>
                    <td>Name  </td>
                    <td><input type="text" name="name" id="name"/></td>
                  </tr>
                  <tr>
                    <td>Email </td>
                    <td><input type="text" name="email" id="email"/></td>
                  </tr>
                  <tr>
                    <td>Job </td>
                    <td><input type="text" name="job" id="job"/></td>
                  </tr>
                  <tr>
                    <td><input type="submit" name="submit" value="Submit" /></td>
                    <td><input type="submit" name="load_data" value="Load Data" /></td>
                  </tr>
                </table>
              </form>
            </div>
            
          </div>

        </div>
        
      </div>
      <div class="mdl-cell mdl-cell--6-col">
        
        <div class="ml-card-square mdl-card mdl-shadow--2dp">
          <div class="mdl-card__title mdl-card--expand alert">
            <h2 class="mdl-card__title-text">People who are registered:</h2>
          </div>
          <div class="mdl-card__supporting-text">
            
            <?php

            $host = "mlazuredb.database.windows.net";

            $user = "admindb";

            $pass = "4dm1ndb!";

            $db = "ml";



            try {

            $conn = new PDO("sqlsrv:server = $host; Database = $db", $user, $pass);

            $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

          } catch(Exception $e) {

          echo "Failed: " . $e;

        }



        if (isset($_POST['submit'])) {

        try {

        $name = $_POST['name'];

        $email = $_POST['email'];

        $job = $_POST['job'];

        $date = date("Y-m-d");

        // Insert data

        $sql_insert = "INSERT INTO Registration (name, email, job, date) 

        VALUES (?,?,?,?)";

        $stmt = $conn->prepare($sql_insert);

        $stmt->bindValue(1, $name);

        $stmt->bindValue(2, $email);

        $stmt->bindValue(3, $job);

        $stmt->bindValue(4, $date);

        $stmt->execute();

      } catch(Exception $e) {

      echo "Failed: " . $e;

    }



    echo "<h3>Your're registered!</h3>";

  } else if (isset($_POST['load_data'])) {

  try {

  $sql_select = "SELECT * FROM Registration";

  $stmt = $conn->query($sql_select);

  $registrants = $stmt->fetchAll(); 

  if(count($registrants) > 0) {

  echo "<h2>People who are registered:</h2>";

  echo "<table>";

    echo "<tr><th>Name</th>";

      echo "<th>Email</th>";

      echo "<th>Job</th>";

      echo "<th>Date</th></tr>";

      foreach($registrants as $registrant) {

      echo "<tr><td>".$registrant['name']."</td>";

        echo "<td>".$registrant['email']."</td>";

        echo "<td>".$registrant['job']."</td>";

        echo "<td>".$registrant['date']."</td></tr>";

      }

    echo "</table>";

  } else {

  echo "<h3>No one is currently registered.</h3>";

}

} catch(Exception $e) {

echo "Failed: " . $e;

}

}

?>



</div>


</div>

</main>
</div>


</body>

</html>
