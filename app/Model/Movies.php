<?php

class Movies_Model extends Model {

    public function add(string $url, string $title, string $releaseDate, string $description, string $poster) : bool {
        $sql = 'INSERT INTO movies (
             url,  title,  release_date,  description,  poster
        ) VALUES (
            :url, :title, :release_date, :description, :poster
        )';
        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ':url'          => $url,
            ':title'        => $title,
            ':release_date' => $releaseDate,
            ':description'  => $description,
            ':poster'       => $poster
        ]);
    }

    public function movieUrlExists($url) : bool {
        $stmt = $this->db->prepare('SELECT 1 FROM movies WHERE url = :url LIMIT 1');
        $stmt->execute(['url' => $url]);

        return $stmt->fetchColumn() !== false;
    }

}
