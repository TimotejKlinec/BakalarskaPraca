<?php
session_start();
include('dbcon.php');

if(isset($_POST['user_claims_btn']))
{
    $uid = $_POST['claims_user_id'];
    $roles = $_POST['role_as'];

    if($roles == 'admin')
    {
        $auth->setCustomUserClaims($uid, ['admin' => true]);
        $msg = "User role as Admin";
    }
    elseif($roles == 'norole')
    {
        $auth->setCustomUserClaims($uid, null);
        $msg = "User role is Removed";
    }

    $auth->setCustomUserClaims($uid, ['admin' => true]);
    $msg = "User role as Admin";

    if($msg)
    {
        $_SESSION['status'] = "$msg";
        header("Location: user-edit.php?id=$uid");
        exit();
    }
    else
    {
        $_SESSION['status'] = "Password not Updated!";
        header("Location: user-edit.php?id=$uid");
        exit();
    }
}


if(isset($_POST['change_password_btn']))
{
    $new_password = $_POST['new_password'];
    $retype_password = $_POST['retype_password'];

    $uid = $_POST['change_pwd_user_id'];

    if($new_password == $retype_password)
    {
        $updatedUser = $auth->changeUserPassword($uid, $new_password);
        if($updatedUser)
        {
            $_SESSION['status'] = "Password Updated";
            header('Location: user-list.php');
            exit();
        }
        else
        {
            $_SESSION['status'] = "Password not Updated!";
            header('Location: user-list.php');
            exit();
        }
    }
    else
    {
        $_SESSION['status'] = "New password and Retype pwd does not match";
        header("Location: user-edit.php?id=$uid");
        exit();
    }
}

if(isset($_POST['enable_disable_user_ac']))
{
    $disable_enable = $_POST['select_enable_disable'];
    $uid = $_POST['ena_dis_user_id'];

    if($disable_enable == "disable")
    {
        $updatedUser = $auth->disableUser($uid);
        $msg = "Account Disabled";
    }
    else
    {
        $updatedUser = $auth->enableUser($uid);
        $msg = "Account Enabled";
    }

    if($updatedUser)
    {
        $_SESSION['status'] = $msg;
        header('Location: user-list.php');
        exit();
    }
    else
    {
        $_SESSION['status'] = "Something Went Wrong.!";
        header('Location: user-list.php');
        exit();
    }

}


if(isset($_POST['reg_user_delete_btn']))
{
    $uid = $_POST['reg_user_delete_btn'];
    $ref_table = 'players';
    $fetchdata = $database->getReference($ref_table)->getValue();
    if ($fetchdata) {
        foreach ($fetchdata as $key => $row) {
            if ($row['email'] == $auth->getUser($uid)->email) {
                $database->getReference($ref_table . '/' . $key)->remove();
            }
        }
    }

    try{
        $auth->deleteUser($uid);

        $_SESSION['status'] = "User Deleted Successuflly";
        header('Location: user-list.php');
        exit();
        
    }catch(Exception $e){

        $_SESSION['status'] = "No Id Found";
        header('Location: user-list.php');
        exit();
    }

}


if(isset($_POST['update_user_btn']))
{
    $displayname = $_POST['display_name'];
    $uid = $_POST['user_id'];
    $properties = [
        'displayName' => $displayname,
    ];
    $ref_table="players";

    $updatedUser = $auth->updateUser($uid, $properties);
    $fetchdata = $database->getReference($ref_table)->getValue();
    if ($fetchdata) {
        foreach ($fetchdata as $key => $row) {
            if ($row['email'] == $auth->getUser($uid)->email) {
                $database->getReference($ref_table . '/' . $key)->update(['displayName' => $displayname]);
            }
        }
    }

    if($updatedUser)
    {
        $_SESSION['status'] = "User Updated Successuflly";
        header('Location: user-list.php');
        exit();
    }
    else
    {
        $_SESSION['status'] = "User Not Updated";
        header('Location: user-list.php');
        exit();
    }
}



if(isset($_POST['register_btn']))
{
    $fullname = $_POST['full_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $weight = $_POST['weight'];
    $height = $_POST['height'];
    $position = $_POST['position'];
    $hit_ratio = $_POST['hit_ratio'];
    $shooting_close = $_POST['shooting_close'];
    $shooting_medium = $_POST['shooting_medium'];
    $shooting_long = $_POST['shooting_long'];
    $shot_blocking = $_POST['shot_blocking'];
    $rebound_goal = $_POST['rebound_goal'];
    $rebound_goal_multiple = $_POST['rebound_goal_multiple'];
    $scoring_ability = $_POST['scoring_ability'];
    $takeaway_ability = $_POST['takeaway_ability'];
    $faceoffs = $_POST['faceoffs'];
    $penalty_minutes = $_POST['penalty_minutes'];
    $passing_ability = $_POST['passing_ability'];

    $userProperties = [
        'email' => $email,
        'emailVerified' => false,
        'password' => $password,
        'displayName' => $fullname,
    ];
    $playerStats = [
        'email' => $email,
        'displayName' => $fullname,
        'weight'=>$weight,
        'height'=>$height,
        'position'=>$position,
        'hit_ratio'=>$hit_ratio,
        'shooting_close'=>$shooting_close,
        'shooting_medium'=>$shooting_medium,
        'shooting_long'=>$shooting_long,
        'shot_blocking'=>$shot_blocking,
        'rebound_goal'=>$rebound_goal,
        'rebound_goal_multiple'=>$rebound_goal_multiple,
        'scoring_ability'=>$scoring_ability,
        'takeaway_ability'=>$takeaway_ability,
        'faceoffs'=>$faceoffs,
        'penalty_minutes'=>$penalty_minutes,
        'passing_ability'=>$passing_ability,
    ];

    try {
        $createdUser = $auth->createUser($userProperties);
        $refTable = 'players';
        $postRef_result = $database->getReference($refTable)->push($playerStats);

        if($createdUser)
        {
            $_SESSION['status'] = "User Created/Registered Successfully";
            header('Location: register.php');
            exit();
        }
        else
        {
            $_SESSION['status'] = "User Not Created/Registered";
            header('Location: register.php');
            exit();
        }
    } catch (\Kreait\Firebase\Exception\AuthException $e) {
        // Handle the exception
        $_SESSION['status'] = $e->getMessage();
        header('Location: register.php');
        exit();
    }
}



if(isset($_POST['recommend_btn']))
{
    $rec_id = $_POST['recommend_btn'];
    $command = escapeshellcmd("python main.py $rec_id");

    $result = shell_exec($command);
    $data = json_decode($result);
    $_SESSION['data'] = $data;
    header('Location: recommend-player.php');
}

if (isset($_POST['update_player'])) {
    try {
        $key = $_POST['key'];
        $displayName = $_POST['displayName'];
        $weight = $_POST['weight'];
        $height = $_POST['height'];
        $position = $_POST['position'];
        $hit_ratio = $_POST['hit_ratio'];
        $shooting_close = $_POST['shooting_close'];
        $shooting_medium = $_POST['shooting_medium'];
        $shooting_long = $_POST['shooting_long'];
        $shot_blocking = $_POST['shot_blocking'];
        $rebound_goal = $_POST['rebound_goal'];
        $rebound_goal_multiple = $_POST['rebound_goal_multiple'];
        $scoring_ability = $_POST['scoring_ability'];
        $takeaway_ability = $_POST['takeaway_ability'];
        $faceoffs = $_POST['faceoffs'];
        $penalty_minutes = $_POST['penalty_minutes'];
        $passing_ability = $_POST['passing_ability'];

        $updateData = [
            'displayName' => $displayName,
            'weight' => $weight,
            'height' => $height,
            'position' => $position,
            'hit_ratio' => $hit_ratio,
            'shooting_close' => $shooting_close,
            'shooting_medium' => $shooting_medium,
            'shooting_long' => $shooting_long,
            'shot_blocking' => $shot_blocking,
            'rebound_goal' => $rebound_goal,
            'rebound_goal_multiple' => $rebound_goal_multiple,
            'scoring_ability' => $scoring_ability,
            'takeaway_ability' => $takeaway_ability,
            'faceoffs' => $faceoffs,
            'penalty_minutes' => $penalty_minutes,
            'passing_ability' => $passing_ability,
        ];

        $ref_table = 'players/' . $key;
        $updatequery_result = $database->getReference($ref_table)->update($updateData);

        if ($updatequery_result) {
            $_SESSION['status'] = "Player Updated Successfully";
            header('Location: index.php');
        } else {
            $_SESSION['status'] = "Player Not Updated";
            header('Location: index.php');
        }
    } catch (Exception $e) {
        // Handle the exception here
        $_SESSION['status'] = "An error occurred during the update process.";
        header('Location: index.php');
    }
}
?>