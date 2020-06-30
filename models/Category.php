<?php

class Category {
    protected $db;

    private $connection;

    public function __construct()
    {
        $this->db = new Database();
        $this->connection = $this->db->getConnection();
    }

    public function getCategory()
    {
        if(isset($this->id)){
            $stmt = $this->connection->prepare("SELECT * FROM categories WHERE id=:id");
            $stmt->execute(['id' => $this->id]);
            return $stmt->fetch();
        }elseif(isset($this->category_name)){
            $stmt = $this->connection->prepare("SELECT * FROM categories WHERE category_name=:category_name");
            $stmt->execute(['category_name' => $this->category_name]);
            return $stmt->fetch();
        }elseif(isset($this->all_categories) && $this->all_categories == true){
            $stmt = $this->connection->prepare("SELECT * FROM categories as c");
            $stmt->execute();
            return $stmt->fetchAll();
        }
    }

    public function resetFilters()
    {
        $this->id = null;
        $this->category_name = null;
        $this->all_categories = null;
    }

    public function delete($id)
    {
        $stmt = $this->connection->prepare("DELETE FROM categories WHERE id=:id");
        return $stmt->execute(['id' => $id]);
    }

    public function insert()
    {
        $stmt = $this->connection->prepare("INSERT INTO categories(category_name) VALUES (:category_name)");
        return $stmt->execute(['category_name' => $_POST['category_name']]);
    }

    public function update()
    {
        $stmt = $this->connection->prepare("UPDATE categories SET category_name=:category_name WHERE id=:id");
        return $stmt->execute(['id' => $this->id, 'category_name' => $_POST['category_name']]);
    }

}