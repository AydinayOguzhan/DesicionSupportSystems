<?php 

session_start();

echo $_SESSION["email"];
echo $_SESSION["userId"];


// require("../kds/DataAccess/connection/connection.php");
// if ($kdsCon) {
    // $query = mysqli_query($kdsCon, "SELECT * FROM `users` WHERE email="."'aydinayoguzhan@gmail.com'");
    // $email = "aydinayoguzhan@gmail.com";
    // $query = mysqli_query($kdsCon, "SELECT * FROM `users` WHERE email='".$email."'");

    // var_dump($query);
    // echo mysqli_num_rows($query);

    // require_once("../kds/Entities/user.php");
    // $userObj = new User();
    // $userObj =mysqli_fetch_object($query);
    // var_dump($userObj);
    // echo $userObj->email;


    // if ($query == "") {
    //     // return $this->userObj;
    //     return "kullanıcı bulunamadı";   
    // }else{
    //     $this->userObj = mysqli_fetch_object($query);
    //     return $userObj;
    // }
// }else{
//     echo "bağlantı yok";
// }