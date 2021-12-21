<?php
require_once("/wamp64/www/kds/Business/DoctorManager.php");
require_once("/wamp64/www/kds/Business/NurseManager.php");
$doctorManager = new DoctorManager();
$nurseManager = new NurseManager();
$doctors = array();
$nurses = array();
$doctors = $doctorManager->GetAllDoctorsWithWage();
$doctorClinics = $doctorManager->GetDoctorWorkplaceNumbers();
$nurses = $nurseManager->GetAllNursesWithWage();
$nurseClinics = $nurseManager->GetNurseWorkplaceNumbers();

if (count($doctors) <= 0 || count($nurses) <= 0) {
    echo "Ber şeyler ters gitti";
} else {
    $doctorWages =  array_map(function ($ar) {
        return $ar["wage"];
    }, $doctors);
    $doctors = array_map(function ($ar) {
        return $ar["doctor_first_name"];
    }, $doctors);

    $nurseWages =  array_map(function ($ar) {
        return $ar["wage"];
    }, $nurses);
    $nurses =  array_map(function ($ar) {
        return $ar["nurse_first_name"];
    }, $nurses);

    $doctorClinicNames =  array_map(function ($ar) {
        return $ar["clinic_name"];
    }, $doctorClinics);
    $doctorClinicNumbers =  array_map(function ($ar) {
        return $ar["COUNT(dwp.clinic_id)"];
    }, $doctorClinics);

    $nurseClinicNames =  array_map(function ($ar) {
        return $ar["clinic_name"];
    }, $nurseClinics);
    $nurseClinicNumbers =  array_map(function ($ar) {
        return $ar["COUNT(nwp.clinic_id)"];
    }, $nurseClinics);
?>

    <!DOCTYPE html>
    <html lang="tr">

    <script>
        function drawChart() {
            // Our labels along the x-axis
            var years = ["America", 1600, 1700, 1750, 1800, 1850, 1900, 1950, 1999, 2050];
            // For drawing the lines
            var africa = [86, 114, 106, 106, 107, 111, 133, 221, 783, 2478];
            var asia = [282, 350, 411, 502, 635, 809, 947, 1402, 3700, 5267];
            var europe = [168, 170, 178, 190, 203, 276, 408, 547, 675, 734];
            var latinAmerica = [40, 20, 10, 16, 24, 38, 74, 167, 508, 784];
            var northAmerica = [6, 3, 2, 2, 7, 26, 82, 172, 312, 433];

            var doctorWages = [<?php echo '"' . implode('","', $doctorWages) . '"' ?>];
            var doctors = [<?php echo '"' . implode('","', $doctors) . '"' ?>];
            var nurseWages = [<?php echo '"' . implode('","', $nurseWages) . '"' ?>];
            var nurses = [<?php echo '"' . implode('","', $nurses) . '"' ?>];
            var doctorClinicNames = [<?php echo '"' . implode('","', $doctorClinicNames) . '"' ?>];
            var doctorClinicNumbers = [<?php echo '"' . implode('","', $doctorClinicNumbers) . '"' ?>];
            var doctorClinicNames = [<?php echo '"' . implode('","', $doctorClinicNames) . '"' ?>];
            var nurseClinicNumbers = [<?php echo '"' . implode('","', $nurseClinicNumbers) . '"' ?>];

            var ctx = document.getElementById("myChart");
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: doctors,
                    datasets: [{
                        label: "Doktor Maaşları",
                        data: doctorWages,
                        backgroundColor: "#6610f2"
                    }]
                },
            });
            var ctx1 = document.getElementById("myChart1");
            var myChart1 = new Chart(ctx1, {
                type: 'bar',
                data: {
                    labels: nurses,
                    datasets: [{
                        data: nurseWages,
                        label: "Hemşire Maaşları",
                        backgroundColor: "#28a745"
                    }]
                },
            });

            var color = [];
            var nurseColor = [];
            var dynamicColors = function() {
                var r = Math.floor(Math.random() * 255);
                var g = Math.floor(Math.random() * 255);
                var b = Math.floor(Math.random() * 255);
                return "rgb(" + r + "," + g + "," + b + ")";
            };
            var nurseDynamicColors = function() {
                var r = Math.floor(Math.random() * 255);
                var g = Math.floor(Math.random() * 255);
                var b = Math.floor(Math.random() * 255);
                return "rgb(" + r + "," + g + "," + b + ")";
            };
            for (var i in doctorClinicNumbers) {
                color.push(dynamicColors());
            }
            for (var i in nurseClinicNumbers) {
                nurseColor.push(dynamicColors());
            }
            var ctx2 = document.getElementById("myChart2");
            var myChart2 = new Chart(ctx2, {
                type: 'doughnut',
                data: {
                    labels: doctorClinicNames,
                    datasets: [{
                            data: doctorClinicNumbers,
                            backgroundColor: color,
                        },
                    ],
                },
            });

            var ctx3 = document.getElementById("myChart3");
            var myChart3 = new Chart(ctx3, {
                type: 'doughnut',
                data: {
                    labels: doctorClinicNames,
                    datasets: [{
                        data: nurseClinicNumbers,
                        label: "Kliniklerin yoğunluk oranı",
                        backgroundColor: nurseColor
                    }],
                },
            });
        }
        window.onload = drawChart;
    </script>


    <body>
        <div class="chart-container" style="height:40vh; width:70vh; position:absolute;left:20%; top:10%;">
            <canvas id="myChart"></canvas>
        </div>
        <div class="chart-container" style="height:40vh; width:70vh; position:absolute;left:60%; top:10%;">
            <canvas id="myChart1"></canvas>
        </div>
        <div class="chart-container" style="height:40vh; width:70vh; position:absolute;left:20%; top:60%;">
            <canvas id="myChart2"></canvas>
        </div>
        <div class="chart-container" style="height:40vh; width:70vh; position:absolute;left:60%; top:60%;">
            <canvas id="myChart3"></canvas>
        </div>
    </body>

<?php } ?>

    </html>