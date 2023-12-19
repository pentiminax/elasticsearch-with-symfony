<?php

namespace App\Form\Model;

use App\Entity\Category;

class SearchModel
{
    public function __construct(
        public ?string $query = null,
        public ?Category $category = null,
        public bool $createdThisMonth = false
    ) {
    }
}