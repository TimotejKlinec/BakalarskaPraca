<?php
include('authentication.php');
include('includes/header.php');
include('includes/navbar.php');
?>
<div class="py-5" id="content">
<div class="container" id="index">
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
                    <h4>
                        My player
                    </h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm table-striped table-dark">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Weight</th>
                                    <th>Height</th>
                                    <th>Position</th>
                                    <th>Hit ratio</th>
                                    <th>Close range shooting</th>
                                    <th>Medium range shooting</th>
                                    <th>Long range shooting</th>
                                    <th>Shot blocking</th>
                                    <th>Goals from rebounds</th>
                                    <th>Goals from multiple rebounds</th>
                                    <th>Scoring ability</th>
                                    <th>Takeaway ability</th>
                                    <th>Faceoffs</th>
                                    <th>Penalty minutes</th>
                                    <th>Passing ability</th>
                                    <th>Edit</th>
                                    <th>Recommend</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    include('dbcon.php');
                                    $ref_table = 'players';
                                    $fetchdata = $database->getReference($ref_table)->getValue();

                                    if($fetchdata > 0)
                                    {
                                        $i=1;
                                        foreach($fetchdata as $key => $row)
                                        {
                                            if($row['email']==$auth->getUser($uid)->email){
                                            ?>
                                            <tr>   
                                                <td><?=$row['displayName'];?></td>
                                                <td><?=$row['weight'];?></td>
                                                <td><?=$row['height'];?></td>
                                                <td><?=$row['position'];?></td>
                                                <td><?=$row['hit_ratio'];?></td>
                                                <td><?=$row['shooting_close'];?></td>
                                                <td><?=$row['shooting_medium'];?></td>
                                                <td><?=$row['shooting_long'];?></td>
                                                <td><?=$row['shot_blocking'];?></td>
                                                <td><?=$row['rebound_goal'];?></td>
                                                <td><?=$row['rebound_goal_multiple'];?></td>
                                                <td><?=$row['scoring_ability'];?></td>
                                                <td><?=$row['takeaway_ability'];?></td>
                                                <td><?=$row['faceoffs'];?></td>
                                                <td><?=$row['penalty_minutes'];?></td>
                                                <td><?=$row['passing_ability'];?></td>
                                                <td>
                                                    <a href="edit-player.php?id=<?=$key;?>" class="btn btn-primary btn-sm">Edit</a>
                                                </td>
                                                <td>
                                                <form action="code.php" method="POST">
                                                        <button type="submit" name="recommend_btn" value="<?=$key?>" class="btn btn-success btn-sm">Recommend</button>
                                                </form>
                                                </td>
                                            </tr>
                                            <?php
                                            }
                                    }
                                    }
                                    else
                                    {
                                        ?>
                                            <tr>
                                                <td colspan="7">No Record Found</td>
                                            </tr>
                                        <?php
                                    }
                                ?>

                               
                            </tbody>
                            </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include('includes/footer.php');
?>