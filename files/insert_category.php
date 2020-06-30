<?php
require_once '../vendor/autoload.php';
require_once '../views/header.php';

$category = new Category();
//Check if you have submitted the form
if (isset($_POST['save_category'])) {
    //Insert new category query
    if ($category->insert()) {
        echo "Record inserted successfully";
        header('Location: ../index.php');
    }
}

?>
    <body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h3>Insert new category</h3>

                <div class="row">
                    <div class="col-lg-4 mx-auto">
                        <form method="post" action="insert_category.php">
                            <div class="form-group">
                                <label for="task_name">Category name</label>
                                <input type="text" name="category_name" class="form-control" value="" id="task_name"
                                       aria-describedby="emailHelp">
                            </div>

                            <input type="submit" class="btn btn-primary" name="save_category" value="Save">

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php require_once '../views/footer.php'; ?>