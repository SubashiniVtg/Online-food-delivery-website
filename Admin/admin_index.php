<?php
session_start();
include "../inc/dbh.inc.php";
if (!isset($_SESSION['ad_uname'])) {
 header("Location: ../../../ffc/index.php");
 exit();
}

?>
<?php
$totalorder=0;
$total = 0;
 $sql = "SELECT * FROM foodorders ORDER BY orderid DESC;";
 $result = mysqli_query($con, $sql);
 $resultcheck = mysqli_num_rows($result);

 if ($resultcheck > 0) {
    $totalorder =  $resultcheck;  
    $total = 0;
    while ($row = mysqli_fetch_assoc($result)) {
      $total += $row['totalprice'];
    }
    //echo $total;
  }

  $fire = "SELECT * FROM foodorders WHERE res_status = 'waiting';";
  $result = mysqli_query($con, $fire);
  $resultcheck = mysqli_num_rows($result);
 
  $q = "SELECT * FROM delivery WHERE delivery_status = 'delivered';";
  $results = mysqli_query($con, $q);
  $resultchecks = mysqli_num_rows($results);
  $deliveryresult = $resultchecks;

  $query = "SELECT * FROM delivery WHERE delivery_status = 'delivering';";
  $qresults = mysqli_query($con, $query);
  $qresultchecks = mysqli_num_rows($qresults);
  $qdeliveryresult = $qresultchecks;
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>FOOD COURT - Admin-Home</title>

  <!-- Custom fonts for this template-->
  <script src="https://kit.fontawesome.com/041a644664.js" crossorigin="anonymous"></script>
  <link href="https://fonts.googleapis.com/
  css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Food Court Admin</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item active">
        <a class="nav-link" href="admin_index.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!--Restaurent-->
      <li class="nav-item">
        <a class="nav-link" href="admin_restaurent.php">
          <i class="fas fa-user"></i>
          <span>Restaurents</span></a>
      </li>
      <!--Restaurent-->

       <!-- Divider -->
      <hr class="sidebar-divider">

      <!--Delivery Boys-->
      <li class="nav-item">
        <a class="nav-link" href="admin_dboy.php">
          <i class="fas fa-user"></i>
          <span>Delivery Boys</span></a>
      </li>
      <!--Delivery Boys-->

       <!-- Divider -->
      <hr class="sidebar-divider">
      
      <!--Profile-->
      <li class="nav-item">
        <a class="nav-link" href="admin_profile.php">
          <i class="fas fa-user"></i>
          <span>Profile</span></a>
      </li>
      <!--Profile-->

       <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>
           
           <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">
    
               
            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $_SESSION['ad_uname']; ?></span>
                <img class="img-profile rounded-circle" src="https://source.unsplash.com/QAB-WJcbgJk/60x60">
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="admin_profile.php">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Profile
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800">Hi <?php echo $_SESSION['ad_uname']; ?>, Welcome to Food Court</h1>

          <div class="row">
           
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Orders</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $totalorder; ?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Annual) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Earnings</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">&#8377; <?php echo $total; ?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Tasks Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Delivery</div>
                      <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                          <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo $deliveryresult; ?></div>
                        </div>
                    
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Restaurent Pending Requests</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $resultcheck; ?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-comments fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Delivery Pending</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $qdeliveryresult; ?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-comments fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-xl-3 col-md-6 mb-4">
            <h4><strong>Contact Information</strong></h4>
            <?php
            $sql = "SELECT * FROM contact LIMIT 10;";
            $result = mysqli_query($con, $sql);
            $resultcheck = mysqli_num_rows($result);
            if ($resultcheck > 0) {
            ?>

            <table class="table table-responsive-md table-striped">
              <thead>
                <tr>
                  <th>User Name</th>
                  <th>User Email</th>
                  <th>Issues/suggestions</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  while ($row = mysqli_fetch_assoc($result)) {
                ?>
                <tr>
                  <td> Subashini</td>
                  <td> Subashini26@gmail.com</td>
                  <td> perfect 5 star</td>

                <!-- <td><?php echo $row['username']; ?></td>
                  <td><?php echo $row['email']; ?></td>
                  <td><?php echo $row['textarea']; ?></td> --> -->
                </tr>
                <?php   
                  } 
                ?>
              </tbody>
            </table>
            <?php
            } else {
                    echo "<p class='alert alert-primary'>No message Yet</p>";
                  }
            ?>
          </div>

        </div>
        <!-- /.container-fluid -->
         
      </div>
      <!-- End of Main Content -->

      

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>

        <form method="POST" action="includes/logout.inc.php">
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <button class="btn btn-primary" name="submit">Logout</button>
        </div>
      </form>

      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

</body>

</html>
