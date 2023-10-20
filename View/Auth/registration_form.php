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
    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
            <div class="row">
                <a href="../../index.php" class="col-lg-5 d-none d-lg-block">
                    <img src="../../public/profile_image/StackBookLogo.jpg" alt="">
                </a>
                <div class="col-lg-7">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                        </div>
                        <form class="user" action="../../Back_End/Controller/user_master_controller.php" method="POST"
                            enctype="multipart/form-data">
                            <span class="error_red">
                                <?php
                                if (isset($_SESSION['messageErr'])) {
                                    echo $_SESSION['messageErr'];
                                    unset($_SESSION['messageErr']);
                                }
                                ?>
                            </span>
                            <input type="text" name="crud" value="user-registration" hidden>
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="text" class="form-control form-control-user" name="full_name"
                                        placeholder="Enter your name">
                                    <?php if (isset($_SESSION['nameErrR'])) {
                                        ?>
                                        <span class="error_red">
                                            <?php
                                            echo $_SESSION['nameErrR'];
                                            unset($_SESSION['nameErrR']);
                                            ?>
                                        </span>
                                        <?php
                                    } ?>
                                </div>
                                <div class="col-sm-6">
                                    <input type="email" class="form-control form-control-user" name="email"
                                        placeholder="Enter email">
                                    <?php if (isset($_SESSION['emailErrR'])) {
                                        ?>
                                        <span class="error_red">
                                            <?php
                                            echo $_SESSION['emailErrR'];
                                            unset($_SESSION['emailErrR']);
                                            ?>
                                        </span>
                                        <?php
                                    } ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="file" class="form-control form-control-user" name="profile_img"
                                        accept="image/png, image/gif, image/jpeg">
                                    <?php if (isset($_SESSION['imageErrR'])) {
                                        ?>
                                        <span class="error_red">
                                            <?php
                                            echo $_SESSION['imageErrR'];
                                            unset($_SESSION['imageErrR']);
                                            ?>
                                        </span>
                                        <?php
                                    } ?>
                                </div>
                                <div class="col-sm-6">
                                    <input type="tel" class="form-control form-control-user" name="mobile"
                                        placeholder="Enter mobile number" minlength="10" maxlength="10">
                                    <?php if (isset($_SESSION['mobileErrR'])) {
                                        ?>
                                        <span class="error_red">
                                            <?php
                                            echo $_SESSION['mobileErrR'];
                                            unset($_SESSION['mobileErrR']);
                                            ?>
                                        </span>
                                        <?php
                                    } ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="password" class="form-control form-control-user" name="password"
                                        placeholder="enter password">
                                    <?php if (isset($_SESSION['passwordErrR'])) {
                                        ?>
                                        <span class="error_red">
                                            <?php
                                            echo $_SESSION['passwordErrR'];
                                            unset($_SESSION['passwordErrR']);
                                            ?>
                                        </span>
                                        <?php
                                    } ?>
                                </div>
                                <div class="col-sm-6">
                                    <input type="password" class="form-control form-control-user" name="re_password"
                                        placeholder="re-enter password"><br>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-user btn-block">Registration</button>

                            <hr>
                            <span class="error_red col-sm-12">
                                <?php if (isset($_SESSION['passwordErrR'])) {
                                    echo $_SESSION['passwordErrR'];
                                    unset($_SESSION['passwordErrR']);
                                } ?>
                            </span>
                        </form>
                        <div class="text-center">
                            <a class="small nav-link" href="login_form.php">Already have an account?
                                <strong title="click to login" class="text-primary"><u>Login!</u></strong></a>
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