<?php
require_once __DIR__ . '/../BaseModel.php';
class UsersModel extends BaseModel{
    private $id;
    private $name;
    private $email;
    private $password;
    private $role;
    private $isActive;

    
    public function __construct($id = 0, $name = "", $email = "", $password = "") {
        parent::__construct();
        $this->id = htmlspecialchars($id);
        $this->name = htmlspecialchars($name);
        $this->email = htmlspecialchars($email);
        $this->password = htmlspecialchars($password);
        $this->role = htmlspecialchars(1);
        $this->isActive = 0;
    }

    public function getId(): int { return $this->id; }
    public function setId(int $id): void { $this->id = $id; }

    public function getEmail(): string { return $this->email; }
    public function setEmail(string $email): void { $this->email = $email; }

    public function getPassword(): string { return $this->password; }
    public function setPassword(string $password): void { $this->password = $password; }

    public function getName(): string { return $this->name; }
    public function setName(string $name): void { $this->name = $name; }

    public function getRole(): int { return $this->role; }
    public function setRole(int $role): void { $this->role = $role; }

    public function getIsActive(): int { return $this->isActive; }
    public function setIsActive(int $isActive): void { $this->isActive = $isActive; }
}