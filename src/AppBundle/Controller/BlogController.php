<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use Symfony\Component\HttpFoundation\Response;

use AppBundle\Entity\Post;

class BlogController extends Controller
{
    /**
     * @Route("/post/{article}", requirements={"article"="\d+"}, defaults={"article": "42"})
     */
    public function postAction(Post $article)
    {
        $this->createAction();

        dump(article);

        return $this->render('default/post.html.twig', array(
            'article' => $article
        ));
    }

    public function createAction()
    {
        $post = Post();

        $em = $this->getDoctrine()->getManager();
        $em->persist($post);
        $em->flush();

        return new Response('Id du post');
    }
}
