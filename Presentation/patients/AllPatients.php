<?php
require_once("/wamp64/www/kds/Business/PatientManager.php");

session_start();
$operationClaimId = $_SESSION["operation_claim_id"];

if ($operationClaimId == null) {
    header("location:/kds/presentation/index.php");
    exit();
}

// $url = "/wamp64/www/kds/Connections/NurseManagerConnection.php";
$patientManager = new PatientManager();
$datas = array();
$datas = $patientManager->GetAllPatients();
if (count($datas) <= 0) {
    echo "Ber şeyler ters gitti";
} else {
?>
    <!DOCTYPE html>
    <html lang="tr">

    <?php include("/wamp64/www/kds/Presentation/SubHeader.php"); ?>

    <script>
        function deleteUser(id) {
            // url = "/kds/Connections/NurseManagerConnection.php";
            // $.ajax({
            //     type: "DELETE",
            //     url: url,
            //     data: {
            //         doctorId: id
            //     },
            //     success: function(response) {
            //         location.reload();
            //     },
            // })  
            alert(id);
        }
    </script>

    <script>
        function goToUpdate(id) {
            // url = "/kds/presentation/doctors/DoctorUpdate.php?id=" + id;
            // window.location.replace(url);
            alert(id)
        }

        function goToAdd() {
            // url = "/kds/presentation/doctors/DoctorAdd.php";
            // window.location.replace(url);
            alert("worked")
        }

        function filter() {
            console.log("filter works");
        }
    </script>

    <body>
        <?php include("/wamp64/www/kds/Presentation/Sidebar.php"); ?>
        <section>
            <div>
                <?php if ($operationClaimId == 1 || $operationClaimId == 2) { ?>
                    <button onclick="goToAdd()" class="btn-big btn-success btn-add-position">Add Patient</button>
                <?php } ?>
                <button onclick="filter()" class="btn btn-primary btn-add-position">Filter</button>

                <table>
                    <caption>All Patients</caption>
                    <tr>
                        <th>Social Security Number</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Age</th>
                        <?php if ($operationClaimId == 1 || $operationClaimId == 2) { ?>
                            <th>Delete</th>
                            <th>Update</th>
                        <?php } ?>
                    </tr>
                    <?php
                    foreach ($datas as $key => $value) {
                    ?>
                        <tr>
                            <td><?php echo $value["social_security_number"] ?></td>
                            <td><?php echo $value["patient_first_name"] ?></td>
                            <td><?php echo $value["patient_last_name"] ?></td>
                            <td><?php echo $value["age"] ?></td>
                            <?php if ($operationClaimId == 1 || $operationClaimId == 2) { ?>
                                <td align="center"><button onclick="deleteUser(<?php echo $value['id'] ?>)" id="btnDelete" class="btn btn-danger">Delete</button></td>
                                <td align="center"><button onclick="goToUpdate(<?php echo $value['id'] ?>)" id="btnUpdate" name="btnUpdate" class="btn btn-primary">Update</button></td>
                            <?php } ?>
                        </tr>

                <?php }
                } ?>

            </div>
        </section>
    </body>

    </html>