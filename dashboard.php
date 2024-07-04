<?php 
      session_start(); 
      require_once "conn.php";
      if (!isset($_SESSION['email'])) {
        header('location: signup.php');
      }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="css/dashboard.css">

</head>

<body>
    <div class="wrapper">
        <header>
            <p class="logo">Voting Brook</p>
            <div class="top_bar">
                <div class="search_now">
                    <input placeholder="Search now" class="draft" />
                </div>
                <div class="profile_info">
                    <?php 
                    $userId = $_SESSION['id'];
                    $query = "SELECT * FROM users WHERE users.id =  $userId";
                    $results1 = mysqli_query($conn, $query);
                    $user = mysqli_fetch_assoc($results1);
                
                ?>
                    <p>status: <span class="status"><?php echo $user['userType'] ?></span> </p>
                    <img src="images/face28.jpg" alt="face28">
                    <p> <?php echo $user['last_name'];?> <?php echo $user['first_name']; ?></p>
                </div>
            </div>
        </header>
        <div class="container">
            <div class="display_flex">
                <div class="sidebar">
                    <p><a href="./dashboard.php" class="active">Dashboard</a></p>
                    <p><a href="./voters.php">Voters</a></p>
                    <p><a href="./account.php">Profile</a></p>
                    <p><a href="./logout.php">Logout</a></p>
                </div>
                <div class="container_content">

                    <div class="main">
                        <div class="content_flex">
                            <div class="sale_revenue_content">
                                <div class="sale">
                                    <div class="sale_1">
                                        <p>SALES</p>
                                    </div>
                                    <div class="sales_number">
                                        <p>34040</p>
                                    </div>
                                    <div class="sales_percent">
                                        <p><span>0.12%</span></p>
                                        <p>(30 days)</p>
                                    </div>
                                </div>
                                <div class="revenue">
                                    <div class="revenue_1">
                                        <p>REVENUE</p>
                                    </div>
                                    <div class="revenue_number">
                                        <p>47033</p>
                                    </div>
                                    <div class="revenue_percent">
                                        <p><span>0.47%</span></p>
                                        <p> (30 days)</p>
                                    </div>
                                </div>
                                <div class="download">
                                    <div class="download_1">
                                        <p>DOWNLOAD</p>
                                    </div>
                                    <div class="download_number">
                                        <p>40016</p>
                                    </div>
                                    <div class="download_percent">
                                        <p><span>64.00%</span></p>
                                        <p>(30 days)</p>
                                    </div>
                                </div>
                            </div>
                            <div class="sales_details_box">
                                <div class="sales_details">
                                    <p>SALES DETAILS</p>
                                </div>
                                <div class="details">
                                    <p>Received overcame oh sensible so at an. Formed do change merely to</p>
                                    <p>county it. Am separate contempt domestic to to oh. On relation my so</p>
                                    <p>addition branched</p>
                                </div>
                                <div class="dropdown_flex">
                                    <div class="down_flex_1">

                                    </div>
                                    <div class="down_flex_1">
                                        <p>Today</p>
                                    </div>
                                    <div class="down_flex_1">
                                        <p>View all</p>
                                    </div>
                                </div>
                            </div>

                            <div class="main_2">
                                <div class="detailed">
                                    <div class="detailed_reports">
                                        <p>DETAILED REPORTS</p>
                                    </div>
                                    <div class="report_numbers">
                                        <h1>33500</h1>
                                        <p>Sales</p>
                                    </div>
                                    <div class="report_info">
                                        <p> The total number of sessions within the date range. It is</p>
                                        <p>the period time a user is actively engaged with your</p>

                                        <p>website, page or app, etc</p>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>

</body>

</html>