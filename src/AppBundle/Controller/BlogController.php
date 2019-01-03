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
    public function homeAction($page, Request $request)
    {
        $posts_repository = $this->getDoctrine()->getRepository('AppBundle:Post');
        $posts = $posts_repository->getPosts($page, 4);

        $post = new Post();

        $form = $this->createForm(PostType::class, $post);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $user = $this->getUser();

            if (!$user)
            {
                $this->addFlash(
                    'error',
                    'Unauthorized creation'
                );

                return $this->redirectToRoute('homepage', array('page' => 1));
            }

            $validTitle = $this->getDoctrine()->getRepository('AppBundle:Post')->findBy(array('title' => $post->getTitle()));

            if($validTitle != null)
            {
                $request->getSession()
                    ->getFlashBag()
                    ->add('error', 'Title already used');

                return $this->redirectToRoute('homepage', array('page' => 1));
            }

            $post->setPublished( new \DateTime());

            $post->setAuthor($user->getUserName());

            $post->setAliasUrl($post->getTitle());

            if ($post->getImageUrl() != null)
            {
                $fileName = md5(uniqid()) . '.' . $post->getImageUrl()->guessExtension();

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

        $username = null;

        if($user != null)
            $username = $user->getUsername();

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
     * @Route("/about", name="aboutpage" )
     */
    public function aboutAction()
    {
        $user= $this->getUser();

        $username = null;

        if($user)
            $username = $user->getUsername();

        return $this->render('default/about.html.twig', array(
            'user' => $username
        ));
    }
}
