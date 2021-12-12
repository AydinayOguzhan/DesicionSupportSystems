<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Klinik Karar Destek Sistemleri</title>

    <link rel="stylesheet" type="text/css" href="./style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>


    <script type="text/javascript">
        $(document).ready(function() {
            $("#btnSubmit").click(function(event) {
                event.preventDefault();

                var values = $(this).serialize();
                url = "../Connections/AuthManagerConnection.php";

                $email = $("input[name=email]").val();
                $password = $("input[name=password]").val();

                $.ajax({
                    type: "POST",
                    url: url,
                    data: {
                        email: $email,
                        password: $password
                    },
                }).done(function(response) {
                    if (response == 1) {
                        window.location.replace("../Presentation/HomePage.php");
                    }else{
                        $("#error").empty();
                        $("#error").append(response);
                    }
                });
            });
        });
    </script>
</head>

<body>
    <div class="container">
        <div class="center">
            <form method="POST" id="signin" name="signin">
                <h2 class="text-align-center">Please Sign In</h2>
                <input autofocus type="text" id="email" name="email" placeholder="Email"> <br>
                <input type="password" id="password" name="password" placeholder="Password"> <br>
                <label class="text-danger" id="error" name="error"></label>
                <button class="btn-big btn-primary btn-sign-in-position" id="btnSubmit" type="submit">Sign In</button>
            </form>
        </div>
    </div>

</body>

</html>