<?php
include('includes/header.php');
session_start();
$data = $_SESSION['data'];
?>
<div class="py-5" id="content">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card text-white bg-dark">
                <div class="card-header">
                    <h4 class="card-title">
                        Recommended players
                        <a href="index.php" class="btn btn-danger float-end">BACK</a>
                    </h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover table-dark">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Name</th>
                                    <th>Hockey Stick</th>
                                    <th>Stick flex</th>
                                    <th>Gloves</th>
                                    <th>Helmet</th>
                                    <th>Skates</th>
                                    <th>Pants</th>
                                    <th>Similarity percentage</th>
                                </tr>
                            </thead>
                            <tbody>
                            
                                <?php
                                foreach($data as $player) : ?>
                                    <tr>
                                        <td><?php echo $player[0]; ?></td>
                                        <td><?php echo $player[1]; ?></td>
                                        <td><?php echo $player[2]; ?></td>
                                        <td><?php echo $player[3]; ?></td>
                                        <td><?php echo $player[4]; ?></td>
                                        <td><?php echo $player[5]; ?></td>
                                        <td><?php echo $player[6]; ?></td>
                                        <td><?php echo $player[7]; ?>%</td>
                                    </tr>
                                <?php endforeach; ?>
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