<?php
class logout
{
    private $logout;    

    public function __construct()
    {
        $this->deslogar();
    }

    private function deslogar()
    {
        session_start();
        session_unset();
        session_destroy();
        include("../mobile_device_detect.php");
        $mobile = mobile_device_detect();
        if ($mobile == TRUE) {
            echo "<script>alert('Logout efetuado com sucesso!');document.location='../mobile/login.php'</script>";
        } else {
            echo "<script>alert('Logout efetuado com sucesso!');document.location='../view/login'</script>";
        }
    }
}

new logout();
