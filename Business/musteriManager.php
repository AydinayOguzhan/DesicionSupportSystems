<?php 


class MusteriManager{
    function getAllMusteri(){
        require("../DataAccess/musteriDal.php");
        $musteriDal = new MusteriDal();
        $d = $musteriDal->getAllMusteri();

        if ($d) {
            return $d;    
        }else{
            return "veri yok";
        }
    }
}

?>