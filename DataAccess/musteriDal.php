<?php 


class MusteriDal{
    function getAllMusteri(){
        require("../DataAccess/connection/connection.php");

        if($baglan){

            $sorgu = mysqli_query($baglan,"SELECT * FROM musteriler");
        
            if (mysqli_num_rows($sorgu) > 0) {
                $list = array();
                while($row=mysqli_fetch_assoc($sorgu)){
                    $list[] = $row;
                }
                return $list;
                mysqli_close($baglan);
            }else
                return "Veri yok";
        }else
            return "Bağlantı Başarısız";
        
    }
}

?>