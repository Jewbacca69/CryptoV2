<?php
declare(strict_types=1);

namespace App\Controllers;

use Twig\Loader\FilesystemLoader;
use Twig\Environment;

class BaseController
{
    protected Environment $twig;

    public function __construct()
    {
        $loader = new FilesystemLoader($_SERVER["DOCUMENT_ROOT"] . "/../app/Views");
        $this->twig = new Environment($loader);
    }

    protected function render(string $template, array $data = []): string
    {
        return $this->twig->render($template, $data);
    }
}