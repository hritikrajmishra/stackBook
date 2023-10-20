<?php
ob_start();
session_start();
if (!isset($_SESSION['auth'])) {
    header("location: ../Auth/login_form.php");
}
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
<div class="container border-left border-3 border-primary shadow p-3 mb-5 rounded">
    <form class="row g-1 " action="../../Back_End/Controller/user_master_controller.php" method="POST">
       
        <input type="text" name="crud" value="topic-store" hidden>
        <div class="col-md-12">
            <label for="exampleInputEmail1">Topic</label>
            <input type="text" class="form-control" value="" placeholder="enter topic" name="add_topic"><br>
        </div>

        <!-- /.card-body -->
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Save</button>
        </div><br>
    </form>
</div>


<?php
$content = ob_get_contents();
ob_clean();
require_once('../Master/Master_App.php');
?>