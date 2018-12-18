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
    public function indexAction()
    {
        $nbPosts = 10;




            $posts = $this->getDoctrine()->getRepository('AppBundle:Post')->findBy([], ['published' => 'DESC']);



        return $this->render('default/index.html.twig', array('posts' => $posts,
            'nbPosts' => $nbPosts));

        /*    [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]); */
    }

    /**
     * @Route("/post/{url_alias}" )
     */
    public function PostAction(string $url_alias)
    {
        $this->createAction();

        $post = $this->getDoctrine()->getRepository('AppBundle:Post')->findBy(array('aliasUrl' => $url_alias));

        if(!$post)
            return $this->render('default/post.html.twig', array(
                'article' => 'not found'
            ));
        else
            return $this->render('default/post.html.twig', array(
                'article' => $post
            ));
    }






    public function createAction()
    {
        $post = new Post();

        $post->setTitle('toto');
        $post->setAliasUrl('titi');
        $post->setContent('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas mauris lacus, ornare et massa a, posuere molestie dui. Curabitur sollicitudin, ex nec sollicitudin pretium, massa tellus vehicula velit, et vehicula sem orci nec felis. Curabitur ac vehicula justo, et pharetra mi. Suspendisse venenatis purus at leo egestas, a suscipit nisi aliquet. In laoreet nunc eget lectus aliquam, in mattis justo viverra. Pellentesque porta aliquet massa et finibus. Curabitur aliquam mauris vel neque maximus, at pretium enim commodo. Donec imperdiet lacinia ultrices. Fusce elementum at ante id laoreet. Nulla non nisl at elit porttitor mattis vel eu nisi. Fusce id congue quam. Morbi vitae interdum risus, dignissim tincidunt tortor. Etiam ex quam, condimentum vel lectus sit amet, interdum accumsan neque. Aenean at congue lacus, id commodo tortor.

Ut quis odio lacus. Maecenas eget nulla a arcu feugiat porttitor a nec nulla. Proin luctus varius dui ut eleifend. Sed tincidunt elementum bibendum. Sed semper nunc eget massa elementum molestie. Phasellus posuere vulputate dui, a consectetur ante egestas ut. Sed euismod lacus bibendum elit tempor, a imperdiet nisl egestas. Etiam dignissim posuere tristique. Nulla sed sagittis felis, vitae maximus felis. Praesent pellentesque urna vel ex luctus laoreet. Nulla nulla elit, gravida sit amet consequat id, tincidunt in felis. Ut condimentum tellus enim, sed laoreet est pretium eu.');
        $post->setPublished( new \DateTime());

        $em = $this->getDoctrine()->getManager();
        $em->persist($post);
        $em->flush();

        return new Response('Id du post');
    }
}
