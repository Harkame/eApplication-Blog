<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class BlogController extends Controller
{
    /**
     * @Route("/post/{article}", requirements={"article"="\d+"}, defaults={"article": "42"})
     */
    public function postAction($article)
    {
        dump($article);

        return $this->render('default/post.html.twig', array(
            'article' => $article
        ));
    }

}
