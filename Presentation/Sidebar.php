<?php 
    
?>

<script>
    function signOut(){
        connectionUrl = "/kds/connections/authmanagerconnection.php";
        $.ajax({
            type:"DELETE",
            url: connectionUrl,
        }).done(function(response){
            if (response == 1) {
                window.location.replace("/kds/presentation/index.php");
            }else{
                alert(response);
            }
        });
    }
</script>

<div class="">
    <div class="sidebar">
        <header>Klinik KDS</header>
        <ul>
            <li><a href="/kds/Presentation/HomePage.php"><i class="fas fa-chart-line"></i>Dashboard</a></li>
            <li><a href="/kds/presentation/users/AllUsers.php"><i class="fas fa-users"></i>Users</a></li>
            <li><a href="/kds/presentation/doctors/AllDoctors.php"><i class="fas fa-user-md"></i>Doctors</a></li>
            <li><a href="/kds/presentation/nurses/AllNurses.php"><i class="fas fa-user-nurse"></i>Nurses</a></li>
            <li><a href="/kds/presentation/majors/AllMajors.php"><i class="fas fa-chalkboard-teacher"></i>Majors</a></li>
            <li><a href="/kds/presentation/clinic/AllClinics.php"><i class="fas fa-clinic-medical"></i>Clinics</a></li>
            <!-- <li><a href="#"><i class="fas fa-procedures"></i>Operating Rooms</a></li> -->
            <li><a href="/kds/presentation/patients/AllPatients.php"><i class="fas fa-user-injured"></i>Patients</a></li>
            <li><a href="/kds/presentation/rooms/AllRooms.php"><i class="fas fa-bed"></i>Rooms</a></li>
            <!-- <li><a href="#"><i class="fas fa-heartbeat"></i>Critical Care Units</a></li> -->
            <li><a href="#" onclick="signOut()"><i class="fas fa-times"></i>Sign Out</a></li>
            
        </ul>
    </div>
</div>