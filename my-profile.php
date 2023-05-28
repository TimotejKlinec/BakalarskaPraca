<?php
include('authentication.php');
include('includes/header.php');
include('includes/navbar.php');
?>
<div class="py-5" id="content">
<div class="container">
    <div class="row">
        <div class="col-md-12">

            <?php
                if(isset($_SESSION['status']))
                {
                    echo "<h5 class='alert alert-success'>".$_SESSION['status']."</h5>";
                    unset($_SESSION['status']);
                }
            ?>


            <div class="card text-white bg-dark">
                <div class="card-header">
                    <h4>My Profile</h4>
                </div>
                <div class="card-body">

                    <?php
                    if(isset($_SESSION['verified_user_id']))
                    {
                        $uid = $_SESSION['verified_user_id'];
                        $user = $auth->getUser($uid);
                        ?>
                        
                        <form action="code.php" method="POST" enctype="multipart/form-data">
                            
                            <div class="row">
                                <div class="col-md-8 border-end">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="">Display Name</label>
                                                <div class="form-control bg-dark text-white"><?=$user->displayName;?></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="">Email Address</label>
                                                <div class="form-control bg-dark text-white">
                                                    <?=$user->email;?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="">Your Role</label>
                                                <div class="form-control bg-dark text-white">
                                                <?php
                                                    $claims = $auth->getUser($user->uid)->customClaims;
                                                    if(isset($claims['admin']) == true)
                                                    {
                                                        echo "Role : Admin";
                                                    }
                                                    elseif($claims == null)
                                                    {
                                                        echo "Role : No Role";
                                                    }
                                                ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="">Account Status (Disable/Enable)</label>
                                                <div class="form-control bg-dark text-white">
                                                <?php
                                                if($user->disabled)
                                                {
                                                    echo "Disabled";
                                                }
                                                else
                                                {
                                                    echo "Enabled";
                                                }
                                                ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </form>

                        <?php
                    }
                    ?>
                </div>
            </div>

        </div>
    </div>
</div>

<?php
include('includes/footer.php');
?>