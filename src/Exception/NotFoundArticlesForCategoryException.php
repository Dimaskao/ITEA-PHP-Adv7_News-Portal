<?php

declare(strict_types=1);

namespace App\Exception;

class NotFoundArticlesForCategoryException extends \UnderflowException
{
    public function __construct(string $category)
    {
        $message = \sprintf('Articles for category "%s" not found.', $category);

        parent::__construct($message);
    }
}
