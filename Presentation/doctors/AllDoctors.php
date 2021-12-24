<?php
require_once("/wamp64/www/kds/Business/DoctorManager.php");

session_start();
$operationClaimId = $_SESSION["operation_claim_id"];

if ($operationClaimId == null) {
    header("location:/kds/presentation/index.php");
    exit();
}

$url = "/wamp64/www/kds/Connections/DoctorManagerConnection.php";
$doctorManager = new DoctorManager();
$datas = array();
$datas = $doctorManager->GetAllDoctors();
if (count($datas) <= 0) {
    echo "Ber şeyler ters gitti";
} else {
?>
    <!DOCTYPE html>
    <html lang="tr">

    <?php include("/wamp64/www/kds/Presentation/SubHeader.php"); ?>

    <script>
        function deleteUser(id) {
            url = "/kds/Connections/DoctorManagerConnection.php";
            $.ajax({
                type: "DELETE",
                url: url,
                data: {
                    doctorId: id
                },
                success: function(response) {
                    location.reload();
                },
            })

        }
    </script>

    <script>
        function goToUpdate(id) {
            url = "/kds/presentation/doctors/DoctorUpdate.php?id=" + id;
            window.location.replace(url);
        }

        function goToAdd() {
            url = "/kds/presentation/doctors/DoctorAdd.php";
            window.location.replace(url);
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
                    <button onclick="goToAdd()" class="btn-big btn-success btn-add-position">Add Doctor</button>
                <?php } ?>
                <button onclick="filter()" class="btn btn-primary btn-add-position">Filter</button>

                <table>
                    <caption>All Doctors</caption>
                    <tr>
                        <th>Major Name</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Doctor Workplace</th>
                        <th>Doctor Wage</th>
                        <?php if ($operationClaimId == 1 || $operationClaimId == 2) { ?>
                            <th>Delete</th>
                            <th>Update</th>
                        <?php } ?>
                    </tr>
                    <?php
                    foreach ($datas as $key => $value) {
                    ?>
                        <tr>
                        <td><?php echo $value["major_name"] ?></td>
                            <td><?php echo $value["doctor_first_name"] ?></td>
                            <td><?php echo $value["doctor_last_name"] ?></td>
                            <td><?php echo $value["clinic_name"] ?></td>
                            <td><?php echo $value["wage"] ?></td>
                            <?php if ($operationClaimId == 1 || $operationClaimId == 2) { ?>
                                <td align="center"><button onclick="deleteUser(<?php echo $value['id'] ?>)" id="<?php echo $value['id'] ?>" class="btn btn-danger">Delete</button></td>
                                <td align="center"><button onclick="goToUpdate(<?php echo $value['id'] ?>)" id="btnUpdate" name="btnUpdate" class="btn btn-primary">Update</button></td>
                            <?php } ?>
                        </tr>

                <?php }
                } ?>

            </div>
        </section>
    </body>

    </html>