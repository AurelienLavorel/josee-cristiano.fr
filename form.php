<?php
    $config = array(
        'title' => 'Josée Cristiano',
        'description' => 'CV de Josée Cristiano',
        'currentPage' => 'contact',
	'page' => '/form.php',
    );

    $sendMessage = false;
    if (isset($_POST['name']) && isset($_POST['email'])) {
        $name = htmlentities($_POST['name']);
        $email = htmlentities($_POST['email']);
        $message = $name . '<' . $email . '>' . "\n" . htmlentities($_POST['message']);

        mail("joseecristiano74@gmail.com", "Formulaire de contact", $message);
    }

    $imgPath = '/img/design/';
    $files = scandir(dirname(__FILE__) . $imgPath);
?>
<?php include 'include/header.php'; ?>

            <div class="inner content">
                <div class="row contactForm">
                    <?php if ($sendMessage) : ?>
                    <div class="alert alert-success" role="alert">Merci, votre message a bien été envoyé.</div>
                    <?php endif; ?>
                    <form class="form-horizontal" method="post">
                        <div class="form-group">
                            <label for="name">Nom *</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Votre nom">
                        </div>
                        <div class="form-group">
                            <label for="email">Adresse email *</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Votre email">
                        </div>
                        <div class="form-group">
                            <label for="message">Votre message *</label>
                            <textarea class="form-control" id="message" name="message" rows="5"></textarea>
                        </div><?php /*
                        <div class="form-group">
                            <label for="file">Fichier</label>
                            <input type="file" id="file" name="file">
                        </div>*/ ?>
                        <button type="submit" class="btn btn-default">Envoyer !</button>
                    </form>
                </div>
            </div>

 <?php include 'include/footer.php'; ?>
