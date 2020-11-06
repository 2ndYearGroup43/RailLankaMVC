<?php 
    require APPROOT .'/views/includes/head.php';
?>
<?php 
    require APPROOT.'/views/includes/navigationModerator.php';
?>

<?php var_dump($_SESSION);?>

<!-- <div class="body-section"> -->
    <div class="container-login">
        <div class="wrapper-login">
            <h2>Sign in</h2>
            <form action="<?php echo URLROOT; ?>/moderators/login" method="POST">
                <input type="text" placeholder="UserName *" name="username">
                <span class="invalidFeedback">
                    <?php echo $data['usernameError'];?>
                </span>
                <input type="password" placeholder="Password *" name="password">
                <span class="invalidFeedback">
                    <?php echo $data['passwordError'];?>
                </span>

                <button id="submit" type="submit" value="submit">Submit</button>
                <p class="options">Not registered yet? <a href="<?php echo URLROOT;?>/moderators/registerModerator">Create an account!</a></p>
            </form>
        </div>
    </div>
<!-- </div> -->



<?php 
    require APPROOT. '/views/includes/footer.php';
?>
