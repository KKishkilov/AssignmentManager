<?php

class Task {
    protected $db;
    protected $table = 'tasks';
    private $connection;

    public function __construct()
    {
        $this->db = new Database();
        $this->connection = $this->db->getConnection();
    }

    public function getTask()
    {
        if(isset($this->id)){          // $task = new Task(); $task->id = 3; $task->getTask();
            $stmt = $this->connection->prepare("SELECT * FROM tasks WHERE id=:id");
            $stmt->execute(['id' => $this->id]);
            return $stmt->fetch();
        }elseif(isset($this->tasks_name)){
            $stmt = $this->connection->prepare("SELECT * FROM tasks WHERE tasks_name=:tasks_name");
            $stmt->execute(['tasks_name' => $this->tasks_name]);
            return $stmt->fetch();
        }elseif(isset($this->category_id)){
            $stmt = $this->connection->prepare("SELECT * FROM tasks WHERE category_id=:category_id");
            $stmt->execute(['category_id' => $this->category_id]);
            return $stmt->fetch();
        }
        return [];
    }

    public function getAllTasksAndCategories()
    {
        $where = '';
        if(isset($this->category_id) && $this->category_id != 'all'){
            $where = ' WHERE t.category_id = ' .$this->category_id;
        }
        $stmt = $this->connection->prepare("SELECT t.id as task_id, c.id as category_id, t.tasks_name as task_name,c.category_name as category_name FROM tasks as t
LEFT JOIN categories as c
ON t.category_id = c.id ".$where);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getAllTasksForEachCategory()
    {
        $stmt = $this->connection->prepare("SELECT t.id as task_id, c.id as category_id, t.tasks_name as task_name,c.category_name as category_name, COUNT(t.id) as task_per_cat FROM tasks as t
LEFT JOIN categories as c
ON t.category_id = c.id GROUP BY (c.id)");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function resetFilters()
    {
        $this->id = null;
        $this->tasks_name = null;
        $this->category_id = null;
    }

    public function delete($id)
    {
            $stmt = $this->connection->prepare("DELETE FROM tasks WHERE id=:id");
            return $stmt->execute(['id' => $id]);
    }

    public function update()
    {
        $stmt = $this->connection->prepare("UPDATE tasks SET tasks_name=:tasks_name,category_id=:category_id WHERE id=:id");
        return $stmt->execute(['id' => $this->id, 'tasks_name' => $_POST['task_name'], 'category_id' => $_POST['category_id']]);
    }

    public function insert()
    {
        $stmt = $this->connection->prepare("INSERT INTO tasks(tasks_name, category_id) VALUES (:tasks_name,:category_id)");
        return $stmt->execute(['tasks_name' => $_POST['task_name'], 'category_id' => $_POST['category_id']]);
    }
}