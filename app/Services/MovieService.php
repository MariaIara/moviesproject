<?php

namespace App\Services;

use App\Entities\MovieEntity;
use App\Models\Movies;

class MovieService
{
    protected Movies $movies;

    public function __construct(Movies $moviesModel)
    {
        $this->movies = $moviesModel;
    }

    public function list()
    {
        // Chama o método da model para retornar todos os dados
        return $this->movies->findAll();
    }

    public function new(MovieEntity $movie)
    {
        // Chamar método da model pra inserir no banco
        return $this->movies->create($movie);
    }

    public function update(MovieEntity $movie)
    {
        return $this->movies->save($movie);
    }

    public function destroy(int $id)
    {
        return $this->movies->delete($id);
    }
}
