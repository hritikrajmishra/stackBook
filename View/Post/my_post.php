<?php
ob_start();
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['auth'])) {
    header("location: ../Auth/login_form.php");
} else {
    require_once "../../Back_End/Config/db_master_connection.php";
    $database = new DatabaseConnection();
    $conn = $database->get_connection();
    require_once "../../Back_End/Model/post_master.php";
    $PostMaster = new PostMaster($conn);
    $result_post = $PostMaster->post_list($_SESSION['auth']->{'id'});
}
?>

<div class="card o-hidden border-0 shadow-lg my-5">
    <div class="card-body p-4">
        <!-- Nested Row within Card Body -->
        <table class="table  table-hover" id="PostData">
            <thead>
                <tr class="">
                    <th>S.no</th>
                    <th>Question</th>
                    <th>Topic</th>
                    <th>action</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 0;
                foreach ($result_post as $post) { ?>
                    <tr class="">
                        <td>
                            <?php echo ++$i; ?>
                        </td>
                        <td>
                            <?php echo $post['question'] ?>
                        </td>
                        <td>
                            <?php echo $post['topic'] ?>
                        </td>
                        <td><a class="btn btn-sm m-1 btn-primary"
                                href="../Post/edit_post.php?0=<?php echo base64_encode($post['id']) ?>&&<?php echo rand() ?>">Edit</a>
                            <a class="btn btn-sm m-1 btn-danger" name="crud" value="post-delete"
                                id="<?php echo base64_encode($post['id']) ?>"
                                onclick="PostDelete(this.id,this.name,)">Delete</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
<?php

$content = ob_get_contents();
ob_clean();
require_once('../Master/index_master.php');
?>