<?php
include('authentication.php');
include('includes/header.php');
include('includes/navbar.php');
?>
<div class="py-5">
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
        </div>
    </div>
<div class="jumbotron jumbotron-fluid">
        <div class="container">
            <h1 class="display-4">Welcome to Find Your Gear!</h1>
            <p class="lead">Place to find your perfect hockey equipment.</p>
        </div>
    </div>

    <div class="container">
        <h2 class="hockey-heading">Gear up and hit the ice!</h2>
        <img src="images/photo2.jpg" alt="Hockey Image" class="hockey-image">

        <div class="row">
            <div class="col-md-6">
                <h3>About Hockey</h3>
                <p>Ice hockey, the sport where grown adults turn into clumsy penguins on frozen water, chasing a rubbery UFO with sticks while wearing more padding than a marshmallow. It's like a high-speed collision of chaos and controlled mayhem, where players gracefully stumble and occasionally throw punches, all in pursuit of putting a tiny, elusive puck into a net guarded by a masked goaltender with superhuman reflexes. It's a hilarious spectacle that combines icy acrobatics, slapstick moments, and a dash of organized madness on skates.</p>
            </div>
            <div class="col-md-6">
                <h3>About us</h3>
                <p>We are using the logic behind recommendation systems to provide you with the most accurate ice hockey gear based on your style of game. You just enter data about your game and Find Your Gear compares your entry with the NHL players statistics and gives you the results.</p>
            </div>
        </div>

        <div class="text-center">
        <button type="button" class="btn btn-primary btn-lg" onclick="redirectToIndex()">Find Your Gear</button>
        </div>
    </div>
    <script>
    function redirectToIndex() {
        window.location.href = "index.php";
    }
</script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<?php
include('includes/footer.php');
?>