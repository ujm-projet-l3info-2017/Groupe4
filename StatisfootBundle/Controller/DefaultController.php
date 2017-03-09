<?php

namespace Projet\StatisfootBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('ProjetStatisfootBundle:Default:index.html.twig');
    }
}
