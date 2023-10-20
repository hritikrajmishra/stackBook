<!DOCTYPE html>
<html lang="en" id="html">
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
// to get path of database connection
require_once "../../Back_End/Config/db_master_connection.php";

// object of DatabaseConnection Class
$database = new DatabaseConnection();
$conn = $database->get_connection();

require_once "../../Back_End/Model/post_master.php";

// class PostMaster
$post_master = new PostMaster($conn);
$all_post = $post_master->get_all_post();// All active posts with comment count and like count 

?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Custom fonts for this template-->
    <link href="../../public/css/all.min.css" rel="stylesheet" type="text/css">
    <!-- Custom styles for this template-->
    <link href="../../public/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="../../public/css/jquery.dataTables.css" rel="stylesheet">
    <link href="../../public/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="../../public/css/StackBook.css" rel="stylesheet">
    <title>Stack Book</title>
    <style>
        .error_red {
            color: #FF0000;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
        <div class="container-fluid m-2">
            <a class="navbar-brand  border border-danger rounded p-2"
                href="../../View/Master/index_master.php"><strong>Stack
                    Book</strong></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item ">
                        <a class="nav-link active" aria-current="page"
                            href="../../View/Master/index_master.php">Home</a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link active" aria-current="page"
                            href="../../View/NavPages/about_us.php">About-Us</a>
                    </li>
                </ul>
                <?php
                if (isset($_SESSION['auth'])) {
                    // if auth role id is 2 means user 
                    if ($_SESSION["auth"]->{'role_id'} == 2) {

                        ?>
                        <div class="d-flex">
                            <div class="dropdown">
                                <a href="#" class="nav-link rounded-circle mr-5 " data-bs-toggle="dropdown">
                                    <img class="rounded-circle"
                                        src="../../public/profile_image/<?php echo $_SESSION['auth']->{'profile_img'} ?>"
                                        alt="image" height="50px" width="50px">
                                </a>
                                <ul class="dropdown-menu  p-2 m-3 shadow animated--grow-in border border-primary">
                                    <li>
                                        <a href="../../View/User/user_profile.php"  class="dropdown-item text-primary"><strong>
                                                <?php echo $_SESSION['auth']->{'name'} ?>
                                            </strong></a>
                                    </li>
                                    <hr>
                                    <li><a class="dropdown-item" href="../../View/User/user_profile.php">Profile</a></li>
                                    <li><a class="dropdown-item" href="../../View/Post/my_post.php">My Post</a></li>
                                    <li><a class="dropdown-item"
                                            href="../../View/Auth/change_password_form.php">Change-Password</a></li>
                                    <li><a class="dropdown-item bg-danger rounded text-white"
                                            href="../../Back_End/Controller/user_master_controller.php?crud=user-logout">Logout</a>
                                    </li>
                                </ul>
                            </div>
                            <a href="../../View/Post/post_form.php" class="btn btn-outline-success">Ask
                                Que?</a>
                        </div>
                    <?php } else { // here else condition if auth role id is not 2 it means Admin and auth id is 1?>
                        <div class="d-flex">
                            <div class="dropdown dropstart">
                                <a href="../../View/Master/master_app.php" class="nav-link rounded-circle mr-5 ">
                                    <span class="text-danger"><strong><u>
                                                <?php echo $_SESSION['auth']->{'name'} ?>
                                            </u></strong></span>
                                    <img class="rounded-circle"
                                        src="../../public/profile_image/<?php echo $_SESSION['auth']->{'profile_img'} ?>"
                                        alt="image" height="50px" width="50px">
                                </a>
                            </div>
                        </div>
                    <?php }
                } else { // no auth  session 
                    ?>
                <div class="d-flex">
                    <a href="../Auth/registration_form.php"
                        class="form-control me-2 btn btn-outline-success">Register</a>
                    <a href="../Auth/login_form.php" class="btn btn-outline-success">Login</a>
                </div>
                <?php
                }
                ?>
            </div>
        </div>
    </nav>
    <div class="container-fluid" style="margin-top:100px">
        <?php
        if (isset($_SESSION['message'])) {
            ?>
            <div class="alert alert-success text-center">
                <strong>
                    <?php
                    echo $_SESSION['message'];
                    unset($_SESSION['message']);
                    ?>
                </strong>
            </div>
            <?php
        } ?>
        <?php if (isset($content)) {
            echo $content;
        } else { ?>
            <div>
                <table id="PostData">
                    <thead>
                        <tr>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php for ($i = 0; $i < count($all_post); $i++) { // here check the count of the fetch data 
                            $result_reply = $post_master->reply_data($all_post[$i]['id']); // fetch the reply data of this post
                            ?>

                            <tr>
                                <td>
                                    <div class="row">
                                        <div class="col-1"></div>
                                        <div class="col-sm-8 p-2" id="AllPost">
                                            <div class="card o-hidden border-0 shadow-lg">
                                                <div class="card-body p-2">
                                                    <div class="border border-bottom-0 border-dark p-2">
                                                        <div class="row">
                                                            <p class=" col-6">@_
                                                                <?php echo $all_post[$i]['name'] ?>
                                                            </p>
                                                            <p class=" col-6 text-right">

                                                                <?php echo $all_post[$i]['topic'] ?>
                                                            </p>
                                                        </div>
                                                        <h3>
                                                            <?php echo $all_post[$i]['question'] ?>
                                                        </h3>
                                                        <p class="text-danger">
                                                            <?php echo date("d-m-Y", strtotime($all_post[$i]['date'])); ?>
                                                        </p>
                                                    </div>
                                                    <div class="border bg-secondary bg-opacity-10 rounded-top">
                                                        <a href="../Comment/comment_page.php?er=<?php echo base64_encode($all_post[$i]['id']) ?>&id=<?php echo rand() . '%%br'; ?>"
                                                            class="btn btn m-2" title="see comment"><i
                                                                class="far fa-comment"></i>
                                                            <span>
                                                                <?php echo count($result_reply) // echo all reply count  ?>
                                                            </span>
                                                        </a>
                                                        <button type="button" class="btn btn"
                                                            id="<?php echo $all_post[$i]['id'] ?>" onclick="like_dislike(this.id,'like<?php echo base64_encode($all_post[$i]['id']); ?>','icon<?php echo base64_encode($all_post[$i]['id']); ?>','<?php if (isset($_SESSION['auth'])) {
                                                                         echo $_SESSION['auth']->{'id'};
                                                                     } ?>')">
                                                            <span id="icon<?php echo base64_encode($all_post[$i]['id']); ?>">
                                                                <?php
                                                                $array = explode(',', $all_post[$i]['user_id']); // in user id have multiple record (string to array with explode)

                                                                if (isset($_SESSION['auth'])) {
                                                                    if (in_array($_SESSION['auth']->{'id'}, $array)) { // now check if array have the same id as session auth id it show liked
                                                                        echo "<i class='fas fa-heart' style='color:red'></i>";
                                                                    } else {
                                                                        echo "<i class='far fa-heart'></i> ";
                                                                    }
                                                                } else {
                                                                    echo "<i class='far fa-heart'></i> ";
                                                                }
                                                                ?>
                                                                <?php echo $all_post[$i]['like_count'] // echo the like count on post ?>
                                                            </span>
                                                            <span id="like<?php echo base64_encode($all_post[$i]['id']); ?>">
                                                                <span
                                                                    id="count<?php echo base64_encode($all_post[$i]['id']); ?>">
                                                                </span>
                                                            </span>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- footer start -->
        <div class=" bg-secondary bg-opacity-10 border mt-1">
            <div class="container-fluid row p-2">
                <div class="col-3">
                    <address>
                        <label for="address"><b>Address</b></label><br>
                        <i> <u>Visit us at (live soon):</u><br>
                            www.StackBook.com<br>
                            vijay nagar 564<br>
                            Jabalpur Madhya Pradesh</i>
                    </address>
                </div>
                <div class="col-3">
                    <label for="address"><b>More</b></label><br>
                    <ul>
                        <li><a class="nav-link" href="index_master.php" title="go to home">Home</a></li>
                    </ul>
                    <ul>
                        <li><a class="nav-link" href="../NavPages/about_us.php" title="go to home">About-Us</a></li>
                    </ul>
                </div>
            </div>
            <div class="text-center">
                <span>Copyright &copy; Stack Book
                    <?php echo date('Y'); ?>
                </span>
            </div>
        </div>
        <!-- footer end -->
    <?php } ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../../public/js/jquery/jquery.min.js"></script>
    <script src="../../public/js/jquery/jquery.dataTables.js"></script>
    <script src="../../public/js/jquery/jquery.dataTables.min.js"></script>
    <!-- here script ajax -->
    <script src="../../public/js/stackbook.js"></script>
</body>

</html>