<?php

declare(strict_types=1);

namespace App\Exception;

class UndefinedCategoryException extends \DomainException
{
    public function __construct(string $category)
    {
        $message = \sprintf('Undefined category "%s".', $category);

        parent::__construct($message);
    }
}
