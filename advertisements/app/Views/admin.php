<?php view('layouts/header'); ?>
    <br>
    <div class="container">
        <div class="jumbotron text-center"><h3>Admin panel</h3>
            <h5>Pending advertisements</h5>
        </div>
        <div class="row justify-content-center"></div>
        <form action="/advertisements" method="get">
            <input class="btn btn-outline-primary btn-lg btn-block" type="submit" value="Advertisements"/>
        </form>
        <br><br>
        <div class="container">
            <div class="row justify-content-center">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>Category</th>
                        <th>Advertisement</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <?php
                    $combinedTables = joinTables("advertisements");
                    ?>
                    <div>
                        <?php foreach ($combinedTables as $ad): ?>
                            <?php if ($ad['accepted_at'] == null): ?>
                                <tr>
                                    <td style="display:none;"><?php echo $ad['id']; ?></td>

                                    <td class="align-middle text-center"> <?php echo $ad['category']; ?></td>
                                    <td class="align-middle">   <?php echo $ad['text']; ?></td>
                                    <td class="align-middle text-center">   <?php echo $ad['username']; ?></td>
                                    <td class="align-middle text-center">   <?php echo $ad['email']; ?></td>
                                    <td class="align-middle text-center">
                                        <div class="btn-toolbar">
                                            <form action="/approve/<?php echo $ad['id']; ?>"
                                                  method="post">
                                                <input class="btn btn-primary" id="admin_button" type="submit"
                                                       value="Approve"/>
                                            </form>
                                            &nbsp; &nbsp;
                                            <form action="/admin/<?php echo $ad['id']; ?>" method="post">
                                                <input class="btn btn-danger" id="admin_button" type="submit"
                                                       value="Delete"/>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        <?php endforeach; ?>
                </table>
            </div>
        </div>
    </div>


<?php view('layouts/footer'); ?>