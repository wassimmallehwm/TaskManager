

    <!-- Side Navbar -->
    <nav class="side-navbar">
      <div class="side-navbar-wrapper">
        <!-- Sidebar Header    -->
        <div class="sidenav-header d-flex align-items-center justify-content-center">
          <!-- User Info-->
          <div class="sidenav-header-inner text-center"><img src="<?php echo Session::get('pic'); ?>" alt="person" class="img-fluid rounded-circle">
            <h2 class="h5"><?php echo Session::get('username'); ?></h2>
          </div>
          
          <div class="sidenav-header-logo"><a href="index.html" class="brand-small text-center "> <strong>T</strong><strong class="text-primary">M</strong></a></div>
        </div>
        <!-- Sidebar Navigation Menus-->
        <div class="main-menu">
          <ul id="side-main-menu" class="side-menu list-unstyled">

              <li><a href="home.php"> <i class="icon-home"></i>Home</a></li>
            <li><a href="#employeeDropDown" aria-expanded="false" data-toggle="collapse"> <i class="icon-user"></i>Employees</a>
              <ul id="employeeDropDown" class="collapse list-unstyled ">
                <li><a href="employees.php">Employees</a></li>
                <li><a href="add_employee.php">Add Employee</a></li>
              </ul>
            </li><li><a href="#ClientDropDown" aria-expanded="false" data-toggle="collapse"> <i class="icon-user"></i>Clients</a>
                  <ul id="ClientDropDown" class="collapse list-unstyled ">
                      <li><a href="clients.php">Clients</a></li>
                      <li><a href="add_client.php">Add Client</a></li>
                  </ul>
              </li>
            <li><a href="#taskDropDown" aria-expanded="false" data-toggle="collapse"> <i class="icon-list"></i>Tasks</a>
              <ul id="taskDropDown" class="collapse list-unstyled ">
                <li><a href="all_tasks.php">Tasks</a></li>
                <li><a href="add_task.php">Add task</a></li>
              </ul>
            </li>

          </ul>
        </div>
      </div>
    </nav>
    <div class="page">
      <!-- navbar-->
      <header class="header">
        <nav class="navbar">
          <div class="container-fluid">
            <div class="navbar-holder d-flex align-items-center justify-content-between">
              <div class="navbar-header"><a id="toggle-btn" href="#" class="menu-btn"><i class="icon-bars"> </i></a></div>
              <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center">
               
                <!-- Languages dropdown   
                <li class="nav-item dropdown"><a id="languages" rel="nofollow" data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link language dropdown-toggle"><img src="img/flags/16/GB.png" alt="English"><span class="d-none d-sm-inline-block">English</span></a>
                  <ul aria-labelledby="languages" class="dropdown-menu">
                    <li><a rel="nofollow" href="#" class="dropdown-item"> <img src="img/flags/16/DE.png" alt="English" class="mr-2"><span>German</span></a></li>
                    <li><a rel="nofollow" href="#" class="dropdown-item"> <img src="img/flags/16/FR.png" alt="English" class="mr-2"><span>French                                                         </span></a></li>
                  </ul>
                </li>
                Log out-->
                <li class="nav-item"><a href="logout.php" class="nav-link logout"> <span class="d-none d-sm-inline-block">Logout</span><i class="fa fa-sign-out"></i></a></li>
              </ul>
            </div>
          </div>
        </nav>
      </header>
      <!-- Header Section-->