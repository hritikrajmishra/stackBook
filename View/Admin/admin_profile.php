<?php
ob_start();
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION["login"]) && isset($_SESSION["admin-login"])) {
    header("location: ../Auth/login_form.php");
    return;
}
require_once "../../Back_End/Config/db_master_connection.php";
$database = new DatabaseConnection();
$conn = $database->get_connection();
require_once "../../Back_End/Model/user_master.php";
// TODO: Remove this model function, becoz we manage the session of that query already(complete)
// $userMaster = new UserMaster($conn);
// $result_user = $userMaster->get_user_data($_SESSION['auth']->{'id'});


// var_dump($_SESSION['auth']);

?>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-4">
            <div class="card border border-primary" style="width:400px">
                <img class="card-img-top p-2"
                    src="../../public/profile_image/<?php echo $result_user->{'profile_img'}; ?>" alt="Card image"
                    style="width:100%">
                <hr>
                <div class="card-body text-center">
                    <h4 class="card-title text-primary">
                        <?php echo $result_user->{'name'}; ?>
                    </h4>
                    <p class="card-text"><strong>email:</strong>
                        <?php echo $result_user->{'email'}; ?>
                    </p>
                    <p class="card-text"><strong>mobile:</strong>
                        <?php echo $result_user->{'mobile'}; ?>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-sm-8">
            <div class="card border-0 shadow-lg">
                <div class="p-5">
                    <div class="text-center">
                        <h1 class="h4 text-gray-900 mb-4">Profile!</h1>
                        <hr>
                    </div>
                    <form class="user row" action="../../Back_End/Controller/user_master_controller.php" method="POST"
                        enctype="multipart/form-data">
                        <div class="text-center">
                        <span>
                            <?php
                            if (isset($_SESSION['messageErr'])) {
                                ?>
                                <div class="alert alert-success text-center">
                                    <strong>
                                        <?php
                                        echo $_SESSION['messageErr'];
                                        unset($_SESSION['messageErr']);
                                        ?>
                                    </strong>
                                </div>
                                <?php
                            } ?>
                        </span></div><br>
                        <input type="text" name="crud" value="user-edit" hidden>
                        <input type="text" name="id" value="<?php echo $_SESSION['auth']->{'id'}; ?>" hidden>
                        <div class="form-group col-12">
                            <input type="file" class="form-control form-control-user" name="edit_image"
                                   accept="image/png, image/gif, image/jpeg">
                        </div>
                        <div class="form-group col-6">
                            <input type="text" class="form-control form-control-user" name="edit_name"
                                value="<?php echo $result_user->{'name'}; ?>">
                        </div>
                        <div class="form-group col-6">
                            <input type="email" class="form-control form-control-user" name="edit_mail"
                                value="<?php echo $result_user->{'email'}; ?>">
                        </div>

                        <div class="form-group col-4"></div>
                        <div class="form-group col-4">
                            <button type="submit" class="btn btn-success btn-user btn-block">Save Changes</button>
                        </div>
                        <br>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
$content = ob_get_contents();
ob_clean();
require_once('../Master/master_app.php');
?>