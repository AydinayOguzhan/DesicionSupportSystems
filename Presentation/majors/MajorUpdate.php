<?php 
    require_once("/wamp64/www/kds/Business/MajorManager.php");
    $majorId = $_GET["id"];
    $majorManager = new MajorManager();
    $major = $majorManager->GetMajorById($majorId);
?>

<!DOCTYPE html>
<html lang="tr">

<?php include("/wamp64/www/kds/Presentation/SubHeader.php"); ?>

<script>
    function load(){
        document.getElementById("major_id").setAttribute("value","<?php echo $major->id ?>");
        document.getElementById("major_name").setAttribute("value","<?php echo $major->major_name ?>");
    }
    window.onload=load;
</script>

<script>
    function updateMajor() {
        $(document).ready(function() {
            url = "/kds/Connections/MajorManagerConnection.php";

            var majorId = $("input[name='major_id']").val();
            var majorName = $("input[name='major_name']").val();

            $.ajax({
                    type: "PUT",
                    url: url,
                    data: {
                        majorId:majorId,
                        majorName:majorName,
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
        <label class="header header-primary">Update Major </label><br><br>
        <input class="big-input" disabled type="number" id="major_id" name="major_id" placeholder="Major Id"> <br>
        <label for="major_name">Major Name</label><br>
        <input class="big-input" autofocus type="text" id="major_name" name="major_name" placeholder="Major"> <br>
        
        <label class="text-danger" id="error_message"></label><br>
        <button onclick="updateMajor()" class="btn-big btn-success btn-form">Add Major</button>
        <button onclick="cancel()" class="btn-big btn-danger btn-form">Cancel</button>
    </section>
</body>

</html>