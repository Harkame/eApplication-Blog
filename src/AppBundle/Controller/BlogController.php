<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use Symfony\Component\HttpFoundation\Response;

use AppBundle\Entity\Post;

class BlogController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function getAllPost()
    {
        $posts = $this->getDoctrine()->getRepository('AppBundle:Post')->findAll();


        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }

    /**
     * @Route("/post/{article}", requirements={"article"="\d+"}, defaults={"article": "42"})
     */
    public function getPost($article)
    {
        $this->createAction();

        $post = $this->getDoctrine()->getRepository('AppBundle:Post')->find($article);

        if(!$post)
            return $this->render('default/post.html.twig', array(
                'article' => 'not found'
            ));
        else
            return $this->render('default/post.html.twig', array(
                'article' => var_dump($post)
            ));
    }

    public function createAction()
    {
        $post = new Post();

        $post->setTitle('toto');
        $post->setAliasUrl('titi');
        $post->setContent('tototo');
        $post->setPublished( new \DateTime());

        $em = $this->getDoctrine()->getManager();
        $em->persist($post);
        $em->flush();

        return new Response('Id du post');
    }
}
