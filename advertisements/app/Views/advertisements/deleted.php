<?php view('layouts/header'); ?>

<br>
<div class="container">
    <div class="jumbotron text-center"><h3>Your advertisement has been deleted!</h3></div>
    <div class="row justify-content-center">

        <div class="btn-toolbar">
            <form action="/advertisements" method="get">
                <input class="btn btn-outline-primary btn-lg btn-block" type="submit" value="All advertisements">
            </form>
            &nbsp; &nbsp;
            <form action="/advertisements/create" method="get">
                <input class="btn btn-outline-primary btn-lg btn-block" type="submit" value="Create advertisement"/>
            </form>
            &nbsp; &nbsp;
            <form action="/auth/logout" method="post">
                <input class="btn btn-outline-primary btn-lg btn-space" type="submit" value="Logout">
            </form>
        </div>

        <?php view('layouts/footer'); ?>
