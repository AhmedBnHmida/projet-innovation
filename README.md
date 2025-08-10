# Projet Innovation - PHP MVC

Gestion des idées et de l'innovation en entreprise.



CREATE TABLE ratings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    evaluator_id INT NOT NULL,
    idea_id INT NOT NULL,
    rating INT NOT NULL CHECK (rating BETWEEN 1 AND 10),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (evaluator_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (idea_id) REFERENCES ideas(id) ON DELETE CASCADE,
    UNIQUE (evaluator_id, idea_id)
);





php -S localhost:8000


http://localhost:8000


