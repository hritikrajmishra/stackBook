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
require "../../Back_End/config/db_master_connection.php";
require_once "../../Back_End/Model/user_master_model.php";

$database = new DatabaseConnection();
$conn = $database->get_connection();

session_start();
 ?>
<div class="container border-left border-3 border-primary shadow p-3 mb-5 rounded">
    <?php
    if (isset($_SESSION['message'])) {
        ?>
        <div class="alert alert-success alert-dismissible">
            <strong>
                <?php echo $_SESSION['message'] ?>
            </strong>
        </div>
    <?php }
     unset($_SESSION['message']);
    ?>

    <div class="text-center" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
        <img class="profile-user-img img-fluid rounded"
            src="../../public/profile_image/<?php echo $result->{'profile_img'} ?>" alt="User profile picture">
    </div><br><br>
    <form class="row g-3" action="../../Back_End/Controller/user_master_controller.php" method="POST"
        enctype="multipart/form-data">

        <div class="col-md-6">
            <input type="text" name="user-edit" hidden>
            <label for="profile image" class="form-label">Profile Image</label><br>
            <input type="file" class="form-control" value="<?php echo $result->{'profile_img'} ?>"
                name="profile_img" accept="image/png, image/gif, image/jpeg"><br>
        </div><br>
        <div class="col-md-6">
            <label for="exampleInputEmail1">Name</label><br>
            <input type="text" class="form-control" value="<?php echo $result->{'name'} ?>" name="fullname"><br>
        </div>
        <div class="col-md-6">
            <label for="exampleInputEmail1">Email</label><br>
            <input type="email" class="form-control" value="<?php echo $result->{'email'} ?>" name="email"><br>
        </div>
        <div class="col-md-6">
            <label for="exampleInputEmail1">Mobile</label><br>
            <input type="tel" class="form-control" value="<?php echo $result->{'mobile'} ?>" maxlength="12"
                minlength="10" name="mobile"><br>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </form>
</div>
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="text-center">
                    <img class="img-fluid" src="../../public/profile_image/<?php echo $result->{'profile_img'} ?>"
                        alt="User profile picture">
                </div>
                <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> -->
            </div>

        </div>
    </div>
</div>
<?php
$content = ob_get_contents();
ob_clean();
require_once('../Master/master_app.php');
?>