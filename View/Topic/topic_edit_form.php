<?php
ob_start();
session_start();

if (!isset($_SESSION['auth'])) {
    header("location: ../Auth/login_form.php");
}
require_once "../../Back_End/Config/db_master_connection.php";
$database = new DatabaseConnection();
$conn = $database->get_connection();
require_once "../../Back_End/Model/post_master.php";
$PostMaster = new PostMaster($conn);

$topic = $PostMaster->get_topic_by_id(base64_decode( $_REQUEST['ecr']));

// var_dump($topic);
// die();
?>
<div class="container border-left border-3 border-primary shadow p-3 mb-5 rounded">
    <form class="row g-1" action="../../Back_End/Controller/user_master_controller.php" method="POST">
        <input type="text" name="crud" value="topic-edit" hidden>
        <input type="text" value="<?php echo $topic->{'id'}?>" name="update_topic_id" hidden>
        <div class="col-md-12">
            <label for="exampleInputEmail1">Topic</label>
            
            <input type="text" class="form-control form-control" value="<?php echo $topic->{'topic'}?>" name="update_topic" required><br>
        </div>

        <!-- /.card-body -->
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Update</button>
        </div><br>
    </form>
</div>


<?php
$content = ob_get_contents();
ob_clean();
require_once('../Master/Master_App.php');
?>