<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/custom.css">
    <style>        
        #content {
            background-image: url('images/photo1.jpg');
            background-size: cover;
            background-position: center;
            opacity: 1; 
            z-index: -1;
            min-height: 100vh;
        }
        #login {
            position: relative;
            min-height: 100vh;
        }

        #login::before {
            content: "";
            position: absolute;
            bottom: 0;
            width: 100%;
            height: 100%;
            background-image: url('images/photo5.jpg');
            background-size: cover;
            background-position: top left;
            z-index: -1;
        }

        #index {
            position: relative;
            min-height: 100vh;
        }

        #index::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('images/photo3.jpg');
            background-size: cover;
            background-position: center;
            filter: grayscale(100%);
            z-index: -1;
        }

        .jumbotron {
            background-color: #1e2124;
            color: #ffffff;
        }
        .hockey-heading {
            text-align: center;
            font-size: 40px;
            margin-top: 40px;
        }
        .hockey-image {
            max-width: 100%;
            height: auto;
            margin: 20px auto;
            display: block;
        }
        @media (max-width: 767px) {
        #content {
            background-position: top;
        }

        #login::before {
            background-position: top left;
        }

        #index::before {
            background-position: top;
        }
    }
    </style>

    <title>Find Your Gear</title>
  </head>
  <body>