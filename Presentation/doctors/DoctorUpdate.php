<?php
require_once("/wamp64/www/kds/Business/DoctorManager.php");
require_once("/wamp64/www/kds/Entities/doctor.php");
require_once("/wamp64/www/kds/Business/ClinicManager.php");
require_once("/wamp64/www/kds/Business/MajorManager.php");

$doctorId = $_GET["id"];

session_start();
$userOperationClaim = $_SESSION["operation_claim_id"];

$doctorManager = new DoctorManager();
$clinicManager = new ClinicManager();
$majorManager = new MajorManager();
$doctor = $doctorManager->GetDoctorById($doctorId);
$clinics = $clinicManager->GetAllClinics();
$majors = $majorManager->GetAllMajors();
?>

<!DOCTYPE html>
<html lang="tr">

<?php include("/wamp64/www/kds/Presentation/SubHeader.php"); ?>

<script>    
    function load() {

        var clinicsSelect = document.getElementById("clinics");
        var doctorClinicId = <?php echo $doctor->clinic_id; ?>;
        var clinics = <?php echo json_encode($clinics); ?>;
        for (let i = 0; i < clinics.length; i++) {
            const element = clinics[i];
            var opt = document.createElement("option");
            opt.value=element.id;
            opt.innerHTML = element.clinic_name;
            if (element.id == doctorClinicId) {
                opt.selected = "selected";
            }
            clinicsSelect.appendChild(opt);
        }


        var majorsSelect = document.getElementById("majors");
        var doctorMajorId = <?php echo $doctor->major_id; ?>;
        var majors = <?php echo json_encode($majors); ?>;
        for (let i = 0; i < majors.length; i++) {
            const element = majors[i];
            var opt = document.createElement("option");
            opt.value=element.id;
            opt.innerHTML = element.major_name;
            if (element.id == doctorMajorId) {
                opt.selected = "selected";
            }
            majorsSelect.appendChild(opt);
        }
        
        document.getElementById("doctorFirstName").setAttribute("value", "<?php echo $doctor->doctor_first_name ?>");
        document.getElementById("doctorLastName").setAttribute("value", "<?php echo $doctor->doctor_last_name ?>");
        document.getElementById("wage").setAttribute("value", "<?php echo $doctor->wage ?>");
    }
    window.onload = load;
</script>

<script>
    function updateDoctor() {
        $(document).ready(function() {
            url = "/kds/Connections/DoctorManagerConnection.php";

            var doctorId = <?php echo $doctorId ?>;
            var doctorFirstName = $("input[name='doctorFirstName']").val();
            var doctorLastName = $("input[name='doctorLastName']").val();
            var clinicId = $("select[name='clinics']").val();
            var majorId = $("select[name='majors']").val();
            var wage = $("input[name='wage']").val();

            $.ajax({
                    type: "PUT",
                    url: url,
                    data: {
                        doctorId: doctorId,
                        doctorFirstName: doctorFirstName,
                        doctorLastName: doctorLastName,
                        clinicId: clinicId,
                        majorId: majorId,
                        wage: wage
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
        <label class="header header-primary">Update Doctor </label><br><br>
        <label class="header-sml" for="doctorFirstName">First Name</label><br>
        <input class="big-input" value="0" autofocus type="text" id="doctorFirstName" name="doctorFirstName" placeholder="First Name"> <br>
        <label class="header-sml" for="doctorLastName">Last Name</label><br>
        <input class="big-input" type="text" id="doctorLastName" name="doctorLastName" placeholder="Last Name"> <br>


        <label class="header-sml" for="clinicName">Clinic Name</label><br>
        <select id="clinics" name="clinics"> </select><br>

        <label class="header-sml" for="majorName">Major Name</label><br>
        <select id="majors" name="majors"> </select><br>


        <label class="header-sml" for="wage">Wage</label><br>
        <input class="big-input" type="text" id="wage" name="wage" placeholder="Wage"> <br>

        <label class="text-danger" id="error_message"></label><br>
        <button onclick="updateDoctor()" class="btn-big btn-success btn-form">Update User</button>
        <button onclick="cancel()" class="btn-big btn-danger btn-form">Cancel</button>
    </section>
</body>

</html>