<?php view('layouts/header'); ?>

    <br>
    <div class="container">
        <div class="jumbotron text-center"><h3>Joke has been deleted!</h3></div>
        <div class="row justify-content-center">

            <div class="btn-toolbar">
                <form action="/jokes" method="post">
                    <input class="btn btn-outline-primary btn-lg btn-space" type="submit" value="Home"/>
                </form>
                &nbsp; &nbsp;
                <form action="/jokes/admin" method="get">
                    <input class="btn btn-outline-secondary btn-lg btn-space" type="submit" value="Admin panel"/>
                </form>
            </div>

<?php view('layouts/footer'); ?>