<?php
ob_start();
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['auth'])) {
    header("location: ../Master/index_master.php");
}
?>
<div class="container">
    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="col-xl-10 col-lg-12 col-md-9">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <a href="../../View/Master/index_master.php" class="col-lg-6 d-none d-lg-block ">
                            <img src="../../public/profile_image/StackBookLogo.jpg" alt="">
                        </a>
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Stack Book!</h1>
                                </div>
                                <?php
                                if (isset($_SESSION['message'])) {
                                ?>
                                    <div class="alert alert-success text-center">
                                        <strong>
                                            <?php
                                            echo $_SESSION['message'];
                                            unset($_SESSION['message']);
                                            ?>
                                        </strong>
                                    </div>
                                <?php
                                } ?>

                                <form class="user" action="../../Back_End/Controller/user_master_controller.php" method="POST">
                                    <span class="error_red">
                                        <?php
                                        if (isset($_SESSION['messageErr'])) {
                                            echo $_SESSION['messageErr'];
                                            unset($_SESSION['messageErr']);
                                        }
                                        ?>
                                    </span>
                                    <input type="text" name="crud" value="user-login" hidden>
                                    <div class="form-group">
                                        <input type="tel" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter mobile" name="mobile" maxlength="12" minlength="10">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-user" id="exampleInputPassword" name="password" placeholder="Password">
                                    </div>

                                    <button type="submit" class="btn btn-primary btn-user btn-block">Login</button>
                                    <hr>
                                </form>
                                <div class="text-center">
                                    <a class="small nav-link" href="registration_form.php">Create an account!
                                        <strong title="click to registration" class="text-primary"><u>registration</u></strong></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>
<?php
$content = ob_get_contents();
ob_clean();
require_once('../Master/index_master.php');
?>