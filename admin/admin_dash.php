<?php
    session_start();
    include("../config/connection.php");
    $sql = "SELECT * FROM user";
    $result=mysqli_query($conn, $sql);
    $customers = mysqli_num_rows( $result );

    $sql1 = "SELECT * FROM shopowner";
    $result1=mysqli_query($conn, $sql1);
    $distributors = mysqli_num_rows( $result1 );

    $sql2="SELECT name,shopno FROM shopowner";
    $result3=mysqli_query($conn,$sql2);
    $rows=mysqli_fetch_all($result3,MYSQLI_ASSOC);

    $sql5 = "SELECT * FROM apply_stock";
    $result5=mysqli_query($conn, $sql5);
    $stock = mysqli_num_rows( $result5 );


	?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title> Admin Dashboard | E-Ration </title>
    <link rel="stylesheet" href="style.css">
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
<body>
  <div class="sidebar">
    <div class="logo-details">
      <img src="logo2.png" height="40px" weight="40px" style="margin-left: 10px">
      <img src="logo3.png" height="40px" weight="140px">
    </div>
    <ul class="nav-links">
      <li>
        <a href="#" class="active">
          <i class='bx bx-grid-alt' ></i>
          <span class="links_name">Dashboard</span>
        </a>
      </li>
      <li>
        <a href="add_dist.php">
          <i class='bx bx-user' ></i>
          <span class="links_name">Add Shopowner</span>
        </a>
      </li>
      
      <li>
        <a href="applied_stock.php">
          <i class='bx bx-list-ul' ></i>
          <span class="links_name">View Applied Stock</span>
        </a>
      </li>
      
      <li>
        <a href="stock_details.php">
          <i class='bx bx-coin-stack' ></i>
          <span class="links_name">Stock Details</span>
        </a>
      </li>
      
    
      <li class="log_out">
        <a href="logout.php">
          <i class='bx bx-log-out'></i>
          <span class="links_name">Log out</span>
        </a>
      </li>
    </ul>
  </div>
  <section class="home-section">
    <nav>
      <div class="sidebar-button">
        <i class='bx bx-menu sidebarBtn'></i>
        <span class="dashboard">Dashboard</span>
      </div>
      <div class="profile-details">
        <span class="admin_name">ADMIN</span>
      </div>
    </nav>

    <div class="home-content">
      <div class="overview-boxes">
        <div class="box">
          <div class="right-side">
            <div class="box-topic">Total Customers</div>
            <div class="number"><?php echo $customers; ?></div>
          </div>
          <i class='bx bxs-user-account cart four'></i>
        </div>
        <div class="box">
          <div class="right-side">
            <div class="box-topic">Total Shopowners</div>
            <div class="number"><?php echo $distributors; ?></div>
          </div>
          <i class='bx bxs-cart-add cart two' ></i>
        </div>
        <div class="box">
          <div class="right-side">
            <div class="box-topic">Requested Stock</div>
            <div class="number"><?php echo $stock; ?></div>
          </div>
          <i class='bx bx-cart cart three' ></i>
        </div>
       
      </div>

      <div class="sales-boxes">
        <div class="recent-sales box">
          <div class="title">Recent Requests</div>
          <div class="sales-details">
            <ul class="details">
              <li class="topic">Date</li>
              <li><?php
                    foreach($result5 as $request)
                    echo $request['date']."<br>";
                  ?>
            </li>
            </ul>
            <ul class="details">
            <li class="topic">Username</li>
            <li>
            <?php
                    foreach($result5 as $request)
                    echo $request['name']."<br>";
                  ?>
            </li>
          </ul>
          <ul class="details">
            <li class="topic">Shopno</li>
            <li>
            <?php
                    foreach($result5 as $request)
                    echo $request['shopno']."<br>";
                  ?>
            </li>
          </ul>
          <ul class="details">
            <li class="topic">Item</li>
            <li>
            <?php
                    foreach($result5 as $request)
                    echo $request['item']."<br>";
                  ?>
            </li>
          </ul>
          </div>
        </div>
        <div class="top-sales box">
          <div class="title">Shop Owner</div>
          <table cellspacing=10 style="font-size: 20px; margin-left: -10px;">
                <tr>
                    <td>
                        <div class="topic" style="font-weight: 500;"> Name</div>
                    </td>
                    <td>
                        <div class="topic" style="font-weight: 500;">Shop No</div>
                    </td>
					<td>
                        <div class="topic" style="font-weight: 500;" id="delete-distributor"></div>
                    </td>
                </tr>
			<tbody>
                <tr style="font-size: 16px;">
                    <td>
                    <?php
                        foreach($result3 as $row)
                            echo $row['name']."<br>";
                        ?>
                    </td>
                    <td style="text-align: center;">
                    <?php
                        foreach($result3 as $row)
                            echo $row['shopno']."<br>";
                        ?>
                    </td>
					<td style="text-align: center;">
                    <?php
                        foreach($result3 as $row)
						{?>
							<button style="background-color: #0A2558;"><a href="delete_distributor.php?pds=<?php echo $row['shopno']; ?>" style="color: #ffffff;text-decoration:none;">Suspend</a></button><br>
						<?php 
						}
						?>
                    </td>
                </tr>
			</tbody>
            </table>
        </div>
      </div>
  </section>
  <script>
   let sidebar = document.querySelector(".sidebar");
let sidebarBtn = document.querySelector(".sidebarBtn");
sidebarBtn.onclick = function() {
  sidebar.classList.toggle("active");
  if(sidebar.classList.contains("active")){
  sidebarBtn.classList.replace("bx-menu" ,"bx-menu-alt-right");
}else
  sidebarBtn.classList.replace("bx-menu-alt-right", "bx-menu");
}
 </script>

</body>
</html>
