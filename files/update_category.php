<?php
require_once '../vendor/autoload.php';
require_once '../views/header.php';

$category = new Category();

//Check if there is a category_id in the $_GET and assign it to $category_id
$category_id = '';
if(isset($_GET['category_id']) && $_GET['category_id'] != ''){
    $category->id = $_GET['category_id'];
}


//Get the current category sql
$_category = $category->getCategory();
//If the update category form is submitted
if(isset($_POST['save_category'])){
    //Update category sql
    if ($category->update()) {
        echo "Record updated successfully";
        header('Location: ../index.php');
    }
}
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 text-center">
            <h3>Update Task</h3>
            <div class="row">
                <div class="col-lg-4 mx-auto">
                    <form method="post" action="update_category.php?category_id=<?php echo $_category['id']; ?>">
                        <div class="form-group">
                            <label for="task_name">Category name</label>
                            <input type="text" name="category_name"  class="form-control" value="<?php echo $_category['category_name']; ?>" id="task_name" aria-describedby="emailHelp">
                        </div>
                        <input type="submit" class="btn btn-primary" name="save_category" value="Save">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require_once '../views/footer.php'; ?>