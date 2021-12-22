<?php 
    require_once("/wamp64/www/kds/Business/MajorManager.php");
?>

<!DOCTYPE html>
<html lang="tr">

<?php include("/wamp64/www/kds/Presentation/SubHeader.php"); ?>

<script>
    function addMajor() {
        $(document).ready(function() {
            url = "/kds/Connections/MajorManagerConnection.php";

            var major_name = $("input[name='major_name']").val();

            $.ajax({
                    type: "POST",
                    url: url,
                    data: {
                        majorName:major_name,
                    },
                })
                .done(function(response) {
                    if (response == 1) {
                        url = "/kds/presentation/majors/AllMajors.php";
                        window.location.replace(url);
                    } else {
                        $("#error_message").empty();
                        $("#error_message").append(response);
                    }
                })
        });
    }


    function cancel() {
        url = "/kds/presentation/majors/AllMajors.php";
        window.location.replace(url);
    }
</script>

<body>
    <div>
        <?php include("/wamp64/www/kds/Presentation/Sidebar.php"); ?>
    </div>

    <section class="center-form-user">
        <label class="header header-primary">Add Major </label><br><br>
        <label for="major_id">Major Name</label><br>
        <input class="big-input" autofocus type="text" id="major_name" name="major_name" placeholder="Major"> <br>
        
        <label class="text-danger" id="error_message"></label><br>
        <button onclick="addMajor()" class="btn-big btn-success btn-form">Add Major</button>
        <button onclick="cancel()" class="btn-big btn-danger btn-form">Cancel</button>
    </section>
</body>

</html>