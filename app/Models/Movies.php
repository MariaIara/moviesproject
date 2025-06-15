<?php

namespace App\Models;

use App\Entities\MovieEntity;
use CodeIgniter\Model;

class Movies extends Model
{
    protected $table            = 'movies';
    protected $returnType       = MovieEntity::class;
    protected $allowedFields    = [
        'name',
        'category',
        'status'
    ];

    public function firstById(int $id): ?MovieEntity
    {
        return $this
            ->where('id', $id)
            ->first();
    }

    public function create(MovieEntity $movie): MovieEntity
    {
        // O método insert da model retorna apenas o ID
        $inserted_id = $this->insert($movie);

        // Setamos (e criamos kkk) o id da entity baseado no id retornado do método insert
        $movie->id = $inserted_id;

        // Retornar a entity atualizada (com id)
        return $movie;
    }
}
