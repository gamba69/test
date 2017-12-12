<?php
/**
 * User: idulevich
 */

namespace TestTaskBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class TestTaskController
 * @package TestTaskBundle\Controller
 */
class TestTaskController extends Controller
{
    public function indexAction(Request $request)
    {
        return $this->render('@TestTask/index.html.twig');
    }
}