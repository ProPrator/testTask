<?php

namespace App\Services;

interface ItemServiceInterface
{
    public function send(int $id): void;
}
