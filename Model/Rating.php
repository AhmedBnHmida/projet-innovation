<?php
class Rating {
    private ?int $id = null;
    private int $evaluator_id;
    private int $idea_id;
    private int $rating;
    private ?string $created_at = null; // YYYY-MM-DD HH:MM:SS

    public function __construct(int $evaluator_id, int $idea_id, int $rating, ?string $created_at = null) {
        $this->evaluator_id = $evaluator_id;
        $this->idea_id = $idea_id;
        $this->rating = $rating;
        $this->created_at = $created_at;
    }

    // Getters & Setters
    public function getId(): ?int { return $this->id; }
    public function setId(int $id): void { $this->id = $id; }

    public function getEvaluatorId(): int { return $this->evaluator_id; }
    public function setEvaluatorId(int $evaluator_id): void { $this->evaluator_id = $evaluator_id; }

    public function getIdeaId(): int { return $this->idea_id; }
    public function setIdeaId(int $idea_id): void { $this->idea_id = $idea_id; }

    public function getRating(): int { return $this->rating; }
    public function setRating(int $rating): void { $this->rating = $rating; }

    public function getCreatedAt(): ?string { return $this->created_at; }
    public function setCreatedAt(?string $created_at): void { $this->created_at = $created_at; }
}
