<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Post;

use AppBundle\Form\PostType;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;

class BlogController extends Controller
{
    /**
     * @Route("/{page}", name="homepage", requirements = {"page" = "\d+"} )
     */
    //
    public function homeAction($page, Request $request)
    {
        $nbPostsPage = 3;

        //$posts = $this->getDoctrine()->getRepository('AppBundle:Post')->findBy([], ['published' => 'DESC']);

        $nbPages = 3;//ceil(count($posts)/($nbPostsPage));

        $posts_repository = $this->getDoctrine()->getRepository('AppBundle:Post');
        $posts = $posts_repository->getPosts($page);

        $firstPost =  ($nbPostsPage * $page) - $nbPostsPage + 1;
        $lastPost =  $nbPostsPage * $page;

        $post = new Post();

        $post->setAliasUrl('titi');
        $post->setPublished( new \DateTime());

        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid())
        {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($post);
            $entityManager->flush();

            //return $this->redirectToRoute('home');
        }

        return $this->render('default/home.html.twig',
            array(
                'posts' => $posts,
                'nbPosts' => $nbPostsPage,
                'nbPages' => $nbPages,
                'page' => $page,
                'firstPost' => $firstPost,
                'lastPost' => $lastPost,
                'form' => $form->createView()
            )
        );

        /*    [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]); */
    }

    /**
     * @Route("/post/{url_alias}" )
     */
    public function postDetailsAction($url_alias)
    {
        //$this->createAction();

        $post = $this->getDoctrine()->getRepository('AppBundle:Post')->findBy(array('aliasUrl' => $url_alias));

        if(!$post)
            return $this->render('default/post.html.twig', array(
                'article' => 'not found'
            ));
        else
            return $this->render('default/post.html.twig', array(
                'post' => $post
            ));
    }

    /**
     * @Route("/about" )
     */
    public function aboutAction()
    {
        return $this->render('default/about.html.twig', array());
    }

    public function createAction()
    {
        $post = new Post();

        $post->setTitle('toto');
        $post->setAliasUrl('titi');
        $post->setContent('Text content');
        $post->setPublished( new \DateTime());

        $em = $this->getDoctrine()->getManager();
        $em->persist($post);
        $em->flush();

        return new Response('Id du post');
    }
}
