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
$all_post = $PostMaster->get_all_post();

// var_dump($all_post);
// die();

?>
<div class="col-12 bg-primary p-2 text-center text-white">
    <h3> Post</h3>
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
 <br>
<table class="table table-hover text-dark" id="PostData">
    <thead>
        <tr class="">
            <th>S.no</th>
            <th>Question</th>
            <th>Topic</th>
            <th>Post by</th>
            <th>Date</th>
            <th class="text-center">action</th>
        </tr>
    </thead>
    <tbody>
        <?php $i = 0;
        foreach ($all_post as $post) { ?>
            <tr class="">
                <td>
                    <?php echo ++$i;?>.
                </td>
                <td>
                    <?php echo $post['question'] ?>
                </td>
                <td>
                    <?php echo $post['topic'] ?>
                </td>
                <td>
                    <?php echo $post['name'] ?>
                </td>
                <td>
                    <?php echo date("d-m-Y", strtotime($post['date'])) ?>
                </td>
                <td class="text-center">
                    <a class="btn btn-sm m-1 btn-danger" name="crud" value="post-delete"
                        id="<?php echo base64_encode($post['id']) ?>" onclick="PostDelete(this.id,this.name,)">Delete</a>
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