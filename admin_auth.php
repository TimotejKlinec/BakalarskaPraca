<?php
session_start();
include('dbcon.php');

if(isset($_SESSION['verified_user_id']))
{
    if(isset($_SESSION['verified_admin']))
    {
        $uid = $_SESSION['verified_user_id'];
        $idTokenString = $_SESSION['idTokenString'];
        
        try {
            $verifiedIdToken = $auth->verifyIdToken($idTokenString);

            $claims = $auth->getUser($uid)->customClaims;
            if(isset($claims['admin']) == true)
            {
            
            }
            else
            {
                header("Location: logout.php");
                exit(0);
            }
        } catch (InvalidToken $e) {
            $_SESSION['expiry_status'] = "Token Expired/Invalid. Login Again";
            header('Location: logout.php');
            exit();
        } catch (\InvalidArgumentException $e) {
            $_SESSION['status'] = "Token Expired/Invalid. Login Again";
            header('Location: logout.php');
            exit();
        }
    }
    else
    {
        $_SESSION['status'] = "Access denied.! because you are not an admin.";
        header("Location: {$_SERVER["HTTP_REFERER"]}");
        exit();
    }
}
else
{
    $_SESSION['status'] = "Login to access this page";
    header('Location: login.php');
    exit();
}
?>