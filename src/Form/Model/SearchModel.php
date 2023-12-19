<?php

namespace App\Form\Model;

class SearchModel
{
    public function __construct(
        public ?string $query = null,
        public bool $createdThisMonth = false
    ) {
    }
}