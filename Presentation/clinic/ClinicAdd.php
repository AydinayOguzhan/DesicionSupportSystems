<?php ?>

<!DOCTYPE html>
<html lang="tr">

<?php include("/wamp64/www/kds/Presentation/SubHeader.php"); ?>

<script>
    function addClinic() {
        $(document).ready(function() {
            url = "/kds/Connections/ClinicManagerConnection.php";

            var clinic_name = $("input[name='clinic_name']").val();

            $.ajax({
                    type: "POST",
                    url: url,
                    data: {
                        clinic_name: clinic_name
                    },
                })
                .done(function(response) {
                    if (response == 1) {
                        url = "/kds/presentation/clinic/AllClinics.php";
                        window.location.replace(url);
                    } else {
                        $("#error_message").empty();
                        $("#error_message").append(response);
                    }
                })
        })
    };


    function cancel() {
        url = "/kds/presentation/clinic/AllClinics.php";
        window.location.replace(url);
    }
</script>

<body>
    <div>
        <?php include("/wamp64/www/kds/Presentation/Sidebar.php"); ?>
    </div>

    <section class="center-form-user">
        <label class="header header-primary">Add Clinic</label><br><br>
        <input autofocus class="big-input" type="text" id="clinic_name" name="clinic_name" placeholder="Clinic Name"> <br>
        <label class="text-danger" id="error_message"></label><br>
        <button onclick="addClinic()" class="btn-big btn-success btn-form">Add Clinic</button>
        <button onclick="cancel()" class="btn-big btn-danger btn-form">Cancel</button>
    </section>
</body>

</html>