<?php 
    require_once("/wamp64/www/kds/Business/ClinicManager.php");
    require_once("/wamp64/www/kds/Business/MajorManager.php");
    $clinicManager = new ClinicManager();
    $majorManager = new MajorManager();
    $clinics = $clinicManager->GetAllClinics();
    $majors = $majorManager->GetAllMajors();
?>

<!DOCTYPE html>
<html lang="tr">

<?php include("/wamp64/www/kds/Presentation/SubHeader.php"); ?>

<script>
    function addDoctor() {
        $(document).ready(function() {
            url = "/kds/Connections/DoctorManagerConnection.php";

            var first_name = $("input[name='first_name']").val();
            var last_name = $("input[name='last_name']").val();
            var wage = $("input[name='wage']").val();
            var workplace = $("select[name='workplace']").val();
            var major = $("select[name='major']").val();

            $.ajax({
                    type: "POST",
                    url: url,
                    data: {
                        major_id:major,
                        first_name: first_name,
                        last_name: last_name,
                        workplace:workplace,
                        wage:wage,
                    },
                })
                .done(function(response) {
                    if (response == 1) {
                        url = "/kds/presentation/doctors/AllDoctors.php";
                        window.location.replace(url);
                    } else {
                        $("#error_message").empty();
                        $("#error_message").append(response);
                    }
                })
        });
    }


    function cancel() {
        url = "/kds/presentation/doctors/AllDoctors.php";
        window.location.replace(url);
    }
</script>

<body>
    <div>
        <?php include("/wamp64/www/kds/Presentation/Sidebar.php"); ?>
    </div>

    <section class="center-form-user">
        <label class="header header-primary">Add Doctor </label><br><br>
        <input class="big-input" type="text" id="first_name" name="first_name" placeholder="First Name"> <br>
        <input class="big-input" type="text" id="last_name" name="last_name" placeholder="Last Name"> <br>
        <label for="wage">Wage</label><br>
        <input class="big-input" value="0" type="number" id="wage" name="wage" placeholder="Wage"> <br>
        
        <label for="major">Major</label><br>
        <select name="major" id="major">
            <?php foreach ($majors as $value) { ?>
                <option value="<?php echo $value["id"]; ?>"><?php echo $value["major_name"] ?></option>
            <?php } ?>
        </select><br>

        <label for="workplace">Workplace</label><br>
        <select name="workplace" id="workplace">
            <?php foreach ($clinics as $value) { ?>
                <option value="<?php echo $value["id"]; ?>"><?php echo $value["clinic_name"] ?></option>
            <?php } ?>
        </select><br>
        
        <label class="text-danger" id="error_message"></label><br>
        <button onclick="addDoctor()" class="btn-big btn-success btn-form">Add Doctor</button>
        <button onclick="cancel()" class="btn-big btn-danger btn-form">Cancel</button>
    </section>
</body>

</html>