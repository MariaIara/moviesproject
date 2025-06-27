<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Entities\MovieEntity;
use App\Enums\MovieStatus;
use App\Models\Movies;
use App\Services\MovieService;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Services;

class MovieController extends BaseController
{
    // Define atributo $movieService
    protected MovieService $movieService;
    protected Movies $moviesModel;

    public function __construct()
    {
        // Atribui a instância do MovieService no atributo $movieService
        $this->movieService = Services::movie();
        $this->moviesModel = model(Movies::class);
    }

    public function index()
    {
        $filters = $this->request->getGet();

        $movies = $this->moviesModel->filterList($filters);

        // Retornar resposta
        return $this->response
            ->setJSON($movies) // NÃO ENCUCAR COM O JSON :)
            ->setStatusCode(200);
    }

    public function show(int $id)
    {
        if (! $movie = $this->moviesModel->firstById($id)) {
            return $this->response
                ->setJSON([
                    'message' => 'Filme não encontrado!'
                ])
                ->setStatusCode(404);
        }

        return $this->response
            ->setJSON($movie)
            ->setStatusCode(200);
    }

    public function create()
    {
        // Pegar dados da requisição (array)
        $data = $this->request->getJSON(true) ?? [];

        // Validar dados da requisição
        if (!$this->validate('movie_create', $data)) {
            return $this->response
                ->setJSON($this->validator->getErrors())
                ->setStatusCode(422);
        }

        // Criar a entidade
        $movie = new MovieEntity([
            'name' => $data['name'],
            'category' => $data['category'],
            'status' => $data['status']
        ]);

        // Chamar service
        $new_movie = $this->movieService->new($movie);

        // Retornar mensagem
        return $this->response
            ->setJSON([
                'message' => 'Filme adicionado com sucesso',
                'movie' => $new_movie
            ])
            ->setStatusCode(201);
    }

    public function update(int $id)
    {
        $data = $this->request->getJSON(true) ?? [];

        if (!$this->validate('movie_update', $data)) {
            return $this->response
                ->setJSON($this->validator->getErrors())
                ->setStatusCode(422);
        }

        if (! $movie = $this->moviesModel->firstById($id)) {
            return $this->response
                ->setJSON([
                    'message' => 'Filme não encontrado!'
                ])
                ->setStatusCode(404);
        }

        $movie->fill($data);

        $this->movieService->update($movie);
        return $this->response
            ->setJSON([
                'message' => 'Filme atualizado!',
                'movie' => $movie
            ])
            ->setStatusCode(200);
    }

    public function delete(int $id)
    {
        if (! $movie = $this->moviesModel->firstById($id)) {
            return $this->response
                ->setJSON([
                    'message' => 'Filme não encontrado!'
                ])
                ->setStatusCode(404);
        }

        $this->movieService->destroy($movie->id);

        return $this->response
            ->setJSON([
                'message' => 'Filme excluído com sucesso'
            ])
            ->setStatusCode(200);
    }
}
