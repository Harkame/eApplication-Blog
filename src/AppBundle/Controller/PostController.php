<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use AppBundle\Entity\Post;

class PostController extends Controller
{
    /**
     * @Route("/post/delete/{post_id}" )
     */
    public function postDeleteAction($post_id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $post = $entityManager->getRepository(Post::class)->find($post_id);

        if(!$post) {

            $this->addFlash(
                'notice',
                'Impossible de supprimer l\'article !'
            );

            return $this->render('default/about.html.twig', array());
        }

        $entityManager->remove($post);
        $entityManager->flush();

        $this->addFlash(
            'success',
            'l\'article à bien été supprimé !'
        );

        return $this->redirectToRoute('homepage', array('page' => 1));
    }

    /**
     * @Route("/post/delete/{post_id}" )
     */
    public function postEditAction($post_id)
    {
        //TODO
        return $this->redirectToRoute('homepage', array('page' => 1));
    }
}
