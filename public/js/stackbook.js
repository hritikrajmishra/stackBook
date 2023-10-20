$(document).ready(function () {

    $('#PostData').dataTable();

});

function like_dislike(post_id,IdName,IconName,UserId) {

    // console.log(post_id,IdName,IconName);

    $.ajax({
        type: "POST",
        url: "../../Back_End/Controller/user_master_controller.php",
        data: {
            post_id: post_id,
            crud: 'like-dislike-on-post'
        },
        cache: false,
        success: function (data) {

            if(!data){
                // redirect to the login page when someone try to like post without login
                window.location.href = "../Auth/login_form.php";
                return;
            }
            //in response get JSON data 
            obj = JSON.parse(data);
 
            for(var i=0; i<(obj).length;i++){
                // find if in array get the id of person that match with auth session user id ,it showing liked 
                if(obj[i]['user_master_id']==UserId){
                document.getElementById(IconName).innerHTML= "<i class='fas fa-heart' style='color:red'></i>";
                document.getElementById(IdName).innerHTML= obj.length;
                    return;
                } else if(obj.length==0){
                    // if no data that mean no like on post
                    document.getElementById(IconName).innerHTML='<i class="far fa-heart"></i>';
                    document.getElementById(IdName).innerHTML= obj.length;
                    return;
                }
                // when decrease the like it remove the liked mark
                document.getElementById(IconName).innerHTML='<i class="far fa-heart"></i>';
                document.getElementById(IdName).innerHTML= obj.length;
            }
            
            return;
        },
        error: function (xhr, status, error) {
            console.error(xhr);
        }
    });
  
}
// for the like counting functionality
 
function PostDelete(id, name) {
    if (confirm("Do you really want to delete this post! Please make sure!") == true) {
        window.location.href = `../../Back_End/Controller/user_master_controller.php?wp=${id}&dsa&${name}=post-delete`;
    }
}
function ReplyDelete(id, name, que) {
    if (confirm("Do you really want to delete this post! Please make sure!") == true) {
        window.location.href = `../../Back_End/Controller/user_master_controller.php?wp=${id}&dsa&${name}=reply-delete&que=${que}`;
    }
}
function reply(question_reply_id, answer_reply, question_user_name) {

    document.getElementById('question_reply_id').value = question_reply_id;
    document.getElementById('answer_reply').innerHTML = answer_reply;
    document.getElementById('question_user_name').innerHTML = question_user_name;
}