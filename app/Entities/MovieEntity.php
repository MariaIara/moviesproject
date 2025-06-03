<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class MovieEntity extends Entity
{
    protected $datamap = [];
    protected $casts   = [
        'status' => 'integer'
    ];
    protected $castHandlers = [];
}
