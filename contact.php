<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
         <!-- bootstrap + biblioteki -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script> 
        <!-- datepicker -->
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script src="files/scripts.js"></script>
    </head>
    <body>
        <?php
            require_once ('functions/contactFormValidator.php');
            
            $form_action = htmlentities($_SERVER['PHP_SELF']);
//            if(isset($_POST['submit'])) {
                $formVal = new contactFormValidator();
//            }
        ?>
        <div class="container">
            <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
                <ul class="navbar nav">
                    <li class="nav-item"><a class="nav-link text-light" href="index.php">Image-Downloader</a></li>
                    <li class="nav-item"><a class="nav-link text-warning" href="contact.php">Formularz kontaktowy</a></li>
                </ul>
            </nav>
            <div>
                <h1>Formularz kontaktowy</h1>
            </div>
            <div>
                <form action="<?php echo $form_action; ?>" method="POST">
                    <div class="form-group">
                        <label for="name">Imię i nazwisko:</label>
                        <input class="form-control form-control-sm" type="text" name="name" value="<?php if($formVal->getIs_valid() === false) {echo $formVal->getName();} ?>">
                        <span class="badge badge-danger"><?php echo $formVal->getName_err(); ?></span>
                    </div>
                    <div class="form-group">
                        <label for="email">E-mail:</label>
                        <input class="form-control form-control-sm" type="text" name="email" value="<?php if($formVal->getIs_valid() === false) {echo $formVal->getEmail();} ?>">
                        <span class="badge badge-danger"><?php echo $formVal->getEmail_err(); ?></span>
                    </div>
                    <div class="form-group">
                        <label for="phone">Nr telefonu:</label>
                        <input class="form-control form-control-sm" type="text" name="phone" value="<?php if($formVal->getIs_valid() === false) {echo $formVal->getPhone();} ?>">
                        <span class="badge badge-danger"><?php echo $formVal->getPhone_err(); ?></span>
                    </div>
                    <div class="form-group">
                        <label for="date">Data spotkania:</label>
                        <input class="form-control form-control-sm" type="text" name="date" id="datepicker" value="<?php if($formVal->getIs_valid() === false) {echo $formVal->getDate();} ?>">
                        <span class="badge badge-danger"><?php echo $formVal->getDate_err(); ?></span>
                    </div>
                    <div class="form-group">
                        <label for="msg">Treść wiadomości:</label>
                        <textarea class="form-control form-control-sm" name="msg"><?php if($formVal->getIs_valid() === false) {echo $formVal->getMsg();} ?></textarea>
                    </div>
                    <input class="btn btn-dark" type="submit" name="submit" value="Wyślij">
                    <input class="btn btn-dark" type="reset" name="reset" value="Wyczyść formularz">
                </form>
            </div>
            <div class="mt-3">
                <?php 
                    //wyswietlenie przesłanych danych
                    if(isset($_POST['submit']) && $formVal->getIs_valid() === true) {
                        $formVal->getForm();
                    }
                ?>
            </div>
        </div>
    </body>
</html>
