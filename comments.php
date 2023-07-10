<?php
session_start();
?>
<?php include("connection/connect.php");?>
<!DOCTYPE html>
<html>
<head>
        <title>Welcome to Food Ordering System</title>
        <style>
            ul {
              list-style-type: none;
              margin: 0;
              padding: 0;
              overflow: hidden;
              background-color: #333;
            }
            
            li {
              float: left;
            }
            
            li a {
              display: block;
              color: white;
              text-align: center;
              padding: 14px 16px;
              text-decoration: none;
            }
            
            li a:hover:not(.active) {
              background-color: #111;
            }
            
            .active {
              background-color: #04AA6D;
            }
            .split {
                
                width: 50%;
                position: fixed;
            }
            .left {
                left: 0;
                width: 75%;
                position: fixed;
                background-color: white;
            }   

            .right {
                right: 0;
                width: 25%;
                position: fixed;
                background-color: white;
            }
            </style>
    </head>
    <body>
        <ul>
            <li><a class="active" href="index.php">Home</a></li>
            <li><a href="restaurants.php">Restaurants</a></li>
            <li><a href="dishes.php">Dishes</a></li>
            <li><a href="contact.php">Contact Us</a></li>
          </ul>
    <br>
    <br>
    <div class="left">
    <div>
        <h1>Contact Us</h1>
        <form method="post">
        Name: <br><input type="text"><br><br>
        Email: <br><input type="text"><br><br>
        Comments: <br><textarea></textarea><br><br>
        <input type="button" id="btn1" value="Submit"><br>
        </form>    
    </div>
    <br>
    <br>
    <div>
        <h1>Comments</h1>
        <p>Please share your comments! We value your comments!</p>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        Name: <br><input type="text" id="names" name="names"><br><br>
        Comments: <br><textarea id="comment" name="comment"></textarea><br><br>
        <input type="submit" id="btn2" name="btn2" value="Submit"><br>
        </form> 
    </div>
        </div>
    <div class="right">
            <h3>Comments: </h3>
            <?php
            $sql="SELECT comment from comments ORDER BY id DESC LIMIT 10";
            $result=mysqli_query($db,$sql);
            if (mysqli_num_rows($result) > 0) {
                // output data of each row
                while($row = mysqli_fetch_assoc($result)) {
                  echo "Anonymous: " . $row["comment"]."<br>";
                }
              } else {
                echo "0 results";
              }
            ?>
    </div>
    <?php
    if(isset($_POST["btn2"])=="POST")
    {

        $user_name =  $_REQUEST['names'];
        $comment = $_REQUEST['comment'];
        $sql = "INSERT INTO comments (name,comment) VALUES ('$user_name', '$comment')";
        mysqli_query($db, $sql);
    }
    
    ?>
</body>
</html>