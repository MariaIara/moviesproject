<?php

namespace App\Entities;

use App\Enums\MovieStatus;
use CodeIgniter\Entity\Entity;

class MovieEntity extends Entity
{
    protected $datamap = [];
    protected $casts   = [
        'status' => 'integer'
    ];
    protected $castHandlers = [];
}
