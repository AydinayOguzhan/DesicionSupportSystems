<?php
require_once("/wamp64/www/kds/Business/UserManager.php");
require_once("/wamp64/www/kds/Entities/user.php");
require_once("/wamp64/www/kds/Business/OperationClaimManager.php");
require_once("/wamp64/www/kds/Entities/operationClaim.php");
$userId = $_GET["id"];

session_start();
$userOperationClaim = $_SESSION["operation_claim_id"];

$userManager = new UserManager();
$userObj = new User();
$userObj = $userManager->GetUserById($userId);

?>

<!DOCTYPE html>
<html lang="tr">

<?php include("/wamp64/www/kds/Presentation/SubHeader.php"); ?>

<script>

    function load() {
        document.getElementById("company_id").setAttribute("value", "<?php echo $userObj->company_id ?>");
        document.getElementById("first_name").setAttribute("value", "<?php echo $userObj->first_name ?>");
        document.getElementById("last_name").setAttribute("value", "<?php echo $userObj->last_name ?>");
        document.getElementById("email").setAttribute("value", "<?php echo $userObj->email ?>");
        document.getElementById("password").setAttribute("value", "<?php echo $userObj->password ?>");
        document.getElementById("operation_claim_id").setAttribute("value", "<?php echo $userObj->operation_claim_id ?>");
    }
    window.onload = load;
</script>

<script>
    function updateUser() {
        $(document).ready(function() {
            url = "/kds/Connections/UserManagerConnection.php";

            var userId = <?php echo $userId ?>;
            var company_id = $("input[name='company_id']").val();
            var first_name = $("input[name='first_name']").val();
            var last_name = $("input[name='last_name']").val();
            var email = $("input[name='email']").val();
            var password = $("input[name='password']").val();
            var operation_claim_id = $("input[name='operation_claim_id']").val();

            $.ajax({
                    type: "PUT",
                    url: url,
                    data: {
                        id: userId,
                        company_id: company_id,
                        first_name: first_name,
                        last_name: last_name,
                        email: email,
                        password: password,
                        operation_claim_id : operation_claim_id,
                    },
                })
                .done(function(response) {
                    if (response == 1) {
                        url = "/kds/presentation/users/AllUsers.php";
                        window.location.replace(url);
                    } else {
                        $("#error_message").empty();
                        $("#error_message").append(response);
                    }
                })
        });
    }


    function cancel() {
        url = "/kds/presentation/users/AllUsers.php";
        window.location.replace(url);
    }
</script>

<body>
    <div>
        <?php include("/wamp64/www/kds/Presentation/Sidebar.php"); ?>
    </div>

    <section class="center-form-user">
        <label class="header header-primary">Update User </label><br><br>
        <label class="header-sml" for="company_id">Company Id</label><br>
        <input class="big-input" value="0" autofocus type="number" id="company_id" name="company_id" placeholder="Company Id"> <br>
        <label class="header-sml" for="first_name">First Name</label><br>
        <input class="big-input" type="text" id="first_name" name="first_name" placeholder="First Name"> <br>
        <label class="header-sml" for="last_name">Last Name</label><br>
        <input class="big-input" type="text" id="last_name" name="last_name" placeholder="Last Name"> <br>
        <label class="header-sml" for="email">Email</label><br>
        <input class="big-input" type="email" id="email" name="email" placeholder="Email"> <br>
        <label class="header-sml" for="password">Password</label><br>
        <input class="big-input" type="text" id="password" name="password" placeholder="Password"> <br>
        <label class="header-sml" for="operation_claim_id">Operation Claim Id</label><br>
        <input class="big-input" type="number" id="operation_claim_id" name="operation_claim_id" placeholder="Operation Claim Id"> <br>

        <label class="text-danger" id="error_message"></label><br>
        <button onclick="updateUser()" class="btn-big btn-success btn-form">Update User</button>
        <button onclick="cancel()" class="btn-big btn-danger btn-form">Cancel</button>
    </section>
</body>

</html>