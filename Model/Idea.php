<?php
class Idea {
    private ?int $id = null;
    private string $title;
    private ?string $description;
    private int $user_id;
    private int $theme_id;

    public function __construct(string $title, ?string $description, int $user_id, int $theme_id) {
        $this->title = $title;
        $this->description = $description;
        $this->user_id = $user_id;
        $this->theme_id = $theme_id;
    }
    // getters / setters...
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
}
