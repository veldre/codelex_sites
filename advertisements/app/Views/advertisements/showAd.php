<?php view('layouts/header');

$id = $_POST['id'] ?? 0;
$ad = showSingleAd($id);

?>

<br>
<div class="container">
    <div class="jumbotron text-center"><h3>Advertisement #<?php echo $id; ?></h3></div>
    <div class="row justify-content-center">
        <br>
        <div class="container">
            <table class="table">
                <div class="row justify-content-center">
                    <thead>
                    <tr>
                        <th>Category</th>
                        <th>Advertisement</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Posted</th>
                    </tr>
                    </thead>
                </div>
                <tr>
                    <td style="display:none;"><?php echo $ad['id']; ?></td>

                    <td class="align-middle text-center">   <?php echo $ad['category']; ?></td>
                    <td class="align-middle">   <?php echo $ad['text']; ?></td>
                    <td class="align-middle text-center">   <?php echo $ad['username']; ?></td>
                    <td class="align-middle text-center">   <?php echo $ad['email']; ?></td>
                    <td class="align-middle text-center">   <?php echo $ad['accepted_at']; ?></td>
                </tr>
            </table>
        </div>


        <div class="btn-toolbar">
            <form action="/advertisements" method="get">
                <input class="btn btn-outline-primary btn-lg btn-block" type="submit"
                       value="All advertisements">
            </form>
            &nbsp; &nbsp;
            <form action="/advertisements/create" method="get">
                <input class="btn btn-outline-primary btn-lg btn-block" type="submit"
                       value="Create advertisement"/>
            </form>
            &nbsp; &nbsp;
            <form action="/auth/logout" method="post">
                <input class="btn btn-outline-primary btn-lg btn-space" type="submit" value="Logout">
            </form>
        </div>
    </div>
    <?php view('layouts/footer'); ?>
