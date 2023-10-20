<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
// to get path of database connection
require_once "../Config/db_master_connection.php";

// object of DatabaseConnection Class
$database = new DatabaseConnection();
$conn = $database->get_connection();

// to get path of user master model
require_once "../Model/user_master.php";
require_once "../Model/post_master.php";

// class UserMaster
$user_master = new UserMaster($conn);
// class PostMaster
$post_master = new PostMaster($conn);


switch ($_REQUEST['crud']) {

    case "user-registration":

        $validation_arr = 0;
        //validation check (registration data)
        if (empty($_POST['full_name']) || empty($_FILES['profile_img']['name']) || empty($_POST['email']) || empty($_POST['mobile']) || empty($_POST['password'] && $_POST['re_password'])) {
            $_SESSION['messageErr'] = '* All fields are required';
            $validation_arr = 1;
        }
        //name check
        if (!preg_match("/^[a-zA-Z-' ]*$/", $_POST["full_name"])) {
            $_SESSION['nameErrR'] = '* Invalid format! Use(A-Z,a-z)';
            $validation_arr = 1;
        }
        //image type check
        if (!preg_match("#\.(jpg|jpeg|gif|png)$# i", $_FILES["profile_img"]["name"])) {
            $_SESSION['imageErrR'] = '* Only (jpg,jpeg,gif,png) are allowed';
            $validation_arr = 1;
        }
        //email check
        if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
            $_SESSION['emailErrR'] = '* Only this format example@gmail.com allowed';
            $validation_arr = 1;
        }
        //mobile number check
        if (!preg_match("/^(\+\d{1,3}[- ]?)?\d{10}$/", $_POST["mobile"])) {
            $_SESSION['mobileErrR'] = '* Use only 10 digits number';
            $validation_arr = 1;
        } else {
            //Mobile number already exit validation
            if ($user_master->ContactNumberExist($_POST["mobile"])) {
                $_SESSION['mobileErrR'] = '* Already registered';
                $validation_arr = 1;
            }
        }
        //password type and match validation
        if (!preg_match("/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/", $_POST["password"]) && !preg_match("/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/", $_POST["re_password"])) {

            $_SESSION['passwordErrR'] = '*Use one upper case,special character and number (P@ssw0rd!123)';
            $validation_arr = 1;
        } elseif ($_POST["password"] != $_POST["re_password"]) {
            $_SESSION['passwordErrR'] = 'password not matched';
            $validation_arr = 1;
        }
        //if get any wrong format or info it return the error
        if ($validation_arr) {
            header('Location: ../../View/Auth/registration_form.php');
            return;
        }

        //image root directory
        $target_directory = "../../public/profile_image/";
        $file_name = rand() . basename($_FILES["profile_img"]["name"]);
        $target_file_path = $target_directory . $file_name;

        if (move_uploaded_file($_FILES["profile_img"]["tmp_name"], $target_file_path)) {

            $result = $user_master->Store($_POST['full_name'], $file_name, $_POST['email'], $_POST['mobile'], md5($_POST['password']));
            $_SESSION['message'] = 'registered';
            header('Location: ../../View/Auth/login_form.php');
            return;
        }
        break;

    case "user-login":

        if (empty($_POST['mobile']) || empty($_POST['password'])) {
            $_SESSION['messageErr'] = '* All fields are required';
            header('Location: ../../View/Auth/login_form.php');
            return;
        }

        $result = $user_master->Login($_POST['mobile'], md5($_POST['password']));


        if ($result) {

            // TODO: remove the admin login session, also from whole project(completed)
            if ($result->{'role_id'} == '1') {
                $_SESSION['auth'] = $result;
                $_SESSION['message'] = "logged in";
                header("Location: ../../View/Master/master_app.php");
            } else
                if ($result->{'role_id'} == '2') {
                    // user
                    $_SESSION['auth'] = $result;
                    $_SESSION['message'] = "logged in";
                    header("Location: ../../View/Master/index_master.php");
                } else {
                    $_SESSION['message'] = "You are disabled by the admin";
                    header("Location: ../../View/Auth/login_form.php");
                }
        } else {
            $_SESSION['message'] = "invalid mobile or password";
            header("Location: ../../View/Auth/login_form.php");
        }
        break;

    case "user-logout":

        // TODO: You can also regenerate the session. Not required!(completed)
        session_destroy();
        session_regenerate_id();
        header("location: ../../View/Master/index_master.php");
        break;


    case "user-post":

        if (empty($_POST['question']) || empty($_POST['topic'])) {
            $_SESSION['messageErr'] = '* All fields are required';
            header('Location: ../../View/Post/post_form.php');
            return;
        }
        if (isset($_REQUEST)) {
            if (empty(ctype_space($_POST['question']))) {
                $post_master->store_post($_POST['question'], $_POST['topic'], $_POST['user_id']);
                header('Location: ../../View/Master/index_master.php');
            } else {
                $_SESSION['messageErr'] = '* please fill some post';
                header('Location: ../../View/Post/post_form.php');
            }
        }
        break;

    case "user-edit":
        // TODO: Follow the below scenario (Completed)
        /*
            1. Validation
            2. Upload image
            3. Update the database row
            4. Check where to redirect
        */
        $validation_arr = 0;

        if (empty($_POST['edit_name']) || empty($_POST['edit_mail'])) {

            $_SESSION['messageErr'] = "All fields aer required";
            header('Location: ../../View/User/user_profile.php');
            return;
        }
        if (!preg_match("/^[a-zA-Z-' ]*$/", $_POST["edit_name"])) {
            $_SESSION['nameErr'] = '* Invalid format! Use(A-Z,a-z)';
            $validation_arr = 1;
        }
        if (!filter_var($_POST["edit_mail"], FILTER_VALIDATE_EMAIL)) {
            $_SESSION['emailErr'] = '* only this format example@gmail.com allowed';
            $validation_arr = 1;
        }
        // image validation check 
        if (!empty(ctype_space($_FILES['edit_image']))) {
            if (!preg_match("#\.(jpg|jpeg|gif|png)$# i", $_FILES["edit_image"]["name"])) {
                $_SESSION['imageErr'] = '* Only (jpg,jpeg,gif,png) are allowed';
                $validation_arr = 1;
            }
        }
        // if get any validation error it redirect according to role id  
        if ($validation_arr) {
            if ($_SESSION['auth']->{'role_id'} == '2') {
                header('Location: ../../View/User/user_profile.php');
                return;
            } else if ($_SESSION['auth']->{'id'} == $_POST['id']) {
                header('Location: ../../View/Admin/admin_profile.php');
                return;
            }
            $user_id = base64_encode($_POST['id']);
            header("Location: ../../View/Admin/user_edit.php?ecr=$user_id");
            return;
        }
        // after validation here if Request have image data
        if (!empty($_FILES['edit_image']['name'])) {
            // give image unique name with random generated number 
            $image = rand() . basename($_FILES["edit_image"]["name"]);
            $target_file_path = "../../public/profile_image/" . $image;
            if (move_uploaded_file($_FILES["edit_image"]["tmp_name"], $target_file_path)) {

                if ($user_master->update($_POST['id'], $_POST['edit_name'], $_POST['edit_mail'], $image)) {
                    // get details of session user to regenerate auth session 
                    $result = $user_master->get_user_data($_SESSION['auth']->{'id'});
                    //check where to redirect and who is updating profile user himself of admin
                    if ($_SESSION['auth']->{'role_id'} == '1' && $_SESSION['auth']->{'id'} == $_POST['id']) {
                        $_SESSION['auth'] = $result;
                        $_SESSION['messageErr'] = "Updated"; //Admin profile update 
                        return header("Location: ../../View/Admin/admin_profile.php");

                    } else if ($_SESSION['auth']->{'role_id'} == '2') {
                        $_SESSION['messageErr'] = "Updated"; //User profile update
                        $_SESSION['auth'] = $result;
                        return header("Location: ../../View/User/user_profile.php");
                    }
                    $_SESSION['messageErr'] = "Updated"; // Admin updated user profile
                    $_SESSION['auth'] = $result;
                    return header("Location: ../../View/Admin/users_list.php");
                }
                return;
            }
            return;
        }
        //updated info without image
        if ($_SESSION['auth']->{'role_id'} == '1') { // for admin
            $edit_user_info = $user_master->update($_POST['id'], $_POST['edit_name'], $_POST['edit_mail'], $_FILES['edit_image']['name']);
            $result = $user_master->get_user_data($_SESSION['auth']->{'id'});
            $_SESSION['auth'] = $result;
            $_SESSION['messageErr'] = "Updated";
            $_POST['id'] == $_SESSION['auth']->{'id'} ? header("Location: ../../View/Admin/admin_profile.php") : header("Location: ../../View/Admin/users_list.php");
            return;
        }
        if ($_SESSION['auth']->{'role_id'} == '2') { // for user
            $edit_user_info = $user_master->update($_POST['id'], $_POST['edit_name'], $_POST['edit_mail'], $_FILES['edit_image']['name']);
            $_SESSION['messageErr'] = "Updated";
            header("Location: ../../View/User/user_profile.php");
        }
        break;

    case "change-user-password":
        // TODO: Validation -> Check the password and retype password -> Check the password in the database -> Update the password(completed)

        if (!empty($_POST['current_password']) && !empty($_POST['new_password']) && !empty($_POST['re_password'])) {
            // check new password and re-enter new password are same or not
            if ($_POST['new_password'] == $_POST['re_password']) {
                // here check entered previous password matched with DataBase password
                if ($user_master->previous_password_exist(md5($_POST['current_password']), $_POST['user_id'])) {

                    if ($user_master->update_password($_POST['user_id'], md5($_POST['new_password']))) {
                        $_SESSION['message'] = "Updated";
                        header("Location: ../../View/Auth/change_password_form.php");
                        return;
                    }
                    $_SESSION['message'] = "No changes";
                    header("Location: ../../View/Auth/change_password_form.php");
                    return;
                }
                $_SESSION['message'] = "You entered wrong previous password";
                header("Location: ../../View/Auth/change_password_form.php");
                return;
            }
            $_SESSION['message'] = "New password not Matched with re-enter password";
            header("Location: ../../View/Auth/change_password_form.php");
            return;
        }
        $_SESSION['message'] = "Fill all input field";
        header("Location: ../../View/Auth/change_password_form.php");
        break;

    case "user-delete":
        // REQUEST['wp'] is id of user
        if ($user_master->user_delete(base64_decode($_REQUEST['wp']))) {
            $_SESSION['messageErr'] = "Deleted";
            header("Location: ../../View/Admin/users_list.php");
            return;
        }
        $_SESSION['messageErr'] = "No changes";
        header("Location: ../../View/Admin/users_list.php");
        break;

    case "user-post-edit":

        if (!empty($_POST['topic']) && !empty($_POST['question'])) {
            if ($post_master->update_post($_POST['question_id'], $_POST['topic'], addslashes($_POST['question']))) {
                $_SESSION['message'] = "Post updated";
                header("Location: ../../View/Master/index_master.php");
                return;
            }
            return;
        }
        $_SESSION['message'] = "no changes";
        header("Location: ../../View/Master/index_master.php");
        break;

    case "post-delete":
        // REQUEST['wp'] is id of post
        if ($post_master->delete_post(base64_decode($_REQUEST['wp']))) {
            //redirect according to role id 
            if ($_SESSION['auth']->{'role_id'} == "1") {
                $_SESSION['message'] = "Post deleted by admin";
                header("Location: ../../View/Post/post_list.php");
                return;
            }
            $_SESSION['message'] = "Post deleted";
            header("Location: ../../View/Master/index_master.php");
            return;
        }
        break;

    case "topic-store":

        if (isset($_REQUEST)) {
            //check if new added topic is already exist in database
            if ($post_master->topic_duplicate_check($_POST['add_topic'])) {
                $_SESSION['message'] = "already exist";
                header("Location: ../../View/Topic/topic_list.php");
                return;
            }
            if (empty(ctype_space($_POST['add_topic'])) && !empty($_POST['add_topic'])) {
                if ($post_master->store_topic(addslashes($_POST['add_topic']))) {
                    $_SESSION['message'] = "topic added";
                    header("Location: ../../View/Topic/topic_list.php");
                    return;
                }
                $_SESSION['message'] = "try again";
                header("Location: ../../View/Topic/topic_list.php");
                return;
            }
            $_SESSION['message'] = "Please enter some topic";
            header("Location: ../../View/Topic/topic_form.php");
            return;
        }
        break;

    case "topic-edit":

        if (isset($_REQUEST)) {
            // here check if updated topic data is already exist in database or not
            if ($post_master->topic_duplicate_check($_POST['update_topic'])) {
                $_SESSION['message'] = "already exist";
                header("Location: ../../View/Topic/topic_list.php");
                return;
            }
            if (empty(ctype_space($_POST['update_topic']))) {

                if ($post_master->update_topic($_POST['update_topic_id'], addslashes($_POST['update_topic']))) {
                    $_SESSION['message'] = "topic updated";
                    header("Location: ../../View/Topic/topic_list.php");
                    return;
                }
                $_SESSION['message'] = "try again";
                header("Location: ../../View/Topic/topic_list.php");
                return;
            }
            $_SESSION['message'] = "no changes";
            header("Location: ../../View/Topic/topic_list.php");
        }
        break;

    case "topic-delete":

        if (isset($_REQUEST)) {
            // REQUEST['wp'] is id of topic
            if ($post_master->delete_topic(base64_decode($_REQUEST['wp']))) {
                $_SESSION['message'] = "topic deleted";
                header("Location: ../../View/Topic/topic_list.php");
                return;
            }
            $_SESSION['message'] = "try again";
            header("Location: ../../View/Topic/topic_list.php");
            return;
        }
        break;
    case "question-reply":

        if (isset($_REQUEST)) {
            // REQUEST['question_id'] is id of question 
            $que_id = $_POST['question_id'];
            if (!empty($_POST['reply'])) {

                if ($post_master->question_reply(addslashes($_POST['reply']), base64_decode($_POST['question_id']))) {
                    header("Location: ../../View/Comment/comment_page.php?er=$que_id");
                    return;
                }
                $_SESSION['message'] = "try again";
                header("Location: ../../View/Comment/comment_page.php?er=$que_id");
                return;
            }
            $_SESSION['message'] = "no reply";
            header("Location: ../../View/Comment/comment_page.php?er=$que_id");
            return;
        }
        break;
    case "reply-delete":

        if (isset($_REQUEST)) {
            // REQUEST['que'] is id of question 
            $id = base64_encode($_REQUEST['que']);
            // REQUEST['wp'] is id of reply
            if ($post_master->delete_reply($_REQUEST['wp'])) {
                header("Location: ../../View/Comment/comment_page.php?er=$id");
                return;
            }
            header("Location: ../../View/Comment/comment_page.php?er=$id");
            return;
        }
        break;

    case "question-reply-reply":

        if (isset($_REQUEST)) {
            // REQUEST['que'] is id of question 
            $que_id = $_POST['question_id'];

            if (!empty($_POST['reply'])) {
                if ($post_master->question_reply_reply(addslashes($_POST['reply']), $_POST['question_reply_id'])) {
                    header("Location: ../../View/Comment/comment_page.php?er=$que_id");
                    return;
                }
                header("Location: ../../View/Comment/comment_page.php?er=$que_id");
                return;
            }
            $_SESSION['message'] = "no reply";
            header("Location: ../../View/Comment/comment_page.php?er=$que_id");
            return;
        }
        break;

    case "like-dislike-on-post";

        if (!empty($_POST['post_id'])) {
            // check if Session login code return the json unless it return false and use to to the login page
            if (isset($_SESSION['auth'])) {
                $post_master->like($_POST['post_id']);
                $all_like = $post_master->like_count($_POST['post_id']);
                echo json_encode($all_like);
                return;
            }
            // return false because session auth is not set 
            false;
            return;
        }
        break;
    default:
        echo "404 Not Found";

}
?>