<?php

namespace App\Enums;

enum MovieStatus: int
{
    case ASSISTIR = 0;
    case ASSISTINDO = 1;
    case PROXIMO = 2;
    case ASSISTIDO = 3;
}
