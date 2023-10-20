<?php
ob_start();
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['auth'])) {
    header("location: ../Auth/login_form.php");
}
require_once "../../Back_End/Config/db_master_connection.php";
$database = new DatabaseConnection();
$conn = $database->get_connection();
require_once "../../Back_End/Model/post_master.php";
$PostMaster = new PostMaster($conn);
$result_topic = $PostMaster->get_topic();

// var_dump($result_topic);
// die();

?>
<div class="row">
    <div class="col-10 bg-primary p-2 text-white">
        <h3>Topic</h3>
    </div>
    <a href="../Topic/topic_form.php" class="col-2 bg-success p-2 text-white text-center nav-link">
        <h3>Add topic</h3>
    </a>
</div><br>
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
<table class="table table-hover text-dark" id="PostData">
    <thead>
        <tr class="">
            <th>S.no</th>
            <th class="text-center">Topic</th>
            <th class="text-center">action</th>
        </tr>
    </thead>
    <tbody>
        <?php $i = 0;
        foreach ($result_topic as $topic) { ?>
            <tr class="">
                <td>
                    <?php echo ++$i; ?>
                </td>
                <td class="text-center">
                    <?php echo $topic['topic'] ?>
                </td>
                <td class="text-center"><a class="btn btn-sm m-1 btn-primary"
                        href="../Topic/topic_edit_form.php?ecr=<?php echo base64_encode($topic['id']) ?>&<?php echo rand(); ?>">Edit</a>
                    <a class="btn btn-sm m-1 btn-danger" name="crud" value="topic-delete"
                        id="<?php echo base64_encode($topic['id']) ?>" onclick="TopicDelete(this.id,this.name,)">Delete</a>
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