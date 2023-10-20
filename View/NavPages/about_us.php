<?php
ob_start();
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
// if (!isset($_SESSION['auth'])) {
//     header("location: ../Auth/login_form.php");
// }

?>

<div class="text-center p-3 text-secondary" style="background-color: rgb(247, 247, 247)">
    <h1 class="">ABOUT-US</h1>
    <h3>" This website provide you solutions, and here you can Ask any doubt and Question about any technologies, we have Stack of Answers"</h3>
    <h3>" Here you can search or post any kind of doubts related to the technologies."</h3>
</div>
<div>
    <p class="text-danger text-center mt-5">'currently this web-site is in development mode!!'</p>
</div>
 
<?php
$content = ob_get_contents();
ob_clean();
require_once('../Master/index_master.php');
?>