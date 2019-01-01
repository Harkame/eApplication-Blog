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
     * @Route("")
     */
    public function indexAction()
    {
        $page = 1;
        return $this->redirectToRoute('homepage', array('page' => $page));
    }


    /**
     * @Route("/{page}", name="homepage", requirements = {"page" = "\d+"}, defaults={1} )
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

        $post->setPublished( new \DateTime());

        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid())
        {

            $post->setAliasUrl($post->getTitle());
            if($post->getImageUrl() === null || $post->getImageUrl() === '')
                $post->setImageUrl('default_image.jpg');

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
        $post = $this->getDoctrine()->getRepository('AppBundle:Post')->findBy(array('alias_url' => $url_alias));

        if(!$post)
            return $this->render('default/post.html.twig', array(
                'post' => 'not found'
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
}
