<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
         <!-- bootstrap + biblioteki -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script> 
    </head>
    <body>
        <?php
            require_once ('functions/Images.php');
            require_once ('functions/imageFormValidator.php');
            
            $form_action = htmlentities($_SERVER['PHP_SELF']);  
        ?>
        <div class="container">
            <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
                <ul class="navbar nav">
                    <li class="nav-item"><a class="nav-link text-warning" href="index.php">Image-Downloader</a></li>
                    <li class="nav-item"><a class="nav-link text-light" href="contact.php">Formularz kontaktowy</a></li>
                </ul>
            </nav>
            <div>
                <h1>Image Downloader</h1>
            </div>
            <div>
                <form action="<?php echo $form_action; ?>" method="POST">
                    <div class="form-group">
                        <label for="url">Adres strony:</label>
                        <input class="form-control form-control-sm" type="text" name="url" placeholder="http://">
                    </div>
                    <input class="btn btn-dark" type="submit" name="submit" value="Pobierz obrazy">
                </form>
            </div>
            <div class="mt-3 list-group">
                <?php 
                    //wyswietlenie listy obrazow
                    if(isset($_POST['submit'])) {
                        $formVal = new imageFormValidator();
                        $url = $formVal->testURL();
                        if(isset($url)) {
                        $images = new Images($url);
                        $images->getImageList();
                        } 
                    }
                ?>
            </div>
        </div>
    </body>
</html>
