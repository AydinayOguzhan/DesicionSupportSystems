<?php

class RoomManager
{
    private $roomDal;
    function __construct()
    {
        require_once("/wamp64/www/kds/DataAccess/RoomDal.php");
        require_once("/wamp64/www/kds/Business/Constants.php");
        $this->roomDal = new RoomDal();
    }

    function GetAllRooms()
    {
        return $this->roomDal->GetAllRooms();
    }

    function GetRoomById($roomId)
    {
        return $this->roomDal->GetRoomById($roomId);
    }

    function Delete()
    {
       
    }

    function Add()
    {
       
    }

    function Update()
    {
      
    }
}
