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
            <?php 
                    $userId = $_SESSION['id'];
                    $query = "SELECT * FROM users WHERE users.id =  $userId";
                    $results1 = mysqli_query($conn, $query);
                    $user = mysqli_fetch_assoc($results1);
                
                ?>
            <div class="top_bar">

                <form action="voters.php" method="get">
                    <?php if($user['userType']=== 'admin'): ?>
                    <div class="search_now">
                        <input placeholder="Search now" class="draft" name="voter_name" />
                    </div>
                    <?php endif; ?>
                </form>

                <div class="profile_info">

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
                    <?php if($user['userType'] === 'admin' || $user['userType'] === 'election_officer' ): ?>
                    <p><a href="./voters.php">Voters</a></p>
                    <?php endif ?>
                    <p><a href="./account.php">Profile</a></p>
                    <p><a href="./logout.php">Logout</a></p>
                </div>
                <div class="container_content">
                    <div class="main">

                        <div class="content_flex">

                            <?php if($user['userType'] === 'admin'): ?>

                            <?php 
                                    
                                    $userId = $_SESSION['id'];
                                    $query4 = "SELECT COUNT(*) as total_admin FROM users WHERE users.userType = 'admin'";
                                    $results1 = mysqli_query($conn, $query4);
                                    $user4 = mysqli_fetch_assoc($results1);
                                    $totalAdmin = $user4['total_admin'];


                                    $query1 = "SELECT COUNT(*) as total_officer FROM users WHERE users.userType = 'election_officer'";
                                    $results2 = mysqli_query($conn, $query1);
                                    $user1 = mysqli_fetch_assoc($results2);
                                    $totalOfficer = $user1['total_officer'];


                                    $query2 = "SELECT COUNT(*) as total_voter FROM users WHERE users.userType = 'voter'";
                                    $results3 = mysqli_query($conn, $query2);
                                    $user5 = mysqli_fetch_assoc($results3);
                                    $totalVoter = $user5['total_voter'];
                                    ?>
                            <div class="sale_revenue_content">
                                <div class="sale">
                                    <div class="sale_1">
                                        <p>Total Admin</p>
                                    </div>
                                    <div class="sales_number">
                                        <p><?php echo   $totalAdmin; ?></p>
                                    </div>
                                    <div class="sales_percent">
                                        <p><span>0.12%</span></p>
                                        <p>(30 days)</p>
                                    </div>
                                </div>
                                <div class="revenue">
                                    <div class="revenue_1">
                                        <p>Total Election Officer</p>
                                    </div>
                                    <div class="revenue_number">
                                        <p><?php echo $totalOfficer ?></p>
                                    </div>
                                    <div class="revenue_percent">
                                        <p><span>0.47%</span></p>
                                        <p> (30 days)</p>
                                    </div>
                                </div>
                                <div class="download">
                                    <div class="download_1">
                                        <p>Total Voters</p>
                                    </div>
                                    <div class="download_number">
                                        <p><?php echo  $totalVoter ?></p>
                                    </div>
                                    <div class="download_percent">
                                        <p><span>64.00%</span></p>
                                        <p>(30 days)</p>
                                    </div>
                                </div>
                            </div>
                            <?php endif; ?>

                            <?php if($user['userType']=== 'voter' || $user['userType']=== 'election_officer'): ?>
                            <div class="info_box">
                                <div class="info_details">
                                    <p>Welcome <?php echo $user['first_name'] ?>,</p>
                                </div>
                                <div class="details">
                                    <p style="font-weight: bold;">Upcoming Elections</p>
                                    <ul>
                                        <li>31st of june 2025</li>
                                        <li>7st of july 2025</li>
                                        <li>31st of june 2025</li>
                                    </ul>
                                </div>

                            </div>
                            <?php endif; ?>


                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>

</body>

</html>