<?php
session_start();
if(isset($_SESSION['verified_user_id']))
{
    $_SESSION['status'] = "You are already Logged in";
    header('Location: home.php');
    exit();
}
include('includes/header.php');
?>
<div class="py-5" id="index">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">

                <?php
                if(isset($_SESSION['status']))
                {
                    echo "<h5 class='alert alert-success'>".$_SESSION['status']."</h5>";
                    unset($_SESSION['status']);
                }
                ?>
                <div class="card">
                    <div class="card-header">
                        <h4>
                            Register
                            <a href="index.php" class="btn btn-danger float-end"> BACK</a>
                        </h4>
                    </div>
                    <div class="card-body">

                        <form action="code.php" method="POST">
                            <div class="divider">
                            <h2 class="section-description">Section 1</h2>
                            <p>General information about player.</p>
                            </div>

                            <div class="form-group mb-3">
                                <label for="">Full Name</label>
                                <input type="text" name="full_name" class="form-control" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Email Address</label>
                                <input type="email" name="email" minlength="3" class="form-control"required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="password">Password</label>
                                <input type="password" name="password" class="form-control" required minlength="6">
                                <small>Password has to be longer than 6 characters.</small>
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Weight</label>
                                <input type="text" name="weight" class="form-control" required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="">Height</label>
                                <input type="text" name="height" class="form-control" required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="">Position</label>
                                <input type="text" name="position" id="position" pattern="[DCLR]" class="form-control" required>
                                <small>Valid values are: D-deffender, C-center, L-left wing, R-right wing</small>
                            </div>

                            <hr>
                            
                            <div class="divider">
                            <h2 class="section-description">Section 2</h2>
                            <p>Players are required to enter numeric values from 0 to 10 according to their style of play.</p>
                            </div>

                            <div class="form-group mb-3" id="faceoffsDiv" style="display: none;">
                                <label for="">Faceoffs (only if your position is center)</label>
                                <input type="number" name="faceoffs"  min="0" max="10" value="0" id="faceoffs" class="form-control">
                            </div>

                            <div class="form-group mb-3">
                                <label for="">Hit ratio</label>
                                <input type="number" name="hit_ratio" min="0" max="10" class="form-control" required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="">Close range shooting</label>
                                <input type="number" name="shooting_close" class="form-control" required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="">Medium range shooting</label>
                                <input type="number" name="shooting_medium" min="0" max="10" class="form-control" required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="">Long range shooting</label>
                                <input type="number" name="shooting_long" class="form-control" required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="">Shot blocking</label>
                                <input type="number" name="shot_blocking" min="0" max="10" class="form-control" required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="">Scoring from a rebound</label>
                                <input type="number" name="rebound_goal" min="0" max="10" class="form-control" required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="">Scoring after multiple rebounds</label>
                                <input type="number" name="rebound_goal_multiple" class="form-control" required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="">Scoring ability</label>
                                <input type="number" name="scoring_ability" min="0" max="10" class="form-control" required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="">Takeaway ability</label>
                                <input type="number" name="takeaway_ability" min="0" max="10" class="form-control" required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="">Penalty minutes</label>
                                <input type="number" name="penalty_minutes" min="0" max="10" class="form-control" required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="">Passing ability</label>
                                <input type="number" name="passing_ability" min="0" max="10" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <button type="submit" name="register_btn" class="btn btn-primary ">Register</button>
                            </div>

                        </form>

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
        }
    });
</script>

<?php
include('includes/footer.php');
?>