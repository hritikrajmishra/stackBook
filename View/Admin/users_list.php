<?php
ob_start();
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['auth'])) {
    header("location: ../Auth/login_form.php");
}
if($_SESSION['auth']->{'role_id'}!==1){
    header("location: ../Auth/login_form.php");
}
require_once "../../Back_End/Config/db_master_connection.php";
$database = new DatabaseConnection();
$conn = $database->get_connection();
require_once "../../Back_End/Model/user_master.php";
$userMaster = new UserMaster($conn);
$result_user = $userMaster->user_data();
 
?>
<div class="row">
    <div class="col-12 text-center bg-primary p-2 text-white">
        <h3>Users</h3>
    </div>
</div><br>
<?php
if (isset($_SESSION['messageErr'])) {
    ?>
    <div class="alert alert-success alert-dismissible text-center">
        <strong>
            <?php echo $_SESSION['messageErr'] ?>
        </strong>
    </div>
<?php }
unset($_SESSION['messageErr']);
?>
<table class="table table-hover text-dark" id="PostData">
    <thead>
        <tr class="">
            <th class="text-center">S.no</th>
            <th class="text-center">Profile</th>
            <th class="text-center">Name</th>
            <th class="text-center">Email</th>
            <th class="text-center">Contact</th>
            <th class="text-center">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        for ($i = 0; $i < count($result_user); $i++) { ?>
            <tr class="">
                <td class="text-center">
                    <?php echo $i + 1; ?>.
                </td>
                <td class="text-center">
                <img class="rounded-circle"
                                    src="../../public/profile_image/<?php echo $result_user[$i]['profile_img'] ?>"
                                    alt="image" height="50px" width="50px">
                </td>
                <td class="text-center">
                    <?php echo $result_user[$i]['name'] ?>
                </td>
                <td class="text-center">
                    <?php echo $result_user[$i]['email'] ?>
                </td>
                <td class="text-center">
                    <?php echo $result_user[$i]['mobile'] ?>
                </td>
                <td class="text-center"><a class="btn btn-sm m-1 btn-primary"
                        href="../Admin/user_edit.php?ecr=<?php echo base64_encode($result_user[$i]['id']) ?>&<?php echo rand(); ?>">Edit</a>
                    <a class="btn btn-sm m-1 btn-danger" name="crud" value="user-delete"
                        id="<?php echo base64_encode($result_user[$i]['id']) ?>"
                        onclick="UserDelete(this.id,this.name,)">Delete</a>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>
<?php

$content = ob_get_contents();
ob_clean();
require_once('../Master/master_app.php');
?>