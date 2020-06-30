<?php
session_start();
require_once 'vendor/autoload.php';
require_once 'views/header.php';

$login = new Login();
$login::login();

$task = new Task();

$category = new Category();
$category->all_categories = true;
$all_categories = $category->getCategory();
$category->resetFilters();

if (isset($_POST['filtered_category']) && $_POST['filtered_category'] != '') {
$task->category_id = $_POST['filtered_category'];
}
$all_tasks = $task->getAllTasksAndCategories();
$task->resetFilters();

$all_tasks_count = $task->getAllTasksForEachCategory();
$task->resetFilters();
?>

<?php if(isset($_SESSION['can_view_content'])): ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 text-center">
              
                <h3>Read Tasks</h3>
                  <?php if(isset($_SESSION['username'])): ?>
                    <a href="logout.php">Logout</a>
                <?php endif; ?>
                <br>
                <h3><a class="btn btn-primary" style="float:left;margin:10px 0;" href="files/insert_task.php"
                       style="margin:10px 10px;">Insert new task</a>
                </h3>
                <form id="filter_by_category" role="form" method="post" action="index.php">
                    <div class="row">
                        <div class="form-group">
                            <select onchange="$('#filter_by_category').submit();" class="form-control" id="tasks"
                                    name="filtered_category" style="float:left;margin:10px 10px;">
                                <option selected="" disabled="">Filter By</option>
                                <option href="index.php" value="all">All</option>
                                <?php

                                foreach ($all_categories as $_category) {
                                    echo "<option   id='" . $_category['category_id'] . "' value='" . $_category['id'] . "'>" . $_category['category_name'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                </form>
                <table class="table table-dark">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Task Name</th>
                        <th scope="col">Category Name</th>
                        <th scope="col">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($all_tasks as $task): ?>
                        <tr>
                            <th scope="row"><?php echo $task['task_id']; ?></th>
                            <td><b><?php echo $task['task_name']; ?></b></td>
                            <td><b><?php echo $task['category_name']; ?></b></td>
                            <td><a href="files/update_task.php?task_id=<?php echo $task['task_id']; ?>">Edit</a> | <a
                                    onclick="return confirm('Are you sure you want to delete this task?');"
                                    href="files/delete_task.php?task_id=<?php echo $task['task_id']; ?>&action=delete">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
                <br>
            </div>
        </div>
    </div>
    <hr>
    <div class="container-fluid">
        <h3>Read Categories</h3>
        <h3><a class="btn btn-primary" style="float:left;margin:10px 0;" href="files/insert_category.php">Insert new category</a></h3>
        <table class="table table-dark">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Category Name</th>
                <th scope="col">Number of tasks per category</th>
                <th scope="col">Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($all_tasks_count as $task_count):  ?>
                <tr>
                    <th scope="row"><?php echo $task_count['category_id']; ?></th>
                    <td>
                        <b><?php echo $task_count['category_name']; ?></b>
                    </td>
                    <td>
                        <b><?php echo $task_count['task_per_cat']; ?></b>
                    </td>
                    <td>
                        <a href="files/update_category.php?category_id=<?php echo $task_count['category_id']; ?>">
                            Edit
                        </a> |
                        <a onclick="return confirm('Are you sure you want to delete this category?');"
                           href="files/delete_category.php?category_id=<?php echo $task_count['category_id']; ?>&action=delete">
                            Delete
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php endif;?>


<? require_once 'views/footer.php'; ?>


