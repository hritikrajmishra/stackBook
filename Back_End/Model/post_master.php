<?php


class PostMaster
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;

    }

    public function store_topic($name)
    {
        try {
            $sql = "INSERT INTO topic_master (topic, created_at,created_by) VALUES ('$name','" . date('Y-m-d H:i:s') ."','" .$_SESSION['auth']->{'id'} ."')";
            $result = $this->conn->prepare($sql);
            return $result->execute();
        } catch (Exception $e) {
            echo "404-Something went wrong" . $e->getMessage();
        }
        return false;
    }

    public function get_topic()
    {
        try {
            $sql = "SELECT id,topic,DATE(created_at) FROM topic_master WHERE is_active='1' ORDER BY topic ASC";
            $result_topic = $this->conn->prepare($sql);
            $result_topic->execute();
            return $result_topic->fetchAll();
        } catch (Exception $e) {
            echo "404-Something went wrong" . $e->getMessage();
        }
        return false;
    }

    public function get_topic_by_id($id)
    {
        try {
            $sql = "SELECT id,topic FROM topic_master WHERE id='$id' AND is_active='1'";
            $result_topic = $this->conn->prepare($sql);
            $result_topic->execute();
            return $result_topic->fetchObject();
        } catch (Exception $e) {
            echo "404-Something went wrong" . $e->getMessage();
        }
        return false;
    }

    public function update_topic($id, $topic)
    {
        // TODO: You can also mention the date in the model(complete)
        try {

            $sql = 'UPDATE `topic_master` SET `topic`="' . $topic . '", `updated_at`="' . date('Y-m-d H:i:s') . '",`updated_by`="' . $_SESSION['auth']->{'id'} . '" WHERE id="' . $id . '"';
            $result_topic = $this->conn->prepare($sql);
            return $result_topic->execute();
        } catch (Exception $e) {
            echo "404-Something went wrong" . $e->getMessage();
        }
        return false;
    }
    public function delete_topic($id)
    {
        try {
            $sql = "UPDATE `topic_master` SET `is_active`='0',`updated_by`='". $_SESSION['auth']->{'id'} ."',`updated_at`='" .date('Y-m-d H:i:s'). "' WHERE `id`='$id'";
            $result_post_list = $this->conn->prepare($sql);
            return $result_post_list->execute();
        } catch (Exception $e) {
            echo "404-Something went wrong" . $e->getMessage();
        }
        return false;
    }
    public function topic_duplicate_check($name)
    {
        try {
            $sql = "SELECT `topic` FROM topic_master Where topic='$name' AND is_active='1'";
            $result_post_list = $this->conn->prepare($sql);
            $result_post_list->execute();
            $check = $result_post_list->fetchObject();
            if ($check) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            echo "404-Something went wrong" . $e->getMessage();
        }
        return false;
    }

    public function store_post($question, $topic_id, $user_id)
    {
        try {
            $sql = 'INSERT INTO question_master (question,topic_master_id,user_master_id,created_at) VALUES ("' . $question . '","' . $topic_id . '","' . $user_id . '","' . date('Y-m-d H:i:s') . '")';
            $result_question = $this->conn->prepare($sql);
            $result_question->execute();
        } catch (Exception $e) {
            echo "404-Something went wrong" . $e->getMessage();
        }
        return false;
    }
    public function post_list($id)
    {
        try {
            $sql = "SELECT question_master.question, question_master.id,topic_master.topic, DATE(question_master.created_at) 
        FROM question_master 
        LEFT JOIN user_master ON user_master.id = question_master.user_master_id 
        RIGHT JOIN topic_master on question_master.topic_master_id=topic_master.id 
        WHERE user_master.id='$id' AND question_master.is_active='1'  AND topic_master.is_active='1'";
            $result_post_list = $this->conn->prepare($sql);
            $result_post_list->execute();
            return $result_post_list->fetchAll();
        } catch (Exception $e) {
            echo "404-Something went wrong" . $e->getMessage();
        }
        return false;
    }
    public function get_all_post()
    {
        try {
            $sql = "SELECT question_master.id, question_master.question, topic_master.topic, 
            DATE(question_master.created_at) AS date, user_master.name,COUNT(like_masters.id) AS like_count,GROUP_CONCAT(like_masters.user_master_id) AS user_id
            FROM question_master 
            LEFT JOIN user_master ON user_master.id = question_master.user_master_id 
            LEFT JOIN topic_master ON question_master.topic_master_id = topic_master.id 
            LEFT JOIN like_masters ON question_master.id=like_masters.post_master_id
            WHERE question_master.is_active='1' AND topic_master.is_active='1'  AND user_master.is_active='1'
            GROUP BY question_master.id";
            $result_post_list = $this->conn->prepare($sql);
            $result_post_list->execute();
            return $result_post_list->fetchAll();
        } catch (Exception $e) {
            echo "404-Something went wrong" . $e->getMessage();
        }
        return false;
    }
    public function get_post_data_for_update($id)
    {
        try {
            $sql = "SELECT question_master.question, topic_master.topic,topic_master.id FROM question_master 
        RIGHT JOIN topic_master ON question_master.topic_master_id=topic_master.id WHERE question_master.id='$id'";
            $result_post_list = $this->conn->prepare($sql);
            $result_post_list->execute();
            return $result_post_list->fetchObject();
        } catch (Exception $e) {
            echo "404-Something went wrong" . $e->getMessage();
        }
        return false;
    }
    public function update_post($question_id, $topic_id, $question)
    {
        try {
            $sql = 'UPDATE `question_master` SET `question`="' . $question . '",`topic_master_id`="' . $topic_id . '",`updated_by`="' . $_SESSION['auth']->{'id'} . '",`updated_at`="' . date('Y-m-d H:i:s') . '" WHERE `id`="' . $question_id . '"';

            $result_post_list = $this->conn->prepare($sql);
            return $result_post_list->execute();
        } catch (Exception $e) {
            echo "404-Something went wrong" . $e->getMessage();
        }
        return false;
    }
    public function delete_post($post_id)
    {

        try {
            $sql = "UPDATE `question_master` SET `is_active`='0',`updated_by`='" .$_SESSION['auth']->{'id'}. "',`updated_at`='" .date('Y-m-d H:i:s'). "' WHERE `id`='$post_id'";
            $result_post_list = $this->conn->prepare($sql);
            return $result_post_list->execute();
        } catch (Exception $e) {
            echo "404-Something went wrong" . $e->getMessage();
        }
        return false;
    }
    public function question_reply($reply,$question_id)
    {
        try {
            $sql = 'INSERT INTO answer_master (answer,question_master_id,created_at,created_by) VALUES ("' . $reply . '","' . $question_id . '","' . date('Y-m-d H:i:s') . '","' . $_SESSION['auth']->{'id'} . '")';
            $result_question_reply = $this->conn->prepare($sql);
            return $result_question_reply->execute();
        } catch (Exception $e) {
            echo "404-Something went wrong" . $e->getMessage();
        }
        return false;
    }
    public function reply_data($que_id)
    {
        try {
            $sql = "SELECT answer_master.id, answer_master.answer,user_master.name,user_master.id as user_id
            FROM answer_master
            LEFT JOIN user_master 
            ON user_master.id = answer_master.created_by 
            WHERE answer_master.question_master_id='$que_id'
            AND answer_master.is_active='1' AND user_master.is_active='1';";
            $result_reply_data = $this->conn->prepare($sql);
            $result_reply_data->execute();
            return $result_reply_data->fetchAll();
        } catch (Exception $e) {
            echo "404-Something went wrong" . $e->getMessage();
        }
        return false;
    }
    public function delete_reply($id)
    {

        try {
            $sql = 'UPDATE `answer_master` SET `is_active`="0", `updated_by`="' . $_SESSION['auth']->{'id'} . '",`updated_at`="' . date('Y-m-d H:i:s') . '"  WHERE `id`="' . $id . '"';
            $result_delete_reply = $this->conn->prepare($sql);
            return $result_delete_reply->execute();

        } catch (Exception $e) {
            echo "404-Something went wrong" . $e->getMessage();
        }
        return false;
    }
    public function question_reply_reply($reply, $question_reply_id)
    {
        try {
            $sql = 'INSERT INTO answer_master (answer,answer_master_id,created_by,created_at) VALUES ("' . $reply . '","' . $question_reply_id . '","' . $_SESSION['auth']->{'id'} . '","' . date('Y-m-d H:i:s') . '")';
            $result_question_reply = $this->conn->prepare($sql);
            return $result_question_reply->execute();
        } catch (Exception $e) {
            echo "404-Something went wrong" . $e->getMessage();
        }
        return;
    }

    public function reply_reply_data($que_id)
    {
        try {
            $sql = "SELECT ad.id,ad.answer,am.id,user_master.name
             FROM `answer_master` am
             JOIN `answer_master` ad ON am.id = ad.answer_master_id
             LEFT JOIN user_master ON user_master.id=ad.created_by WHERE am.question_master_id='$que_id' AND am.is_active='1'  AND user_master.is_active='1';";
            $result_reply = $this->conn->prepare($sql);
            $result_reply->execute();
            return $result_reply->fetchAll();
        } catch (Exception $e) {
            echo "404-Something went wrong" . $e->getMessage();
        }
        return false;
    }

    public function like($post_id)
    {
        try {

            // TODO: Remove is_like flag in the like_masters table(complete)
            $sql = "SELECT `id` FROM `like_masters` WHERE `user_master_id`='" .$_SESSION['auth']->{'id'}. "' AND `post_master_id`=$post_id";
            $result_like_dislike = $this->conn->prepare($sql);
            $result_like_dislike->execute();
            $like = $result_like_dislike->fetchObject();

            if ($like) {
                // TODO: Remove this condition also after remove the is_like flag(complete)
                $sql = "DELETE FROM `like_masters` WHERE `user_master_id`='" .$_SESSION['auth']->{'id'}. "' AND `post_master_id`='$post_id'";
                $result_delete_like = $this->conn->prepare($sql);
                return $result_delete_like->execute();
            }
            $sql = "INSERT INTO like_masters (post_master_id,user_master_id,created_at) VALUES ('$post_id','" .$_SESSION['auth']->{'id'}. "','" .date('Y-m-d H:i:s'). "')";
            $result_like_dislike = $this->conn->prepare($sql);
            return $result_like_dislike->execute();

        } catch (Exception $e) {
            echo "404-Something went wrong" . $e->getMessage();
        }
    }
    public function all_like()
    //for like update using ajax
    {
        $sql = "SELECT `post_master_id`, COUNT('id') as total_like
        FROM `like_masters`
        GROUP BY  `post_master_id`";
        // $sql = "SELECT `post_master_id`,`user_master_id` FROM like_masters WHERE is_like='1';";
        $result_like_count = $this->conn->prepare($sql);
        $result_like_count->execute();
        return $result_like_count->fetchAll();

    }
    // here we get data for showing like on post using Ajax
    public function like_count($post_id)
    {
        $sql = "SELECT `user_master_id`
        FROM `like_masters` 
        WHERE `post_master_id`='$post_id'
        GROUP BY `user_master_id`";
        $result_like_count = $this->conn->prepare($sql);
        $result_like_count->execute();
        return $result_like_count->fetchAll();
    }


    // this is for showing number of users post in website
    public function users_post()
    {
        try {
            $data = $this->conn->prepare("SELECT COUNT(id) AS post_count FROM question_master WHERE is_active='1'");
            $data->execute();
            return $data->fetchColumn();
        } catch (Exception $e) {
            echo "404-Something went wrong" . $e->getMessage();
        }
    }
}