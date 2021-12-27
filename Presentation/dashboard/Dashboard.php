<?php
require_once("/wamp64/www/kds/Business/DoctorManager.php");
require_once("/wamp64/www/kds/Business/NurseManager.php");
require_once("/wamp64/www/kds/Business/ClinicManager.php");
$doctorManager = new DoctorManager();
// $nurseManager = new NurseManager();
$clinicManager = new ClinicManager();

$doctors = array();
// $nurses = array();
$clinicApplicationNumbers = array();
$clinicPatientsAge = array();


$doctorClinics = $doctorManager->GetDoctorWorkplaceNumbers();
$clinicApplicationNumbers = $clinicManager->GetClinicApplicationNumbers();
$clinicPatientsAge = $clinicManager->GetClinicPatientsAge();

if (count($doctorClinics) <= 0 ||count($clinicApplicationNumbers) <= 0 || count($clinicPatientsAge) <= 0) {
    echo "Ber şeyler ters gitti";
} else {
    
    $doctorClinicNames =  array_map(function ($ar) {
        return $ar["clinic_name"];
    }, $doctorClinics);
    $doctorClinicNumbers =  array_map(function ($ar) {
        return $ar["COUNT(dwp.clinic_id)"];
    }, $doctorClinics);

    $applicationNumbers = array_map(function($ar){
        return $ar["application_numbers"];
    },$clinicApplicationNumbers);

    $patientsAge = array_map(function($ar){
        return $ar["age"];
    },$clinicPatientsAge);

    
?>

    <!DOCTYPE html>
    <html lang="tr">

    <script>
        function drawChart() {
            
            var doctorClinicNames = [<?php echo '"' . implode('","', $doctorClinicNames) . '"' ?>];
            var doctorClinicNumbers = [<?php echo '"' . implode('","', $doctorClinicNumbers) . '"' ?>];
            var applicationNumbers = [<?php echo '"' . implode('","', $applicationNumbers) . '"' ?>];
            var patientsAge = [<?php echo '"' . implode('","', $patientsAge) . '"' ?>];

            // var color = [];
            // var dynamicColors = function() {
            //     var r = Math.floor(Math.random() * 255);
            //     var g = Math.floor(Math.random() * 255);
            //     var b = Math.floor(Math.random() * 255);
            //     return "rgb(" + r + "," + g + "," + b + ")";
            // };
            
            var applicationColor = [];
            var doctorColor = [];
            for (let i = 0; i < doctorClinicNumbers.length; i++) {
                const element = doctorClinicNumbers[i];
                if (applicationNumbers[i] - element >= 2) {
                    doctorColor.push("#ff0011");
                    applicationColor.push("#e21d22");
                }else{
                    doctorColor.push("#00ff5b");
                    applicationColor.push("#27d851");
                }
            }

            var ctx4 = document.getElementById("myChart4");
            var myChart4 = new Chart(ctx4, {
                type: 'bar',
                data: {
                    labels: doctorClinicNames,
                    datasets: [{
                        data: applicationNumbers,
                        label: "Başvuru sayıları",
                        backgroundColor: applicationColor
                    },
                    {
                        data: doctorClinicNumbers,
                        label: "Doktor sayıları",
                        backgroundColor: doctorColor
                    }],
                },
            });


            var ageColor = [];
            for (let i = 0; i < patientsAge.length; i++) {
                const element = patientsAge[i];
                if (element >= 0 && element < 18) {
                    ageColor.push("#fff500");
                }else if(element <= 18 && element < 30){
                    ageColor.push("#00ff5b");
                }else{
                    ageColor.push("#ff0011");
                }
            }
            var ctx = document.getElementById("myChart");
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: doctorClinicNames,
                    datasets: [{
                        data: patientsAge,
                        label: "Hasta Yaşları",
                        backgroundColor: ageColor
                    }],
                },
            });
        }
        window.onload = drawChart;

    </script>


    <body>
        <div class="chart-container" style="text-align:center; height:40vh; width:70vh; position:absolute;left:20%; top:10%;">
            <label class="dashboard-header" for="myChart4">Kliniklere Göre Gelen Hasta ve Doktor Sayıları</label>
            <canvas id="myChart4"></canvas>
        </div>

        <div class="chart-container" style="text-align:center; height:40vh; width:70vh; position:absolute;left:60%; top:10%;">
            <label class="dashboard-header" for="myChart">Kliniklere Göre Gelen Hasta Yaş Ortalamaları</label>
            <canvas id="myChart"></canvas>
        </div>
    </body>


        <!-- <div hidden id="div" style="background-color:white; position:absolute;left:60%; top:10%;">
            <input type="number" id="deneme" name="deneme">
            <input type="text" id="isim" >
            <button onclick="deneme2()" class="btn btn-success">search</button>
        </div> -->

    </html>
<?php } ?>