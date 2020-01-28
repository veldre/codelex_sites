<?php view('layouts/header'); ?>
<?php

use App\Database;
use App\Models\Joke;

$jokesArr = [];
$sortedByApprovalTime = Database::$instance->connection()->select("jokes", "*", ["ORDER" => "accepted_at"]);


foreach ($sortedByApprovalTime as $joke => $value) {

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
        <div class="jumbotron text-center"><h3>ALL JOKES</h3></div>
        <div class="row justify-content-center">
            <div class="btn-toolbar">
                <form action="/jokes" method="post">
                    <input class="btn btn-outline-primary btn-lg btn-space" type="submit" value="Home"/>
                </form>
                &nbsp; &nbsp;
                <form action="/jokes/admin" method="get">
                    <input class="btn btn-outline-primary btn-lg btn-space" type="submit"
                           value="Pending jokes"/>
                </form>
            </div>
        </div>
        <br><br>
        <div>
            <?php foreach ($jokesArr as $joke): ?>
                <?php if ($joke->accepted_at() != null): ?>
                    <strong class="text-md-left"><?php echo $joke->name(); ?></strong>
                    <p class="text-left"><?php echo $joke->content(); ?></p>
                    <p class="text-left"><?php echo $joke->created_at(); ?>  </p>
                    <form action="/jokes/deleted/<?php echo $joke->id(); ?>" method="get">
                        <input class="btn btn-danger" type="submit" value="Delete"/>
                    </form>
                    <br>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>
    <br>


<?php view('layouts/footer'); ?>