<?php view('layouts/header'); ?>
<?php

use App\Database;
use App\Models\Joke;

$jokesArr = [];
$getFromDB = Database::$instance->connection()->select("jokes", "*");

foreach ($getFromDB as $joke => $value) {

    $jokesArr[$value['id']] = new Joke(
        $value['id'],
        $value['name'],
        $value['content'],
        $value['created_at'],
        $value['accepted_at']
    );
}

?>
    <br>
    <div class="container">
        <div class="jumbotron text-center"><h3>Pending jokes</h3></div>
        <div class="row justify-content-center">
            <div class="btn-toolbar">
                <form action="/jokes" method="post">
                    <input class="btn btn-outline-primary btn-lg btn-space" type="submit" value="Home"/>
                </form>
                &nbsp; &nbsp;
                <form action="/jokes/deleteold" method="post">
                    <input class="btn btn-outline-primary btn-lg btn-space" type="submit"
                           value="Delete from old jokes"/>
                </form>
            </div>
        </div>
        <div>
            <?php foreach ($jokesArr as $joke): ?>
                <?php if ($joke->accepted_at() == null): ?>

                    <strong class="text-md-left"><?php echo $joke->name(); ?></strong>
                    <p class="text-left"><?php echo $joke->content(); ?></p>
                    <p class="text-left"><?php echo $joke->created_at(); ?></p>
                    <div class="btn-toolbar">
                        <form action="/jokes/approved/<?php echo $joke->id(); ?>" method="get">
                            <input class="btn btn-primary" type="submit" value="Accept"/>
                        </form>
                        &nbsp; &nbsp;
                        <form action="/jokes/deleted/<?php echo $joke->id(); ?>" method="get">
                            <input class="btn btn-danger" type="submit" value="Delete"/>
                        </form>
                    </div>
                    <br>

                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>
    <br>

<?php view('layouts/footer'); ?>