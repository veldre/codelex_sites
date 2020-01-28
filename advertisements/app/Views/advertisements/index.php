<?php view('layouts/header');

use App\Controllers\AdminController;

if (isset($_GET['adCategory'])) {
    $latestAds = adsByCategory("advertisements", $_GET['category']);
} else {
    $latestAds = joinTables("advertisements");
}
?>
    <br>
    <div class="container">
        <div class="jumbotron" id="mainPage"></div>
        <form action="/advertisements/create" method="get">
            <input class="btn btn-warning btn-lg btn-block" type="submit" value="Create advertisement"/>
        </form>
        <br>

        <div class="container">
            <form name="selections" action="" method="get">
                <label>
                    <select name="category" class="form-control-sm justify-content-left"
                        <?php $categories = database()->select('categories', '*'); ?>>
                        <?php foreach ($categories as $category): ?>

                            <option value="<?php echo $category['id']; ?>" selected="selected">
                                <?php echo $category['name']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </label>
                &nbsp; <input class="btn-primary btn-sm" id="selectBtn" name="adCategory" type="submit" value="Choose">
            </form>
        </div>

        <div class="container">
            <div class="btn-toolbar justify-content-center">
                <form action="/advertisements" method="get">
                    <input class="btn btn-outline-primary btn-sm" type="submit" value="All advertisements">
                </form>
                &nbsp; &nbsp;
                <form action="/auth/logout" method="post">
                    <input class="btn btn-outline-primary btn-sm btn-space" type="submit" value="Logout">
                </form>
            </div>
        </div>
        <br>

        <table class="table table-hover">
            <thead class="thead-dark">
            <tr>
                <th>Category</th>
                <th>Advertisement</th>
                <th>Name</th>
                <th>Email</th>
                <th>Posted</th>
                <th>Action</th>
            </tr>
            </thead>


            <?php if (isset($_POST['editButton'])): ?>
            <?php

            $id = $_POST['id'] ?? 0;
            $ad = showSingleAd($id); ?>

            <form method="post" action="/advertisements/<?php echo $ad['id']; ?>">
                <input type="hidden" name="_method" value="PUT"/>
                <div class="container">
                    <label for="category">Category:</label>
                    <br>
                    <select name="category" id="category" class="form-control-sm justify-content-left">
                        <?php foreach ($categories as $category): ?>
                            <option value="<?php echo $category['id']; ?>" <?php if ($category['id'] === input()->get('category')): ?> selected="selected" <?php endif; ?>>
                                <?php echo $category['name']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>

                    <div class="row justify-content-left">
                        <div class="col-8">
                            <br>
                            <label for="text">Edit your ad text:</label>
                            <textarea class="form-control" id="text"
                                      name="text"><?php echo $ad['text']; ?></textarea>
                            <?php if (errors()->has('text')): ?>
                                <?php echo errors()->get('text'); ?>
                            <?php endif; ?>
                            <br>
                            <button type="submit" class="btn btn-primary btn-sm">
                                Submit changes
                            </button>
                            <br><br>

                            <?php endif; ?>
                        </div>
                    </div>
                </div>


                <?php foreach ($latestAds as $ad): ?><?php if ($ad['accepted_at'] != null): ?>

                    <tr>
                        <td style="display:none;"><?php echo $ad['id']; ?></td>
                        <td style="display:none;"><?php echo $ad['userId']; ?></td>

                        <td class="align-middle text-center">   <?php echo $ad['category']; ?></td>
                        <td class="align-middle">   <?php echo $ad['text']; ?></td>
                        <td class="align-middle text-center">   <?php echo $ad['username']; ?></td>
                        <td class="align-middle text-center">   <?php echo $ad['email']; ?></td>
                        <td class="align-middle text-center">   <?php echo $ad['accepted_at']; ?></td>
                        <td class="align-middle text-center">
                            <div class="btn-group-vertical">
                                <form action="/advertisements/showAd/<?php echo $ad['id']; ?>" method="post">
                                    <input type="hidden" name="id" value="<?php echo $ad['id']; ?>">
                                    <input class="btn-dark btn-sm" id="menu" type="submit" value="Show">
                                </form>

                                <?php if (AdminController::checkAdminRights()): ?>

                                    <form action="/<?php echo $ad['id']; ?>" method="post">
                                        <input type="hidden" name="id" value="<?php echo $ad['id']; ?>">
                                        <input class="btn-danger btn-sm" id="menu" type="submit" value="Delete">
                                    </form>

                                <?php endif; ?>

                                <?php if ($_SESSION['authentication_key'] == $ad["userId"]): ?>

                                    <form action="" method="post">
                                        <input type="hidden" name="id" value="<?php echo $ad['id']; ?>">
                                        <input class="btn-dark btn-sm" name="editButton" id="menu" type="submit"
                                               value="Edit">
                                    </form>
                                    <form action="/admin/<?php echo $ad['id']; ?>" method="post">
                                        <input type="hidden" name="id" value="<?php echo $ad['id']; ?>">
                                        <input class="btn-dark btn-sm" id="menudel" type="submit" value="Delete">
                                    </form>

                                <?php endif; ?>
                            </div>
                        </td>
                    </tr>

                <?php endif; ?>
                <?php endforeach; ?>

        </table>
    </div>


<?php view('layouts/footer'); ?>