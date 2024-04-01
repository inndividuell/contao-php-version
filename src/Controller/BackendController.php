<?php

namespace Inndividuell\ContaoPhpVersion\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BackendController extends AbstractController
{
    /**
     * @Route("/contao/backend/phpinfo", name="backend_phpinfo")
     */
    public function phpinfoAction()
    {
        ob_start();
        phpinfo();
        $phpinfo = ob_get_contents();
        ob_end_clean();

        return new Response(
            '<html><body>' . $phpinfo . '</body></html>'
        );
    }
}
