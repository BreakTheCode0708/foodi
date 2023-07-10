<?php
include("connection/connect.php");  //include connection file
error_reporting(0);  // using to hide undefine undex errors
session_start(); //start temp session until logout/browser closed
?>
<!DOCTYPE html>
<html>
    <head>
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
            .image{
                width=100px;
            }
            </style>
</head>
<body>
<body class="home">
    <div>
        <!--header starts-->
        <ul>
            <li><a class="active" href="index.php">Home</a></li>
            <li><a href="restaurants.php">Restaurants</a></li>
            <?php
						if(empty($_SESSION["user_id"])) // if user is not logged in
							{
								echo '<li><a href="login.php">Login</a> </li>';
                                echo '<li><a href="registration.php">Sign Up</a> </li>';
							}
						else
							{
									//if user is logged in
									
									echo  '<li><a href="your_orders.php">Your Orders</a> </li>';
                                    echo '<li><a href="wallet.php">Add Wallet Amount</a></li>';
									echo  '<li><a href="logout.php">logout</a> </li>';
							}

			?>
                                    <li><a href="comments.php">Contact Us</a></li>

        
                        </div> 

        <div>
            <h1>Add amount to your wallet</h1>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            Enter card number: <br><input type="text" name="card" id="card"><br>
            Enter CVV: <br><input type="password" id="cvv" name="cvv"><br>
            Enter Amount: <br><input type="text" name="amount" id="amount"><br><br>
            <input type="submit" value="Tranfer" id="sub" name="sub" onclick="myfunction()">
        </form>
            <script>
              
            </script>
                        </div>
                        <div>
        <h1>Comments</h1>
        <p>Please share your comments! We value your comments!</p>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        Name: <br><input type="text" id="names" name="names"><br><br>
        Comments: <br><textarea id="comment" name="comment"></textarea><br><br>
        <input type="submit" id="btn2" name="btn2" value="Submit"><br>
        </form> 
    </div>
                        <script>
                            function myfunction()
                            {
                                alert("Successful Transaction!")
                            }
                            </script>
                            <?php
                                if(isset($_POST["sub"])=="POST")
                                {
                                    $balamt=0;
                                    $cardnumber =  $_REQUEST["card"];
                                    $amount = $_REQUEST["amount"];
                                    $userid=$_SESSION["user_id"];
                                    $username=$_SESSION["username"];
                                    
                                    $sql1="SELECT COUNT(*) from wallet where userid=$userid";
                                    $result1=mysqli_query($db,$sql1);
                                    if(mysqli_num_rows($result1)>0)
                                    {
                                      while($row=mysqli_fetch_assoc($result1))
                                      {
                                        $count=$row['COUNT(*)'];
                                      }
                                      
                                      if($count==0)
                                      {
                                        $balamt=$amount;
                                        $sql = "INSERT INTO wallet (userid,card,amount) VALUES ($userid,'$cardnumber',$amount)";
                                        mysqli_query($db, $sql);
                                      }
                                      else
                                      {
                                        $sql2="SELECT SUM(amount) from wallet where userid=$userid";
                                        $result2=mysqli_query($db,$sql2);
                                        if (mysqli_num_rows($result2) > 0) {
                                          // output data of each row
                                          while($row = mysqli_fetch_assoc($result2)) {
                                            
                                            $amount=$amount+$row['SUM(amount)'];
                                          }
                                          $balamt=$amount;
                                          $sql3="UPDATE wallet SET amount=$amount where userid=$userid";
                                          mysqli_query($db, $sql3);

                                        } else {
                                          echo "";
                                          
                                        }
                                      }
                                    }
                                    
                                    echo "Your balance amount is: ".$balamt;
                                    

                                    //$sql="INSERT INTO wallet values(12,13,'123456','1200')";
                                }
                            ?>

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