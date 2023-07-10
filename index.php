<!DOCTYPE html>
<html lang="en">
<?php
include("connection/connect.php");  //include connection file
error_reporting(0);  // using to hide undefine undex errors
session_start(); //start temp session until logout/browser closed
?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
   
    <title>Food Easy</title>
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
            * {
                box-sizing: border-box;
            }

            .row {
                display: flex;
            }

/* Create three equal columns that sits next to each other */
.column {
  flex: 33.33%;
  padding: 5px;
}
            </style>
    

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

                            
	
        <!-- Popular block starts -->
        <section>
            <div>
                <div>
                    <h2>Popular Dishes of the Month</h2>
                    <p>The easiest way to your favourite food</p>
                </div>
                <div>			
						<?php 
						// fetch records from database to display popular first 3 dishes from table
                        echo '<div class="row">';
						$query_res= mysqli_query($db,"select * from dishes LIMIT 3"); 
									      while($r=mysqli_fetch_array($query_res))
										  {
													
						                       echo ' <div> 
														<div class="column">
                                                            <img src="admin/Res_img/dishes/'.$r['img'].'" style="width:100%">
														</div>
														
															<p><a href="dishes.php?res_id='.$r['rs_id'].'">'.$r['title'].'</a><p>
														<p>'.$r['slogan'].'</p>
                                                        <a href="dishes.php?res_id='.$r['rs_id'].'"><button style="background-color: red">Order Now</button>
												</div>';
													
										  }
						
						
						?>               
                </div>
            </div>
                                          <br>
            <div class="container">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="title-block pull-left">
                            <h4>Featured restaurants</h4></div>
                    </div>
                    <div class="col-sm-8">
                        <!-- restaurants filter nav starts -->
                        <div class="restaurants-filter pull-right">
                            <nav class="primary pull-left">
                                <ul>
                                    <li></li>
                                    <li><a href="#" class="selected" data-filter="*">all</a> </li>
									<?php 
									// display categories here
									$res= mysqli_query($db,"select * from res_category");
									      while($row=mysqli_fetch_array($res))
										  {
											echo '<li><a href="#" data-filter=".'.$row['c_name'].'"> '.$row['c_name'].'</a> </li>';
										  }
									?>
                                   
                                </ul>
                            </nav>
                        </div>
                        <!-- restaurants filter nav ends -->
                    </div>
                </div>
                <!-- restaurants listing starts -->
                <div class="row">
                    <div class="restaurant-listing">
                        
						
						<?php  //fetching records from table and filter using html data-filter tag
						$ress= mysqli_query($db,"select * from restaurant");  
									      while($rows=mysqli_fetch_array($ress))
										  {
													// fetch records from res_category table according to catgory ID
													$query= mysqli_query($db,"select * from res_category where c_id='".$rows['c_id']."' ");
													 $rowss=mysqli_fetch_array($query);
						
													 echo ' <div>
														<div class="restaurant-wrap">
															<div class="row">
																
																<!--end:col -->
																<div class="col-xs-12 col-sm-9 col-md-12 col-lg-9">
																	<h5><a href="dishes.php?res_id='.$rows['rs_id'].'" >'.$rows['title'].'</a></h5> <span>'.$rows['address'].'</span>
																	<div class="bottom-part">
																		
																		<div class="mins"><i class="fa fa-motorcycle"></i> 30 min</div>
																		<div class="ratings"> <span>
																				<i class="fa fa-star"></i>
																				<i class="fa fa-star"></i>
																				<i class="fa fa-star"></i>
																				<i class="fa fa-star"></i>
																				<i class="fa fa-star-o"></i>
																			</span> (122) </div>
																	</div>
																</div>
																<!-- end:col -->
															</div>
															<!-- end:row -->
														</div>
														<!--end:Restaurant wrap -->
													</div>';
										  }
						
						
						?>
						
							
						
					
                    </div>
                </div>
                <!-- restaurants listing ends -->
               
            </div>
        </section>
        <!-- Featured restaurants ends -->
        
        
    
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <script src="js/jquery.min.js"></script>
    <script src="js/tether.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/animsition.min.js"></script>
    <script src="js/bootstrap-slider.min.js"></script>
    <script src="js/jquery.isotope.min.js"></script>
    <script src="js/headroom.js"></script>
    <script src="js/foodpicky.min.js"></script>
</body>

</html>