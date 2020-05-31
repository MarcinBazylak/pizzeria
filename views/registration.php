            <?php
            if($_GET['action'] == 'register' && $_POST['submit'] == 'submit') displayAlert($user->create($_POST));
            $lastId = $user->lastId;
            ?>
            <div class="center">
            <?php
            if(User::authAdmin()){
               include 'views/forms/registration.form.php';
            } else {
               displayLoginForm();
            }
            ?>
            </div>