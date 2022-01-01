<?php
require_once("/wamp64/www/kds/Business/DoctorManager.php");
require_once("/wamp64/www/kds/Business/NurseManager.php");
require_once("/wamp64/www/kds/Business/ClinicManager.php");
$doctorManager = new DoctorManager();
$nurseManager = new NurseManager();
$clinicManager = new ClinicManager();

$doctors = array();
$doctorWages = array();
$nurses = array();
$clinicAplicationNumbers = array();
$clinicPatientsAge = array();


$doctorClinics = $doctorManager->GetDoctorWorkplaceNumbers();
$doctorWages = $doctorManager->GetAllDoctorsWithWage();
$clinicAplicationNumbers = $clinicManager->GetClinicApplicationNumbers();
$clinicPatientsAge = $clinicManager->GetClinicPatientsAge();
$nurses = $nurseManager->GetNurseWorkplaceNumbers();

if (count($doctorClinics) <= 0 || count($clinicAplicationNumbers) <= 0 || count($clinicPatientsAge) <= 0) {
    echo "Ber şeyler ters gitti";
} else {

    $doctorClinicNames =  array_map(function ($ar) {
        return $ar["clinic_name"];
    }, $doctorClinics);

    $doctorClinicNumbers =  array_map(function ($ar) {
        return $ar["COUNT(dwp.clinic_id)"];
    }, $doctorClinics);

    $aplicationNumbers = array_map(function ($ar) {
        return $ar["application_numbers"];
    }, $clinicAplicationNumbers);

    $patientsAge = array_map(function ($ar) {
        return $ar["age"];
    }, $clinicPatientsAge);

    $nurseNumbers = array_map(function ($ar) {
        return $ar["nurse_numbers"];
    }, $nurses);

    $dWages = array_map(function ($ar) {
        return $ar["wage"];
    }, $doctorWages);
    $dNames = array_map(function ($ar) {
        return $ar["doctor_first_name"];
    }, $doctorWages);
?>

    <!DOCTYPE html>
    <html lang="tr">

    <script>
        var doctorClinicNames, doctorClinicNumbers, aplicationNumbers, patientsAge;
        var myChart4, ctx4;
        var aplicationColor = [];
        var doctorColor = [];

        var ageColor = [];
        var ctx, myChart;

        var nurseNumbers;
        var nurseNumbersCanvas, nurseNumbersChart;

        var doctorWages, doctorNames, doctorCtx, doctorWagesChart;

        function drawChart() {

            doctorClinicNames = [<?php echo '"' . implode('","', $doctorClinicNames) . '"' ?>];
            doctorClinicNumbers = [<?php echo '"' . implode('","', $doctorClinicNumbers) . '"' ?>];
            aplicationNumbers = [<?php echo '"' . implode('","', $aplicationNumbers) . '"' ?>];
            patientsAge = [<?php echo '"' . implode('","', $patientsAge) . '"' ?>];
            nurseNumbers = [<?php echo '"' . implode('","', $nurseNumbers) . '"' ?>]
            doctorWages = [<?php echo '"' . implode('","', $dWages) . '"' ?>]
            doctorNames = [<?php echo '"' . implode('","', $dNames) . '"' ?>]
            // var color = [];
            // var dynamicColors = function() {
            //     var r = Math.floor(Math.random() * 255);
            //     var g = Math.floor(Math.random() * 255);
            //     var b = Math.floor(Math.random() * 255);
            //     return "rgb(" + r + "," + g + "," + b + ")";
            // };


            createDoctorAndApplicationNumbersChart();
            createPatientAverageAgeChart();
            createNurseAndApplicationNumbersChart();
            createDoctorWagesChart();

        }
        window.onload = drawChart;

        function createDoctorAndApplicationNumbersChart() {
            aplicationColor = [];
            doctorColor = [];
            for (let i = 0; i < doctorClinicNumbers.length; i++) {
                const element = doctorClinicNumbers[i];
                if (aplicationNumbers[i] - element >= 2) {
                    doctorColor.push("#ff0011");
                    aplicationColor.push("#e21d22");
                } else {
                    doctorColor.push("#00ff5b");
                    aplicationColor.push("#27d851");
                }
            }

            ctx4 = document.getElementById("myChart4");
            myChart4 = new Chart(ctx4, {
                type: 'bar',
                data: {
                    labels: doctorClinicNames,
                    datasets: [{
                            data: aplicationNumbers,
                            label: "Başvuru sayıları",
                            backgroundColor: aplicationColor
                        },
                        {
                            data: doctorClinicNumbers,
                            label: "Doktor sayıları",
                            backgroundColor: doctorColor
                        }
                    ],
                },
            });
        }

        function createDoctorWagesChart(){
            doctorCtx = document.getElementById("doctorWagesChart");
            doctorWagesChart = new Chart(doctorCtx, {
                type: 'bar',
                data: {
                    labels: doctorNames,
                    datasets: [{
                            data: doctorWages,
                            label: "Maaş",
                            backgroundColor: "#0086ff"
                        }],
                },
            });
        }

        function createPatientAverageAgeChart() {
            ageColor = [];
            for (let i = 0; i < patientsAge.length; i++) {
                const element = patientsAge[i];
                if (element >= 0 && element < 18) {
                    ageColor.push("#fff500");
                } else if (element >= 18 && element < 30) {
                    ageColor.push("#00ff5b");
                } else {
                    ageColor.push("#ff0011");
                }
            }
            ctx = document.getElementById("myChart");
            myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: doctorClinicNames,
                    datasets: [{
                        data: patientsAge,
                        label: "Hasta Yaşları",
                        backgroundColor: ageColor,
                        borderColor: ageColor
                    }],
                },
            });
        }

        function createNurseAndApplicationNumbersChart() {
            aplicationColor = [];
            nurseColor = [];
            for (let i = 0; i < nurseNumbers.length; i++) {
                const element = nurseNumbers[i];
                if (aplicationNumbers[i] - element >= 2) {
                    nurseColor.push("#ff0011");
                    aplicationColor.push("#e21d22");
                } else {
                    nurseColor.push("#00ff5b");
                    aplicationColor.push("#27d851");
                }
            }

            nurseNumbersCanvas = document.getElementById("nurseNumbersCanvas");
            nurseNumbersChart = new Chart(nurseNumbersCanvas, {
                type: 'bar',
                data: {
                    labels: doctorClinicNames,
                    datasets: [{
                            data: aplicationNumbers,
                            label: "Başvuru sayıları",
                            backgroundColor: aplicationColor
                        },
                        {
                            data: nurseNumbers,
                            label: "Hemşire sayıları",
                            backgroundColor: nurseColor
                        }
                    ],
                },
            });
        }

        function openModal(modalId) {
            var modal = document.getElementById(modalId);
            var main = document.getElementById("main");
            modal.style.display = "block";
            main.classList.add("fade");
        }

        function cancelModal(modalId) {
            var modal = document.getElementById(modalId);
            var main = document.getElementById("main");
            modal.style.display = "none";
            main.classList.remove("fade");
        }

        function modal1() {
            var selectClinic = document.getElementById("selectClinic");
            for (let i = 0; i < doctorClinicNames.length; i++) {
                const element = doctorClinicNames[i];
                var option = document.createElement("option");
                option.value = i;
                option.innerHTML = element;
                selectClinic.appendChild(option);
            }
        }

        function clearModalData(elementIds) {
            elementIds.forEach(item => {
                var element = document.getElementById(item);
                element.innerHTML = "";
                element.value = 0;
            });
        }

        var _procedure = null;

        function add(modalId) {
            checkProcedure(_procedure, "errMessage", "Pleace choose a procedure");
            if (modalId == "modal1") {
                var selectClinic = document.getElementById("selectClinic").value;
                var doctorNumber = document.getElementById("doctorNumber").value;
                var patientNumber = document.getElementById("patientNumber").value;
                modal1Add(selectClinic, doctorNumber, patientNumber);
                myChart4.destroy();
                createDoctorAndApplicationNumbersChart();
            }
        }

        function modal1Add(clinicId, numberOfDoctors, numberOfPatients) {
            if (_procedure == 1) {
                if (doctorNumber == 0) {
                    aplicationNumbers[clinicId] = parseInt(aplicationNumbers[clinicId]) + parseInt(numberOfPatients);
                } else if (patientNumber == 0) {
                    doctorClinicNumbers[clinicId] = parseInt(doctorClinicNumbers[clinicId]) + parseInt(numberOfDoctors);
                } else {
                    aplicationNumbers[clinicId] = parseInt(aplicationNumbers[clinicId]) + parseInt(numberOfPatients);
                    doctorClinicNumbers[clinicId] = parseInt(doctorClinicNumbers[clinicId]) + parseInt(numberOfDoctors);
                }
            } else if (_procedure == 0) {
                if (doctorNumber == 0) {
                    aplicationNumbers[clinicId] = parseInt(aplicationNumbers[clinicId]) - parseInt(numberOfPatients);
                } else if (patientNumber == 0) {
                    doctorClinicNumbers[clinicId] = parseInt(doctorClinicNumbers[clinicId]) - parseInt(numberOfDoctors);
                } else {
                    aplicationNumbers[clinicId] = parseInt(aplicationNumbers[clinicId]) - parseInt(numberOfPatients);
                    doctorClinicNumbers[clinicId] = parseInt(doctorClinicNumbers[clinicId]) - parseInt(numberOfDoctors);
                }
            }
        }

        function checkProcedure(procedureId, errElementId, errorMessage) {
            if (procedureId == 1) {
                clearError(errElementId);
            } else if (procedureId == 0) {
                clearError(errElementId);
            } else {
                showError(errElementId, errorMessage);
            }
        }

        function showError(elementId, errorMessage) {
            var errMessage = document.getElementById(elementId);
            errMessage.innerHTML = errorMessage;
        }

        function clearError(elementId) {
            var errMessage = document.getElementById(elementId);
            errMessage.innerHTML = null;
        }

        function procedure(procedure) {
            if (procedure == "plus") {
                _procedure = 1;
            } else if (procedure == "minus") {
                _procedure = 0;
            }
        }
    </script>


    <body>
        <div id="main">
            <div class="chart-container" style="text-align:center; height:40vh; width:70vh; position:absolute;left:20%; top:10%;">
                <label class="dashboard-header" for="myChart4">Kliniklere Göre Gelen Hasta ve Doktor Sayıları</label>
                <canvas id="myChart4"></canvas>
                <button onclick="openModal('modal1'); modal1();" class="btn btn-primary">Add Data</button>
            </div>

            <div class="chart-container" style="text-align:center; height:40vh; width:70vh; position:absolute;left:60%; top:10%;">
                <label class="dashboard-header" for="nurseNumbersCanvas">Kliniklere Göre Gelen Hasta ve Hemşire Sayıları</label>
                <canvas id="nurseNumbersCanvas"></canvas>
            </div>

            <div class="chart-container" style="text-align:center; height:40vh; width:70vh; position:absolute;left:20%; top:60%;">
                <label class="dashboard-header" for="myChart">Kliniklere Göre Gelen Hasta Yaş Ortalamaları</label>
                <canvas id="myChart"></canvas>
            </div>

            <div class="chart-container" style="text-align:center; height:40vh; width:70vh; position:absolute;left:60%; top:60%;">
                <label class="dashboard-header" for="myChart">Doktor Maaşları</label>
                <canvas id="doctorWagesChart"></canvas>
            </div>
        </div>
    </body>


    <div hidden id="modal1" class="modal">
        <select class="modal-select" id="selectClinic"></select>
        <br>
        <label for="doctorNumber">Number Of Doctors</label>
        <br>
        <input type="number" id="doctorNumber" value="0">
        <br>
        <label for="doctorNumber">Number Of Patients</label>
        <br>
        <input type="number" id="patientNumber" value="0">
        <br>
        <button onclick="procedure('plus');" class="btn btn-success"><i class="fa fa-plus" aria-hidden="true"></i></button>
        <button onclick="procedure('minus');" class="btn btn-danger"><i class="fa fa-minus" aria-hidden="true"></i></button>
        <br>
        <label class="label text-danger" id="errMessage"></label>
        <br><br>
        <button onclick="add('modal1'); clearModalData(['selectClinic','doctorNumber', 'patientNumber']); cancelModal('modal1');" class="btn btn-success">Add</button>
        <button onclick="cancelModal('modal1'); clearModalData(['selectClinic', 'doctorNumber', 'patientNumber']); clearError('errMessage');" class="btn btn-danger">Cancel</button>
    </div>

    </html>
<?php } ?>