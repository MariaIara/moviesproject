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
        'status',
        'rating'
    ];

    public function firstById(int $id): ?MovieEntity
    {
        return $this
            ->where('id', $id)
            ->first();
    }

    public function firstWatched(int $id): ?MovieEntity
    {
        return $this
            ->where('id', $id)
            ->where('status', 3)
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

    public function filterList($filters): array
    {
        if (isset($filters['category'])) {
            $this->where('category', $filters['category']);
        }

        if (isset($filters['status'])) {
            $this->where('status', $filters['status']);
        }

        if (isset($filters['rating'])) {
            $this->where('rating', $filters['rating']);
        }

        if (isset($filters['q'])) {
            $this->like('name', $filters['q'])
                ->orLike('category', $filters['q']);
        }

        return $this->findAll();
    }

    public function ratingPositive(): array
    {
        return $this
            ->whereIn('rating', [3, 4, 5])
            ->findAll();
    }

    public function ratingNegative(): array
    {
        return $this
            ->whereIn('rating', [1, 2])
            ->findAll();
    }
}
