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
$topic = $PostMaster->get_topic();

$question = $PostMaster->get_post_data_for_update(base64_decode($_GET['0']));

?>
<div class="container">
    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg-5 d-none d-lg-block" >
                    <img src="../../public/profile_image/StackBookLogo.jpg" alt="">
                </div>
                <div class="col-lg-7">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Update Post !</h1>
                            <hr>
                        </div>
                        <?php
                        if (isset($_SESSION['messageN'])) {
                            ?>
                            <div class="alert alert-success text-center">
                                <strong>
                                    <?php
                                    echo $_SESSION['messageN'];
                                    unset($_SESSION['messageN']);
                                    ?>
                                </strong>
                            </div>
                            <?php
                        } ?>
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
                            <input type="text" name="crud" value="user-post-edit" hidden>
                            <input type="text" name="user_id" value="<?php echo $_SESSION['auth']->{'id'}; ?>" hidden>
                            <input type="text" name="question_id" value="<?php echo base64_decode($_GET['0']); ?>"
                                hidden>
                            <div class="form-group row">
                                <div class="col-sm-12 mb-3 mb-sm-0">
                                    <label for="choose topic">Choose Topic:</label>
                                    <select class="border border-secondary  col-sm-3 form-control" name="topic">
                                        <option value="<?php echo $question->{'id'} ?>"><?php echo $question->{'topic'} ?></option>
                                        <?php for ($i = 0; $i < count($topic); $i++) {
                                            if ($question->{'topic'} == $topic[$i]['topic']) { ?>
                                            <?php }
                                            ?>
                                        <option value="<?php echo $topic[$i]['id'] ?>"><?php echo $topic[$i]['topic']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-sm-12 mt-3">
                                    <input class="form-control border border-secondary"
                                        value="<?php echo $question->{'question'} ?>" name="question">
                                </div>
                                <span class="error_red">
                                    <?php
                                    if (isset($_SESSION['questionErr'])) {
                                        echo $_SESSION['questionErr'];
                                        unset($_SESSION['questionErr']);
                                    }
                                    ?>
                                </span>
                            </div>
                            <hr>

                            <button type="submit" class="btn btn-success btn-user btn-block">Update</button>
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