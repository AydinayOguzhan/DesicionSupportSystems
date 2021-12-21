<?php
require_once("/wamp64/www/kds/Business/ClinicManager.php");

session_start();
$operationClaimId = $_SESSION["operation_claim_id"];

if ($operationClaimId == null) {
    header("location:/kds/presentation/index.php");
    exit();
}

$url = "/wamp64/www/kds/Connections/ClinicManagerConnection.php";
$clinicManager = new ClinicManager();
$datas = array();
$datas = $clinicManager->GetAllClinics();
if (count($datas) <= 0) {
    echo "Ber şeyler ters gitti";
} else {
?>
    <!DOCTYPE html>
    <html lang="tr">

    <?php include("/wamp64/www/kds/Presentation/SubHeader.php"); ?>

    <script>
        function deleteUser(id) {
            url = "/kds/Connections/ClinicManagerConnection.php";
            $.ajax({
                type: "DELETE",
                url: url,
                data: {
                    clinicId: id
                },
                success: function(response) {
                    location.reload();
                }
            })
        }
    </script>

    <script>
        function goToUpdate(id) {
            // url = "/kds/presentation/users/userupdate.php?id=" + id;
            // window.location.replace(url);
            alert("Update");
        }

        function goToAdd() {
            url = "/kds/presentation/clinic/ClinicAdd.php";
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
                    <button onclick="goToAdd()" class="btn-big btn-success btn-add-position">Add Clinic</button>
                <?php } ?>
                <button onclick="filter()" class="btn btn-primary btn-add-position">Filter</button>

                <table>
                    <caption>All Clinics</caption>
                    <tr>
                        <th>Clinic Id</th>
                        <th>Clinic Name</th>
                        <?php if ($operationClaimId == 1 || $operationClaimId == 2) { ?>
                            <th>Delete</th>
                            <th>Update</th>
                        <?php } ?>
                    </tr>
                    <?php
                    foreach ($datas as $key => $value) {
                    ?>
                        <tr>
                            <td><?php echo $value["id"] ?></td>
                            <td><?php echo $value["clinic_name"] ?></td>
                            <?php if ($operationClaimId == 1 || $operationClaimId == 2) { ?>
                                <td align="center"><button onclick="deleteUser(<?php echo $value['id'] ?>)" class="btn btn-danger">Delete</button></td>
                                <td align="center"><button onclick="goToUpdate(<?php echo $value['id'] ?>)" class="btn btn-primary">Update</button></td>
                            <?php } ?>
                        </tr>

                <?php }
                } ?>

            </div>
        </section>
    </body>

    </html>