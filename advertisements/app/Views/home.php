<?php view('layouts/header'); ?>
<?php if (auth()->check()): ?>
    <br>
    <div class="container">
    <div class="jumbotron text-center"><h3> Welcome, <?php echo auth()->user()->name() ?>
            to <?php echo config('app.name'); ?>!</h3></div>

    <div class="row justify-content-center">
        <div class="btn-toolbar">
            <form action="/advertisements" method="get">
                <input class="btn btn-primary btn-lg" type="submit" value="Latest advertisements">
            </form>
            &nbsp; &nbsp;
            <form action="/advertisements/create" method="get">
                <input class="btn btn-outline-primary btn-lg btn-block" type="submit" value="Create advertisement"/>
            </form>
            &nbsp &nbsp
            <form action="/auth/logout" method="post">
                <input class="btn btn-outline-primary btn-lg btn-space" type="submit" value="Logout">
            </form>
        </div>

    </div>
<?php else: ?>
    <br>
    <div class="container">
        <div class="jumbotron text-center"><h3>Please login or register new account!</h3>
        </div>
        <div class="row justify-content-center">
            <form action="/auth/login" method="get">
                <input class="btn btn-primary btn-lg" type="submit" value="Login">
            </form>
            &nbsp;&nbsp;&nbsp;
            <form action="/auth/signup" method="get">
                <input class="btn btn-outline-primary btn-lg" type="submit" value="Register">
            </form>
        </div>
    </div>

<?php endif; ?>
<?php view('layouts/footer'); ?>