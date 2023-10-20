<?php
class UserMaster
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function Store($name, $image, $email, $mobile, $password)
    {
        try {
            $sql = "INSERT INTO user_master (name,profile_img,email,mobile,password,created_at) VALUES ('$name','$image','$email','$mobile','$password',date('Y-m-d H:i:s'))";
        
            return  $this->conn->exec($sql);
        } catch (Exception $e) {
            echo "404-Something went wrong" . $e->getMessage();
        }
        return false;
    }

    public function Login($mobile, $password)
    {
        try {
            $data = $this->conn->prepare("SELECT `id`,`profile_img`,`name`,`email`,`mobile`,`is_active`,`role_id` FROM user_master WHERE mobile='$mobile' AND password='$password' AND is_active='1'");
            $data->execute();
            return $data->fetchObject();
        } catch (Exception $e) {
            echo "404-Something went wrong" . $e->getMessage();
        }
        return;
    }

    public function get_user_data($id)
    {
        try {
            $data = $this->conn->prepare("SELECT `id`,`profile_img`,`name`,`email`,`mobile`,`role_id` FROM user_master WHERE id='$id'");
            $data->execute();
            return $data->fetchObject();
        } catch (Exception $e) {
            echo "404-Something went wrong" . $e->getMessage();
        }
        return false;
    }
    public function user_data()
    {
        try {
            $data = $this->conn->prepare("SELECT `id`,`profile_img`,`name`,`email`,`mobile` FROM user_master WHERE role_id='2' AND is_active='1'");
            $data->execute();
            return $data->fetchAll();
        } catch (Exception $e) {
            echo "404-Something went wrong" . $e->getMessage();
        }
        return false;
    }

    public function update($id, $name, $email, $image)
    {
        
        try {
            $user_id = $_SESSION['auth']->{'id'};
            $date=date('Y-m-d H:i:s');
            if (empty($image)) {

                $sql = "UPDATE `user_master` SET `name`='$name', `email`='$email', `updated_at`='$date',`updated_by`='$user_id' WHERE `id`='$id'";
                return $this->conn->exec($sql);
            }
            $sql = "UPDATE `user_master` SET `profile_img`='$image', `name`='$name', `email`='$email', `updated_at`='$date',`updated_by`='$user_id' WHERE `id`='$id'";
            return $this->conn->exec($sql);
        } catch (Exception $e) {
            echo "404-Something went wrong" . $e->getMessage();
        }
        return false;
    }
    public function user_delete($id)
    {
        try {
            $user_id= $_SESSION['auth']->{'id'};
            $sql = "UPDATE `user_master` SET `is_active`='0',`updated_by`='$user_id' WHERE `id`='$id'";
            $result_post_list = $this->conn->prepare($sql);
            return $result_post_list->execute();
        } catch (Exception $e) {
            echo "404-Something went wrong" . $e->getMessage();
        }
        return false;
    }

    public function ContactNumberExist($contact_number)
    {
        try {
            $data = $this->conn->prepare("SELECT `name` FROM user_master WHERE mobile='$contact_number' AND is_active='1'");
            $data->execute();

            if ($data->fetchColumn()) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            echo "404-Something went wrong" . $e->getMessage();
        }
        return false;
    }
    public function previous_password_exist($current_password, $user_id)
    {
        try {
            $data = $this->conn->prepare("SELECT `password` FROM user_master WHERE id='$user_id'  AND is_active='1'");
            $data->execute();
            $result = $data->fetchObject();
            if ($result->{"password"} == $current_password) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            echo "404-Something went wrong" . $e->getMessage();
        }
        return false;
    }
    public function update_password($id, $new_password)
    {
        try {
            $date=date('Y-m-d H:i:s');
            $sql = "UPDATE `user_master` SET `password`='$new_password',`updated_at`= '$date', `updated_by`='$id' WHERE `id`='$id'";
            return $this->conn->exec($sql);
        } catch (Exception $e) {
            echo "404-Something went wrong" . $e->getMessage();
        }
        return false;
    }

    public function users()
    {

        try {
            $data = $this->conn->prepare("SELECT COUNT(id) AS user_count FROM user_master WHERE role_id='2'");
            $data->execute();
            return $data->fetchColumn();
        } catch (Exception $e) {
            echo "404-Something went wrong" . $e->getMessage();
        }
    }
}