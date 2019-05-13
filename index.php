  <html>

  <head>

   <Title>Registration Form</Title>

   <link rel="stylesheet" href="./material.min.css">

   <script src="./material.min.js"></script>
<style>

			.ml-card-square{
				width: 100%;
			}
			.mdl-card__title {
				color: #fff;
				height: 60px;
				background-color:#46B6AC;
			}
			.alert{
				background-color:purple;
			}
			.warning{
				background-color:orange;
			}
.info{
				background-color:blue;
			}
			tr, td{
				border-bottom: 1px dashed gray;
				color: purple;
				padding-left: 10px;
			}
			
		</style>

</head>

<body>

  <div class="mdl-layout mdl-js-layout">
    <header class="mdl-layout__header">
      <div class="mdl-layout__header-row alert">
        <span class="mdl-layout__title">REGISTER HERE!</span>
      </div>
    </header>
    <main class="mdl-layout__content">
      <div class="mdl-grid">
        <div class="mdl-cell mdl-cell--6-col">

          <div class="ml-card-square mdl-card mdl-shadow--2dp">
            <div class="mdl-card__title mdl-card--expand alert">
              <h3 class="mdl-card__title-text">Fill in your name and email address, then click Submit to register.</h3>
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
                    <td></td>
                    <td><input type="submit" name="submit" value="Submit" /><input type="submit" name="load_data" value="Load Data" /></td>
                  </tr>
                </table>
              </form>
            </div>
            
          </div>

        </div>
        
     
      <div class="mdl-cell mdl-cell--6-col">
        
        <div class="ml-card-square mdl-card mdl-shadow--2dp">
          <div class="mdl-card__title mdl-card--expand alert">
            <h2 class="mdl-card__title-text"></h2>
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

  echo "<h3>People who are registered:</h3>";

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
