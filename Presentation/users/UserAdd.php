<?php ?>

<!DOCTYPE html>
<html lang="tr">

<?php include("/wamp64/www/kds/Presentation/SubHeader.php"); ?>

<script>
    function addUser() {
        $(document).ready(function() {
            url = "/kds/Connections/UserManagerConnection.php";

            var company_id = $("input[name='company_id']").val();
            var first_name = $("input[name='first_name']").val();
            var last_name = $("input[name='last_name']").val();
            var email = $("input[name='email']").val();
            var password = $("input[name='password']").val();

            $.ajax({
                    type: "POST",
                    url: url,
                    data: {
                        company_id: company_id,
                        first_name: first_name,
                        last_name: last_name,
                        email: email,
                        password: password
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
        <label class="header header-primary">Add User </label><br><br>
        <input class="big-input" value="0" autofocus type="number" id="company_id" name="company_id" placeholder="Company Id"> <br>
        <input class="big-input" type="text" id="first_name" name="first_name" placeholder="First Name"> <br>
        <input class="big-input" type="text" id="last_name" name="last_name" placeholder="Last Name"> <br>
        <input class="big-input" type="email" id="email" name="email" placeholder="Email"> <br>
        <input class="big-input" type="text" id="password" name="password" placeholder="Password"> <br>
        <label class="text-danger" id="error_message"></label><br>
        <button onclick="addUser()" class="btn-big btn-success btn-form">Add User</button>
        <button onclick="cancel()" class="btn-big btn-danger btn-form">Cancel</button>
    </section>
</body>

</html>