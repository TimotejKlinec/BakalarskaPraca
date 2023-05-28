<?php
include('authentication.php');
include('includes/header.php');
include('includes/navbar.php');
?>
<div class="py-5" id="index">

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h1>
                        Edit & Update Player
                            <a href="index.php" class="btn btn-danger float-end"> BACK</a>
                        </h1>
                    </div>
                    <div class="card-body">

                        <?php
                            include('dbcon.php');

                            if(isset($_GET['id']))
                            {
                                $key_child = $_GET['id'];

                                $ref_table = 'players';
                                $getdata = $database->getReference($ref_table)->getChild($key_child)->getValue();

                                if($getdata > 0)
                                {
                                    ?>
                                <form action="code.php" method="POST">

                                    <input type="hidden" name="key" value="<?=$key_child;?>">
                                    <div class="divider">
                            <h2 class="section-description">Section 1</h2>
                            <p>General information about player.</p>
                            </div>
                                    <div class="form-group mb-3">
                                <label for="">Full Name</label>
                                <input type="text" name="displayName" value="<?=$getdata['displayName'];?>" class="form-control" required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="">Weight</label>
                                <input type="text" name="weight" value="<?=$getdata['weight'];?>" class="form-control" required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="">Height</label>
                                <input type="text" name="height" value="<?=$getdata['height'];?>" class="form-control" required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="position">Position</label>
                                <input type="text" name="position" id="position" pattern="[DCLR]" value="<?=$getdata['position'];?>" class="form-control" required>
                                <small>Valid values are: D-deffender, C-center, L-left wing, R-right wing</small>
                            </div>
                            
                            <hr>
                            
                            <div class="divider">
                            <h2 class="section-description">Section 2</h2>
                            <p>Players are required to enter numeric values from 0 to 10 according to their style of play.</p>
                            </div>

                            <div class="form-group mb-3" id="faceoffsDiv" style="display: none;">
                                <label for="">Faceoffs (only if your position is center)</label>
                                <input type="number" name="faceoffs" id="faceoffs" min="0" max="10" value="<?= isset($getdata['faceoffs']) ? $getdata['faceoffs'] : 0; ?>" class="form-control" required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="">Hit ratio</label>
                                <input type="number" name="hit_ratio" min="0" max="10" value="<?=$getdata['hit_ratio'];?>" class="form-control" required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="">Close range shooting</label>
                                <input type="number" name="shooting_close" min="0" max="10" value="<?=$getdata['shooting_close'];?>" class="form-control" required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="">Medium range shooting</label>
                                <input type="number" name="shooting_medium" min="0" max="10" value="<?=$getdata['shooting_medium'];?>" class="form-control" required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="">Long range shooting</label>
                                <input type="number" name="shooting_long" min="0" max="10" value="<?=$getdata['shooting_long'];?>" class="form-control" required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="">Shot blocking</label>
                                <input type="number" name="shot_blocking" min="0" max="10" value="<?=$getdata['shot_blocking'];?>" class="form-control" required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="">Scoring from a rebound</label>
                                <input type="number" name="rebound_goal" value="<?=$getdata['rebound_goal'];?>" class="form-control" required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="">Scoring after multiple rebounds</label>
                                <input type="number" name="rebound_goal_multiple" min="0" max="10" value="<?=$getdata['rebound_goal_multiple'];?>" class="form-control" required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="">Scoring ability</label>
                                <input type="number" name="scoring_ability" min="0" max="10" value="<?=$getdata['scoring_ability'];?>" class="form-control" required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="">Takeaway ability</label>
                                <input type="number" name="takeaway_ability" min="0" max="10" value="<?=$getdata['takeaway_ability'];?>" class="form-control" required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="">Penalty minutes</label>
                                <input type="number" name="penalty_minutes" min="0" max="10" value="<?=$getdata['penalty_minutes'];?>" class="form-control" required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="">Passing ability</label>
                                <input type="number" name="passing_ability" min="0" max="10" value="<?=$getdata['passing_ability'];?>" class="form-control" required>
                            </div>
                                    <div class="form-group mb-3">
                                        <button type="submit" name="update_player" class="btn btn-primary ">Update Player</button>
                                    </div>

                                </form>
                            <?php
                                }
                                else
                                {
                                    $_SESSION['status'] = "Invalid Id";
                                    header('Location: index.php');
                                    exit();
                                }
                            }
                            else
                            {
                                $_SESSION['status'] = "No Found";
                                header('Location: index.php');
                                exit();
                            }
                            ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
    const positionInput = document.getElementById('position');
    const faceoffsDiv = document.getElementById('faceoffsDiv');
    const faceoffsInput = document.getElementById('faceoffs');

    positionInput.addEventListener('input', function() {
        if (positionInput.value === 'C') {
            faceoffsDiv.style.display = 'block';
            faceoffsInput.required = true;
        } else {
            faceoffsDiv.style.display = 'none';
            faceoffsInput.required = false;
            faceoffsInput.value = 0; 
        }
    });
</script>

<?php
include('includes/footer.php');
?>