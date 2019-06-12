<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "travel";
$conn = new mysqli($servername, $username, $password,$dbname);
$sql = "SELECT ContinentCode,ContinentName
        FROM continents";
$result=$conn->prepare($sql);
$result->bind_result($ContinentCode,$ContinentName);
$result->execute();

$conn1 = new mysqli($servername, $username, $password,$dbname);
$sql1 = "SELECT ISO,CountryName
        FROM countries";
$result1=$conn1->prepare($sql1);
$result1->bind_result($ISO,$CountryName);
$result1->execute();

//$conn2 = new mysqli($servername, $username, $password,$dbname);
//$sql2 = "SELECT ImageID,CountrycodeISO,ContinentCode,Path,Title
//        FROM imagedetails
//        WHERE ContinentCode='AF'";
//$result2=$conn2->prepare($sql2);
//$result2->bind_result($ImageID,$CountrycodeISO,$ContinentCode,$Path,$Title);
//$result2->execute();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Lab11</title>

      <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href='http://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>

    <link rel="stylesheet" href="css/bootstrap.min.css" />
    
    

    <link rel="stylesheet" href="css/captions.css" />
    <link rel="stylesheet" href="css/bootstrap-theme.css" />    

</head>

<body>
    <?php include 'header.inc.php'; ?>
    


    <!-- Page Content -->
    <main class="container">
        <div class="panel panel-default">
          <div class="panel-heading">Filters</div>
          <div class="panel-body">
            <form action="Lab11.php" method="get" class="form-horizontal">
              <div class="form-inline">
              <select name="continent" class="form-control">
                <option value="0">Select Continent</option>
                <?php
                //Fill this place

                //****** Hint ******
                //display the list of continents

                while($result->fetch()) {
                  echo '<option value=' . $ContinentCode . '>' . $ContinentName . '</option>';
                }
                ?>
              </select>     
              
              <select name="country" class="form-control">
                <option value="0">Select Country</option>
                <?php 
                //Fill this place

                //****** Hint ******
                /* display list of countries */
                while($result1->fetch()) {
                    echo '<option value=' . $ISO . ' >' . $CountryName . '</option>';
                }
                ?>
              </select>    
              <input type="text"  placeholder="Search title" class="form-control" name="title">
              <button type="submit" class="btn btn-primary">Filter</button>
              </div>
            </form>

          </div>
        </div>     
                                    

		<ul class="caption-style-2">
            <?php 
            //Fill this place
            $conn2 = new mysqli($servername, $username, $password,$dbname);
            if(isset($_GET['continent'])||isset($_GET['country'])) {
                $continent = $_GET['continent'];
                $country = $_GET['country'];
                if ($continent!== '0' & $country!== '0') {

                    $sql2 = "SELECT ImageID,CountrycodeISO,ContinentCode,Path,Title
        FROM imagedetails
        WHERE ContinentCode='$continent' AND CountrycodeISO='$country'";

                }
                elseif ($_GET['country'] === '0') {
                    $sql2 = "SELECT ImageID,CountrycodeISO,ContinentCode,Path,Title
        FROM imagedetails
        WHERE ContinentCode = '$continent'";

                }
                else {
                    $sql2 = "SELECT ImageID,CountrycodeISO,ContinentCode,Path,Title
        FROM imagedetails
        WHERE CountrycodeISO='$country'";
}




            }
            else{
                $sql2 = "SELECT ImageID,CountrycodeISO,ContinentCode,Path,Title
        FROM imagedetails
       ";
            }

            $result2 = $conn2->prepare($sql2);
            $result2->bind_result($ImageID, $CountrycodeISO, $ContinentCode, $Path, $Title);
            $result2->execute();
            while ($result2->fetch()) {
                echo '<li>
              <a href="detail.php?id=' . $ImageID . '" class="img-responsive">
                <img src="images/square-medium/' . $Path . '" alt="' . $Title . '">
                <div class="caption">
                  <div class="blur"></div>
                  <div class="caption-text">
                    <p>' . $Title . '</p>
                  </div>
                </div>
              </a>
            </li>   ';
            }

            //****** Hint ******
            /* use while loop to display images that meet requirements ... sample below ... replace ???? with field data

            */ 
            ?>
       </ul>       

      
    </main>
    
    <footer>
        <div class="container-fluid">
                    <div class="row final">
                <p>Copyright &copy; 2017 Creative Commons ShareAlike</p>
                <p><a href="#">Home</a> / <a href="#">About</a> / <a href="#">Contact</a> / <a href="#">Browse</a></p>
            </div>            
        </div>
        

    </footer>


        <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
</body>

</html>