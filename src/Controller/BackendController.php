<?php

namespace Inndividuell\ContaoPhpVersion\Controller;

use Contao\CoreBundle\Controller\AbstractBackendController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/%contao.backend.route_prefix%/inn-php-version', name: self::class, defaults: ['_scope' => 'backend'])]
class BackendController extends AbstractBackendController
{
    public function __invoke(): Response
    {
        return $this->render(
            'inn_backend_php.html.twig',
            [
                'error' => 'Oh no, an error!',
                'title' => 'My title',
                'headline' => 'PHP version',
                'version' => 'I can overwrite what I want',
                'content' => phpinfo(),
            ]
        );
    }
}
