<!DOCTYPE>

<html>

<head>
    <meta lang="en">
    <title>Add a New Piece</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style>
        body {
            background-color: #e7e7e7;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">JoCo Art Catalogue</a>
            </div>
            <ul class="nav navbar-nav">
                <li>
                    <a href="index.html">Home</a>
                </li>
                <li>
                    <a href="add.html">Add</a>
                </li>
                <li>
                    <a href="update.html">Update</a>
                </li>
                <li>
                    <a href="artist.html">Artist</a>
                </li>
                <li>
                    <a href="collection.html">Collection</a>
                </li>
                <li>
                    <a href="location.html">Location</a>
                </li>
                <li class="active">
                    <a href="testlist.php">Test List</a>
                </li>
            </ul>
        </div>
    </nav>
    <h2>Test List</h2>
    <?php
        $con = mysqli_connect("localhost","root","","test");

           
        if (mysqli_connect_errno())
          {
          echo "Failed to connect to MySQL: " . mysqli_connect_error();
          }
        $sql = 'SELECT * FROM artist';
        $result = mysqli_query($con, $sql);

    foreach ($result as $row) {
        printf('<li><span>%s %s</span></li>',
          htmlspecialchars($row['firstName']),
          htmlspecialchars($row['lastName'])
    
        );
        }    
        printf('<br><br>');
        $sql2 = 'select * from artpiece';
        $result2 = mysqli_query($con, $sql2);
        foreach ($result2 as $row) {
            printf('<li><span>%s || %s || %s ||%d</span></li>',
              htmlspecialchars($row['title']),
              htmlspecialchars($row['yearInstalled']),
              htmlspecialchars($row['info']),
              htmlspecialchars($row['locationID'])
            );

            }    

    mysqli_close($con);
       
    ?>
</body>



</html>