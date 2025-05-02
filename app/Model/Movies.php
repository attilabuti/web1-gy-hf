<?php

class Movies_Model extends Model {

    public function add(string $url, string $title, string $releaseDate, string $description, string $trailer, string $poster) : bool {
        $sql = 'INSERT INTO movies (
             url,  title,  release_date,  description,  trailer, poster
        ) VALUES (
            :url, :title, :release_date, :description, :trailer, :poster
        )';
        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ':url'          => $url,
            ':title'        => $title,
            ':release_date' => $releaseDate,
            ':description'  => $description,
            ':trailer'      => $trailer,
            ':poster'       => $poster
        ]);
    }

    public function movieUrlExists($url) : bool {
        $stmt = $this->db->prepare('SELECT 1 FROM movies WHERE url = :url LIMIT 1');
        $stmt->execute(['url' => $url]);

        return $stmt->fetchColumn() !== false;
    }

    public function getMovies() {
        $stmt = $this->db->prepare('SELECT * FROM movies ORDER BY created_at DESC');
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getMovie($url) {
        $stmt = $this->db->prepare('SELECT * FROM movies WHERE url = :url LIMIT 1');
        $stmt->execute(['url' => $url]);

        $movie = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $movie && $movie[0] ? $movie[0] : null;
    }

}
