<?php view('layouts/header'); ?>
<?php if (flashMessage()->get()): ?>
    <div class="alert alert-danger">
        <?php echo flashMessage()->get(); ?>
    </div>
<?php endif; ?>

<br>
<div class="container">
    <div class="jumbotron text-center"><h3>Please signup!</h3></div>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <form method="post" action="/auth/signup">
                <div class="form-group">
                    <label>Name:</label>
                    <input type="text" class="form-control" name="name">
                </div>
                <div class="form-group">
                    <label>Email address:</label>
                    <input type="email" class="form-control" aria-describedby="emailHelp" name="email">
                    <small class="form-text text-muted">We'll never share your email with anyone
                        else.</small>
                </div>
                <div class="form-group">
                    <label>Password:</label>
                    <input type="password" class="form-control" name="password">
                </div>
                <div class="form-group">
                    <label>Confirm password:</label>
                    <input type="password" class="form-control" name="confirmPass">
                </div>
                <div class="btn-toolbar">
                    <input class="btn btn-primary btn-lg btn-space" type="submit" value="Signup"/>
                    &nbsp; &nbsp;
            </form>
            <form action="/auth/login" method="get">
                <input class="btn btn-outline-primary btn-lg" type="submit" value="Login">
            </form>
        </div>


    </div>

</div>
</div>


<?php view('layouts/footer'); ?>
