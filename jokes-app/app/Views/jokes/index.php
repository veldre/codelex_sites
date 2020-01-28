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
        <div class="jumbotron text-center"><h3>LATEST JOKES</h3></div>
        <div class="row justify-content-center"></div>
        <form action="/jokes/create" method="post">
            <input class="btn btn-primary btn-lg btn-block" type="submit" value="Submit your joke"/>
        </form>
        <br><br>
        <div>
            <?php foreach ($jokesArr as $joke): ?>
                <?php if ($joke->accepted_at() != null): ?>
                    <strong class="text-md-left"><?php echo $joke->name(); ?></strong>
                    <p class="text-left"><?php echo $joke->content(); ?></p>
                    <p class="text-left"><?php echo $joke->created_at(); ?>  </p>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>
    <br>


<?php view('layouts/footer'); ?>