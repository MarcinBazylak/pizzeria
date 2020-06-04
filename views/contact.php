<div class="center">
<h1>Kontakt</h1>

<?php

if($_GET['action'] == 'send' && $_POST['button'] == 'send') displayAlert(Contact::sendEmail($_POST));

include 'views/forms/contact.form.php';

?>

</div>