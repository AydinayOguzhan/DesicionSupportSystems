<!DOCTYPE html>
<html lang="tr">
<body>
<?php 
       require_once("../Business/UserManager.php");
       $userManager = new UserManager();
       $datas = array();
       $datas = $userManager->GetAllUsers();
       if (count($datas) <= 0) {
           echo "Ber şeyler ters gitti";
       }else{
    ?>


<table>
        <tr>
            <th>id</th>
            <th>company id</th>
            <th>isim</th>
            <th>soyisim</th>
            <th>şifre</th>
        </tr>
        <?php
        foreach ($datas as $key => $value) {
        ?>
            <tr>
                <td><?php echo $value["id"] ?></td>
                <td><?php echo $value["company_id"] ?></td>
                <td><?php echo $value["first_name"] ?></td>
                <td><?php echo $value["last_name"] ?></td>
                <td><?php echo $value["password"] ?></td>
            </tr>

        <?php }} ?>

    </table> <?php 
       require_once("../Business/UserManager.php");
       $userManager = new UserManager();
       $datas = array();
       $datas = $userManager->GetAllUsers();
       if (count($datas) <= 0) {
           echo "Ber şeyler ters gitti";
       }else{
    ?>


<table>
        <tr>
            <th>id</th>
            <th>company id</th>
            <th>isim</th>
            <th>soyisim</th>
            <th>şifre</th>
        </tr>
        <?php
        foreach ($datas as $key => $value) {
        ?>
            <tr>
                <td><?php echo $value["id"] ?></td>
                <td><?php echo $value["company_id"] ?></td>
                <td><?php echo $value["first_name"] ?></td>
                <td><?php echo $value["last_name"] ?></td>
                <td><?php echo $value["password"] ?></td>
            </tr>

        <?php }} ?>

    </table>
</body>
</html>