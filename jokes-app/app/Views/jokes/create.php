<?php view('layouts/header'); ?>

<br>
<div class="container">
    <div class="jumbotron text-center"><h3>Submit your joke!</h3></div>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <form method="post" action="/jokes/admin">
                <div class="form-group">
                    <label for="nameInput">Name:</label>
                    <input type="text" class="form-control" id="nameInput" name="name"/>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Your joke:</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" name="content" rows="3"></textarea>
                </div>
                <div class="btn-toolbar">
                    <form action="/jokes/admin" method="post">
                        <input class="btn btn-primary btn-lg btn-space" type="submit" value="Submit"/>
                    </form>
                    <form action="/" method="post">
                        <input class="btn btn-outline-secondary btn-lg btn-space" type="submit" value="Home"/>
                    </form>
                </div>
            </form>
        </div>
    </div>
</div>
</div>

<?php view('layouts/footer'); ?>
