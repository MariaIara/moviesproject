<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Entities\MovieEntity;
use App\Services\MovieService;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Services;

class MovieController extends BaseController
{
    // Define atributo $movieService
    protected MovieService $movieService;

    public function __construct()
    {
        // Atribui a instância do MovieService no atributo $movieService
        $this->movieService = Services::movie();
    }

    public function index()
    {
        // Retornar todos os filminhos cadastrados
        $movies = $this->movieService->list();

        // Retornar resposta
        return $this->response
            ->setJSON($movies) // NÃO ENCUCAR COM O JSON :)
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

    public function update()
    {
        //
    }

    public function delete()
    {
        //
    }
}
