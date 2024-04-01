<?php

namespace Inndividuell\ContaoPhpVersion\EventListener;

use Inndividuell\ContaoPhpVersion\Controller\BackendController;
use Contao\CoreBundle\Event\ContaoCoreEvents;
use Contao\CoreBundle\Event\MenuEvent;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;
use Symfony\Component\Routing\RouterInterface;

#[AsEventListener(ContaoCoreEvents::BACKEND_MENU_BUILD, priority: -255)]
class BackendMenuListener
{
    protected $router;
    protected $requestStack;

    public function __construct(RouterInterface $router, RequestStack $requestStack)
    {
        $this->router = $router;
        $this->requestStack = $requestStack;
    }

    public function __invoke(MenuEvent $event): void
    {
        $factory = $event->getFactory();
        $tree = $event->getTree();

        if ('mainMenu' !== $tree->getName()) {
            return;
        }

        $contentNode = $tree->getChild('content');

        $node = $factory
            ->createItem('inn-contao-php-version')
            ->setUri($this->router->generate(BackendController::class))
            ->setLabel('PHP Version Info')
            ->setLinkAttribute('title', 'Title')
            ->setLinkAttribute('class', 'inn-contao-php-version')
            ->setCurrent($this->requestStack->getCurrentRequest()->get('_controller') === BackendController::class)
        ;

        $contentNode->addChild($node);
    }
}
