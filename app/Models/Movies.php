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

    public function create(MovieEntity $movie): MovieEntity
    {
        $inserted_id = $this->insert($movie);

        $movie->id = $inserted_id;

        return $movie;
    }
}
