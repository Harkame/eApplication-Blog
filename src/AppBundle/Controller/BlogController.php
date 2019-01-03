<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;


use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Post;

use AppBundle\Form\PostType;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;

use Symfony\Component\HttpFoundation\File\Exception\FileException;


class BlogController extends Controller
{
    /**
     * @Route("")
     */
    public function indexAction()
    {
        return $this->redirectToRoute('homepage', array('page' => 1));
    }

    /**
     * @Route("/{page}", name="homepage", requirements = {"page" = "\d+"}, defaults={1} )
     */
    //
    public function homeAction($page, Request $request)
    {
        $posts_repository = $this->getDoctrine()->getRepository('AppBundle:Post');
        $posts = $posts_repository->getPosts($page, 3);

        $post = new Post();

        $post->setPublished( new \DateTime());

        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $check = $this->getDoctrine()->getRepository('AppBundle:Post')->findBy(array('title' => $post->getTitle()));

            if($check != null)
            {
                $request->getSession()
                    ->getFlashBag()
                    ->add('error', 'Title already used');

                return $this->redirectToRoute('homepage', array('page' => 1));
            }

            $user = $this->getUser();

            if ($user)
                $username = $user->getUserName();
            else
                $username = 'Anonymous';

            $post->setAuthor($username);

            $post->setAliasUrl($post->getTitle());

            if ($post->getImageUrl() != null)
            {
                $fileName = $this->generateUniqueFileName() . '.' . $post->getImageUrl()->guessExtension();

                try
                {
                    $post->getImageUrl()->move(
                        $this->container->getParameter('kernel.root_dir').'/../web/image',
                        $fileName
                    );
                }
                catch (FileException $e)
                {
                }
            }
            else
                $fileName = null;

            $post->setImageUrl($fileName);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($post);
            $entityManager->flush();

            $request->getSession()
                ->getFlashBag()
                ->add('success', 'Post created');
        }

        $user = $this->getUser();

        if($user != null)
            $username = $user->getUsername();
        else
            $username = null;

        return $this->render('default/home.html.twig',
            array(
                'posts' => $posts,
                'page' => $page,
                'form' => $form->createView(),
                'user' => $username
            )
        );
    }

    /**
     * @Route("/post/{url_alias}" )
     */
    public function postDetailsAction($url_alias)
    {

        $post = $this->getDoctrine()->getRepository('AppBundle:Post')->findBy(array('alias_url' => $url_alias))[0];

        $user = $this->getUser();

        if ($user)
            $username = $user->getUsername();
        else
            $username = null;

        if(!$post)
            return $this->render('default/post.html.twig', array(
                'post' => 'not found',
                '$user' => $username
            ));
        else
            return $this->render('default/post.html.twig', array(
                'post' => $post,
                'user' => $username
            ));
    }

    /**
     * @Route("/about" )
     */
    public function aboutAction()
    {
        $user= $this->getUser();

        if($user)
            $username = $user->getUsername();
        else
            $username = null;

        return $this->render('default/about.html.twig', array(
            'user' => $username
        ));
    }

    private function generateUniqueFileName()
    {
        return md5(uniqid());
    }
}
