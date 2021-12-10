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
        function del(id) {
            // url = "/Connections/UserManagerConnection.php";

            // $.ajax({
            //     type: "POST",
            //     url: "<?php echo $url ?>",
            //     data: {
            //         type: "delete",
            //         userId: id
            //     }
            // }).done(function(response) {
            //     alert(response);
            //     // if (response == 1) {
            //     //     alert("İşlem başarılı");
            //     // }else{
            //     //     alert(response);
            //     // }
            // });
            // onclick="del(<?php echo $value['id'] ?>)"
        }
    </script>

    <script>
        $(document).on("click", "button.delete", function(e) {
            $userId = e.currentTarget.id;
            url = "../Connections/UserManagerConnection.php";

            $.ajax({
                type: "delete",
                url: url,
                data: {
                    userId: $userId
                }
            }).done(function(response) {
                console.log(response);
            });
        });
    </script>

    <div class="">
        <table id="tr">
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
                    <!-- <td align="center"><input value="Delete" type="button" name="deneme" class="btn btn-danger" id="<?php echo $value['id'] ?>"></td> -->
                    <td align="center"><button id="<?php echo $value['id'] ?>" class="btn btn-danger delete">Delete</button></td>
                    <td align="center"><button id="btnUpdate" name="btnUpdate" class="btn btn-primary">Update</button></td>
                </tr>

        <?php }
        } ?>

    </div>