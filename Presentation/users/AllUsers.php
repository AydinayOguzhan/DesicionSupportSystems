<?php
require_once("/wamp64/www/kds/Business/UserManager.php");
$url = "/wamp64/www/kds/Connections/UserManagerConnection.php";
$userManager = new UserManager();
$datas = array();
$datas = $userManager->GetAllUsers();
if (count($datas) <= 0) {
    echo "Ber şeyler ters gitti";
} else {
?>
    <script>
        function deleteUser(id) {
            url = "../Connections/UserManagerConnection.php";
            $.ajax({
                type: "DELETE",
                url: url,
                data: {
                    userId: id
                },
                success: function(response) {
                    // alert(response);
                    location.reload();
                }
            })

        }
    </script>
    <script>
        function goToUpdate(id){
            url = "/kds/presentation/users/userupdate.php?id="+id;
            window.location.replace(url);
        }

        function goToAdd(){
            url = "/kds/presentation/users/UserAdd.php";
            window.location.replace(url);
        }
    </script>

    <div class="">
        <button onclick="goToAdd()" class="btn-big btn-success btn-add-position">Add User</button>
        <table>
            <caption>All Users</caption>
            <tr>
                <th>company id</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Password</th>
                <th>Delete</th>
                <th>Update</th>
            </tr>
            <?php
            foreach ($datas as $key => $value) {
            ?>
                <tr>
                    <td><?php if (is_null($value["company_id"]) === false) {
                            echo $value["company_id"];
                        } else {
                            echo "Şirket kaydı yok";
                        }  ?></td>
                    <td><?php echo $value["first_name"] ?></td>
                    <td><?php echo $value["last_name"] ?></td>
                    <!-- Passwordu kaldır -->
                    <td><?php echo $value["password"] ?></td>
                    <td align="center"><button onclick="deleteUser(<?php echo $value['id'] ?>)" id="<?php echo $value['id'] ?>" class="btn btn-danger">Delete</button></td>
                    <td align="center"><button onclick="goToUpdate(<?php echo $value['id'] ?>)" id="btnUpdate" name="btnUpdate" class="btn btn-primary">Update</button></td>
                </tr>

        <?php }
        } ?>

    </div>