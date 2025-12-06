<?php
require_once __DIR__ . '/../BaseModel.php';

    class CategoriesModel extends BaseModel{
        private $id;
        private $name;
        public function __construct($id = 0, $name = "") {
            parent::__construct();
            $this->id = htmlspecialchars($id);
            $this->name = htmlspecialchars($name);
        }
        public function getId(): int { return $this->id; }
        public function setId(int $id): void { $this->id = $id; }

        public function getName(): string { return $this->name; }
        public function setName(string $name): void { $this->name = $name;} 
    }
?>