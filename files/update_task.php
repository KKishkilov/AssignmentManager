<?php
require_once '../vendor/autoload.php';
require_once '../views/header.php';

$task = new Task();
$category = new Category();
$category->all_categories = true;
$task->id = $_GET['task_id'];
$update_task = $task->getAllTasksAndCategories();
$task->resetFilters();
$categories = $category->getCategory();
$category->resetFilters();


if(isset($_POST['save_task'])){
    $task->id = $_GET['task_id'];
    if ($task->update()) {
        echo "Record updated successfully";
        header('Location: ../index.php');
    }
}

?>

    <body>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 text-center">
            <h3>Update Task</h3>
            <div class="row">
                <div class="col-lg-4 mx-auto">
                    <form method="post" action="update_task.php?task_id=<?php echo $update_task[0]['task_id']; ?>">
                        <div class="form-group">
                            <label for="task_name">Task name</label>
                            <input type="text" name="task_name"  class="form-control" value="<?php echo $update_task[0]['task_name']; ?>" id="task_name" aria-describedby="emailHelp">
                        </div>
                        <div class="form-group">
                            <label for="category_id">Category</label>
                            <select class="form-control" id="category_id" name="category_id">
                                <?php foreach($categories as $category):?>
                                    <option  <?php  echo ($update_task[0]['task_id'] == $category['id']) ? 'selected' : '' ?> value="<?php echo $category['id']; ?>"><?php echo $category['category_name']; ?></option>
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