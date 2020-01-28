<?php view('layouts/header'); ?>
    <br>
    <div class="container">
        <div class="jumbotron text-center"><h3>Create advertisement!</h3>
        </div>
    </div>


<?php if (flashMessage()->get()): ?>
    <div class="alert alert-danger">
        <?php echo flashMessage()->get(); ?>
    </div>
<?php endif; ?>

    <form method="post" action="/advertisements">
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
            <br><br>
            <div class="row justify-content-left">
                <div class="col-8">
                    <label for="text">Your ad text:</label>
                    <textarea class="form-control" id="text"
                              name="text"><?php echo input()->get('text'); ?></textarea>
                    <?php if (errors()->has('text')): ?>
                        <?php echo errors()->get('text'); ?>
                    <?php endif; ?> <br> <br>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <button type="submit" class="btn btn-primary btn-lg">
                Submit
            </button>
    </form>
    &nbsp &nbsp
    <form action="/advertisements" method="get">
        <input class="btn btn-outline-primary btn-lg" type="submit" value="Back to advertisements">
    </form>
    &nbsp &nbsp
    <form action="/auth/logout" method="post">
        <input class="btn btn-outline-primary btn-lg btn-space" type="submit" value="Logout">
    </form>


<?php view('layouts/footer'); ?>