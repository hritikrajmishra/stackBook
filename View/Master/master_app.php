<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['auth'])) {
    header("location: ../Auth/login_form.php");
}
if($_SESSION['auth']->{'role_id'}!==1){
    header("location: ../Auth/login_form.php");
}

// to get path of database connection
require_once "../../Back_End/Config/db_master_connection.php";
require_once "../../Back_End/Model/user_master.php";
require_once "../../Back_End/Model/post_master.php";
// object of DatabaseConnection Class
$database = new DatabaseConnection();
$conn = $database->get_connection();
// user count 
$user_count = new UserMaster($conn);
$user_post_count = new PostMaster($conn);

// var_dump($user_count->users());
// die();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Stack Book</title>
    <!-- Custom fonts for this template-->
    <link href="../../public/css/all.min.css" rel="stylesheet" type="text/css">
    <!-- Custom styles for this template-->
    <link href="../../public/css/sb-admin-2.min.css" rel="stylesheet">

    <link href="../../public/css/jquery.dataTables.css" rel="stylesheet">
    <link href="../../public/css/jquery.dataTables.min.css" rel="stylesheet">

    <script>
        function PostDelete(id, name) {
            if (confirm("Do you really want to delete this post! Please make sure!") == true) {
                window.location.href = `../../Back_End/Controller/user_master_controller.php?wp=${id}&dsa&${name}=post-delete`;
            }
        }
        function TopicDelete(id, name) {
            if (confirm("Do you really want to delete this post! Please make sure!") == true) {
                window.location.href = `../../Back_End/Controller/user_master_controller.php?wp=${id}&dsa&${name}=topic-delete`;

            }
        }
        function UserDelete(id, name) {

            console.log(id);
            console.log(name);
            if (confirm("Do you really want to delete this post! Please make sure!") == true) {
                window.location.href = `../../Back_End/Controller/user_master_controller.php?wp=${id}&dsa&${name}=user-delete`;

            }
        }
    </script>
</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="navbar-nav bg-primary bg-gradient py-4  sidebar sidebar-dark accordion" id="accordionSidebar">
            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center"
                href="../../View/Master/master_app.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Stack Book</div>
            </a>
            <!-- Divider -->
            <hr class="sidebar-divider my-0">
            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link sidebar-brand" href="../Master/index_master.php">
                    <i class="fa fa-home"></i>
                    <span>Home Feed</span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link sidebar-brand" href="../../View/Master/master_app.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider">
            <!-- Heading -->
            <div class="sidebar-heading text-light">
                Details
            </div>
            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item active">
                <a class="nav-link collapsed sidebar-brand" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fa fa-book"></i>
                    <span>Post/Topic</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="../Topic/topic_list.php">Topic</a>
                    </div>
                </div>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="../Post/post_list.php">Post list</a>
                    </div>
                </div>
            </li>
            <li class="nav-item active">
                <a class="nav-link collapsed sidebar-brand" href="#" data-toggle="collapse" data-target="#collapseThree"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fa fa-book"></i>
                    <span>Users</span>
                </a>
                <div id="collapseThree" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="../Admin/users_list.php">List</a>
                    </div>
                </div>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">
            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">

            </div>
            <!-- Sidebar Message -->
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
                    <!-- Topbar Search -->
                    <form
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                                aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <div class="topbar-divider d-none d-sm-block"></div>
                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-3 d-none d-lg-inline text-gray-600 medium">
                                    <?php echo $_SESSION['auth']->{'name'} ?>
                                </span>
                                <img class="img-profile rounded-circle m-2 "
                                    src="../../public/profile_image/<?php echo $_SESSION['auth']->{'profile_img'} ?>">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in border border-primary"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item text-primary" href="../Admin/admin_profile.php">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item text-success" href="../Auth/change_password_form.php">
                                    <i class="fas fa-lock mr-2 text-gray-400"></i>
                                    change-password
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item text-danger"
                                    href="../../Back_End/Controller/user_master_controller.php?crud=user-logout">
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
                    <div class="">

                        <?php
                        if (isset($content)) {
                            echo isset($content) ? $content : " ";
                        } else { ?>
                            <div class="text-center">
                                <h1>WELCOME TO STACK BOOK</h1>
                            </div>
                            <hr>
                            <?php
                            if (isset($_SESSION['message'])) {
                                ?>
                                <div class="alert alert-success alert-dismissible text-center">
                                    <strong>
                                        <?php echo $_SESSION['message'] ?>
                                    </strong>
                                </div>

                            <?php }
                            unset($_SESSION['message']);
                            ?>

                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-3">
                                        <div class="border border-primary rounded">
                                            <div>
                                                <h4 class="p-4 text-center text-danger">Users</h4>
                                            </div>
                                            <div class="border">
                                                <h1 style="text-align:center">
                                                    <?php echo $user_count->users() ?>
                                                </h1>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="border border-primary rounded">
                                            <div>
                                                <h4 class="p-4 text-center text-danger">Post</h4>
                                            </div>
                                            <div class="border">
                                                <h1 style="text-align:center">
                                                    <?php echo $user_post_count->users_post() ?>
                                                </h1>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        <?php }


                        ?>
                    </div>
                    <!-- Content Row -->
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->
            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Stack Book
                            <?php echo date('Y'); ?>
                        </span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->
        </div>
        <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    <script src="../../public/js/stackbook.js"></script>
    <!-- Bootstrap core JavaScript-->
    <script src="../../public/js/jquery/jquery.min.js"></script>
    <script src="../../public/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <!-- Custom scripts for all pages-->
    <script src="../../public/js/jquery/jquery.dataTables.js"></script>
    <script src="../../public/js/jquery/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#PostData').dataTable();

        });
    </script>
</body>

</html>