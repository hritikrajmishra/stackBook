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

$result_post = $PostMaster->get_post_data_for_update(base64_decode($_REQUEST['er']));
$result_reply = $PostMaster->reply_data(base64_decode($_REQUEST['er']));

$ans_reply_reply = $PostMaster->reply_reply_data(base64_decode($_REQUEST['er']));


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
<div class="">
    <div class=" row">
        <div class="col-1"></div>
        <div class="col-sm-9 p-2" id="AllPost">
            <div class="card o-hidden border-0 shadow-lg">
                <div class="card-body p-3">
                    <div class="border border-bottom-0 border-dark p-2 rounded-bottom">
                        <div class="row">
                            <p class="col-6 ml-2">
                                <?php echo $result_post->{'topic'} ?>
                            </p>
                        </div>
                        <h4 class="text-primary">Que:-</h4>
                        <h5 class="">"
                            <?php echo $result_post->{'question'} ?>"
                        </h5>
                    </div>
                    <div class="pt-2 ">
                        <form action="../../Back_End/Controller/user_master_controller.php" method="POST">
                            <input id="crud" type="text" name="crud" value="question-reply" hidden>
                            <input id="question_id" type="text" name="question_id"
                                value="<?php echo $_REQUEST['er']; ?>" hidden>
                            <div class="row">
                                <div class="col-10 ">
                                    <input placeholder="Comment"
                                        class="form-control text-success  border border-secondary" type="text"
                                        name="reply" required minlength="3">

                                </div>
                                <div class="col-2">
                                    <input value="send" class="form-control btn btn-outline-success" type="submit">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- comment start -->
            <div class=" p-3">
                <h4>
                    <?php echo count($result_reply) ?> comments
                </h4>
                <?php for ($i = 0; $i < count($result_reply); $i++) { ?>
                    <h6>
                        <?php //echo $i +1 ?>
                    </h6>
                    <div class="border p-2 m-1 rounded">
                        <div class="border border-top-0 p-1 rounded-bottom">
                            <div>
                                <p class=" text-dark ml-2">@_
                                    <?php echo $result_reply[$i]['name'] ?>
                                    <!-- <i class="fa fa-check-circle"></i> -->
                                </p>
                            </div>
                            <div class="row">
                                <div class="col-sm-9 m-2">
                                    <span class="">
                                        <?php echo $result_reply[$i]['answer'] ?>

                                    </span>
                                </div>
                                <div class="col-sm-2 ">
                                    <a href="#myModal" id="<?php echo $result_reply[$i]['id'] ?>"
                                        style="text-decoration: none;" name="<?php echo $result_reply[$i]['answer'] ?>"
                                        class="btn btn-sm btn-outline-success" data-bs-toggle="modal"
                                        onclick="reply(this.id,this.name,'<?php echo $result_reply[$i]['name'] ?>','<?php echo $result_reply[$i]['user_id'] ?>')">Reply</a>
                                    <?php if (isset($_SESSION['auth'])) {

                                        if ($_SESSION['auth']->{'id'} == $result_reply[$i]['user_id']) {
                                            ?>
                                            <a class="btn btn-sm m-1 btn-outline-danger" name="crud"
                                                onclick="ReplyDelete(<?php echo $result_reply[$i]['id']; ?>, this.name, <?php echo base64_decode($_REQUEST['er']); ?>)">Delete</a>
                                        <?php }
                                    } else {
                                    } ?>
                                </div>
                            </div>
                        </div>

                        <?php for ($j = 0; $j < count($ans_reply_reply); $j++) { ?>

                            <?php if (($ans_reply_reply[$j]['id']) == ($result_reply[$i]['id'])) { ?>

                                <div class="">
                                    <div class="row border border-top-0 p-1 rounded-bottom mr-5 ml-5 mt-2">
                                        <div class="">
                                            <p class=" text-primary">@_
                                                <?php echo $ans_reply_reply[$j]['name'] ?> :-
                                                <!-- <i class="fa fa-check-circle"></i> -->
                                            </p>
                                        </div>
                                        <div class="col-sm-12">
                                            <span class=" text-size-lg">
                                                <?php echo $ans_reply_reply[$j]['answer'] ?>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        <?php } ?>
                    </div>
                <?php } ?>

            </div>

        </div>
        <!-- reply form Modal -->
        <div class="modal fade" id="myModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="p-2">
                        <button type="button" class="btn-close text-right" data-bs-dismiss="modal"></button>
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body">
                        <p><b>@_<u><i id="question_user_name"></i></u></b></p>
                        <div>
                            <p class="text-dark"><span id="answer_reply"></span></p>
                        </div>
                        <!-- form for reply to reply -->
                        <form action="../../Back_End/Controller/user_master_controller.php" method="POST">
                            <input type="text" name="crud" value="question-reply-reply" hidden>

                            <!-- <input type="text" name="question_user_id" id="question_user_id"  hidden> -->

                            <input type="text" name="question_reply_id" id="question_reply_id" hidden>

                            <input id="question_id" type="text" name="question_id"
                                value="<?php echo $_REQUEST['er']; ?>" hidden>
                            <div class="row">
                                <div class="col-10">
                                    <input class="form-control" type="text" name="reply" required minlength="3">
                                
                                </div>
                                <div class="col-2">
                                    <input id="submit" value="reply" class="form-control btn-outline-primary"
                                        type="submit">
                                </div>
                            </div>
                        </form>
                    </div>
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