<?php

namespace controllers;

use dao\GenreDao;
use models\Genre as Genre;

class GenreController
{
    private $genreDao;

    public function __construct()
    {
        $this->genreDao = new GenreDao();
    }

    public function addGenres()
    {
        $genres = $this->genreDao->getGenres();

        for ($i = 0; $i < 19; $i++) 
        {
            $name = $genres[$i]['name'];
            $id = $genres[$i]['id'];

            $genre = new Genre();

            $genre->setGenre($name);
            $genre->setGenreId($id);

            $this->genreDao->add($genre);
        }
        return $this->genreDao->getAll();
    }
}
