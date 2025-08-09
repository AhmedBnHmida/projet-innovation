<?php
class Idea {
    private ?int $id = null;
    private string $title;
    private ?string $description;
    private int $user_id;
    private int $theme_id;
    private ?string $created_at = null; // YYYY-MM-DD HH:MM:SS

    public function __construct(string $title, ?string $description, int $user_id, int $theme_id, ?string $created_at = null) {
        $this->title = $title;
        $this->description = $description;
        $this->user_id = $user_id;
        $this->theme_id = $theme_id;
        $this->created_at = $created_at;
    }

    // Getters and setters
    public function getId(): ?int { return $this->id; }
    public function setId(int $id): void { $this->id = $id; }

    public function getTitle(): string { return $this->title; }
    public function setTitle(string $title): void { $this->title = $title; }

    public function getDescription(): ?string { return $this->description; }
    public function setDescription(?string $description): void { $this->description = $description; }

    public function getUserId(): int { return $this->user_id; }
    public function setUserId(int $user_id): void { $this->user_id = $user_id; }

    public function getThemeId(): int { return $this->theme_id; }
    public function setThemeId(int $theme_id): void { $this->theme_id = $theme_id; }

    public function getCreatedAt(): ?string { return $this->created_at; }
    public function setCreatedAt(?string $created_at): void { $this->created_at = $created_at; }
}
