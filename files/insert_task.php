<?php
require_once '../vendor/autoload.php';
require_once '../views/header.php';

$category = new Category();
$category->all_categories = 'true';
$categories = $category->getCategory();
$category->resetFilters();

$task = new Task();

//Check if you have submitted the form
//if(isset($_POST['save_task'])){
//    //Insert new task query
//    $insert_task_sql = "INSERT INTO tasks(name, category_id) VALUES ('".$_POST['task_name']."','".$_POST['category_id']."')";
//    //Execute the query and redirect back to the tasks list
//    if (mysqli_query($db, $insert_task_sql)) {
//        echo "Record inserted successfully";
//        header('Location: ../index.php');
//    } else {
//        echo "Error updating record: " . mysqli_error($db);
//    }
//}
if(isset($_POST['save_task'])){

    if ($task->insert()) {
        echo "Record inserted successfully";
        header('Location: ../index.php');
    }
}

?>
     <body>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 text-center">
            <h3>Insert new task</h3>
            <div class="row">
                <div class="col-lg-4 mx-auto">
                    <form method="post" action="insert_task.php">
                        <div class="form-group">
                            <label for="task_name">Task name</label>
                            <input type="text" name="task_name"  class="form-control" value="" id="task_name" aria-describedby="emailHelp">
                        </div>
                        <div class="form-group">
                            <label for="category_id">Category </label>
                            <select class="form-control" id="category_id" name="category_id">
                                <?php
                                    foreach ($categories as $_category): ?>
                                        <?php echo "<option   id='" . $_category['category_id'] . "' value='" . $_category['id'] . "'>" . $_category['category_name'] . "</option>"; ?>

                                <?php endforeach; ?>
                            </select>
                        </div>
                        <input type="submit" class="btn btn-primary" name="save_task" value="Save">

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require_once '../views/footer.php'; ?>