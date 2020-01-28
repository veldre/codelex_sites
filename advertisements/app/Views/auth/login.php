<?php view('layouts/header'); ?>

    <br>
    <div class="container">
        <div class="jumbotron text-center"><h3>Please login!</h3></div>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <?php if (flashMessage()->get()): ?>
                    <div class="alert alert-danger">
                        <?php echo flashMessage()->get(); ?>
                    </div>
                <?php endif; ?>
                <form method="post" action="/auth/login">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                               name="email">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" class="form-control" id="exampleInputPassword1" name="password">
                    </div>
                    <div class="btn-toolbar">
                        <button type="submit" class="btn btn-primary btn-lg btn-space">
                            Submit
                        </button>
                </form>
                &nbsp; &nbsp;
                <form action="/auth/signup" method="get">
                    <input class="btn btn-outline-primary btn-lg" type="submit" value="Signup">
                </form>
            </div>
        </div>
    </div>
    </div>

<?php view('layouts/footer'); ?>