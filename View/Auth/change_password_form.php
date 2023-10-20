<?php
ob_start();
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (isset($_SESSION['auth'])) {
    if ($_SESSION['auth']->{'role_id'} == '1' && $_SESSION['auth']->{'role_id'} == '2') {
        header("location: ../Auth/login_form.php");
        return;
    }
}

// var_dump($_SESSION['auth']->{'id'});
// die();
?>
<div class="container">
    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg-5 d-none d-lg-block">
                    <img src="../../public/profile_image/StackBookLogo.jpg" alt="">
                </div>
                <div class="col-lg-7">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Change Password!</h1>
                            <hr>
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
                        <form class="user" action="../../Back_End/Controller/user_master_controller.php" method="POST" enctype="multipart/form-data">
                            <input type="text" name="crud" value="change-user-password" hidden>
                            <input type="text" name="user_id" value="<?php echo $_SESSION['auth']->{'id'}; ?>" hidden>
                            <div class="form-group row">
                                <div class="col-sm-12 mb-3 mb-sm-0">
                                    <input class="form-control form-control-user" type="password" name="current_password" placeholder="enter current password">
                                </div>
                                <div class="col-sm-6 mt-3">
                                    <input class="form-control form-control-user" type="password" name="new_password" placeholder="enter new password">
                                </div>
                                <div class="col-sm-6 mt-3">
                                    <input class="form-control form-control-user" type="password" name="re_password" placeholder="re enter newpassword">
                                </div>
                            </div>
                            <hr>

                            <button type="submit" class="btn btn-success btn-user btn-block">Save</button>

                            <div class="text-center">
                                <a class="small nav-link" href="../../index.php"> cancel changes
                                    <u class="text-primary">go back</u></a>
                            </div>
                    </div>
                    </form>
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