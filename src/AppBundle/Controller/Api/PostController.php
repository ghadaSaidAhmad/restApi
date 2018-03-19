<?php

namespace AppBundle\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Service\Validate;
use Symfony\Component\HttpFoundation\JsonResponse;


class PostController extends Controller
{
    /**
     * @Route("/api/posts/{id}", name="show_post")
     * @Method({"GET"})
     */
    public function showPost($id)
    {
        //get post
        $post=$this->getDoctrine()->getRepository( 'AppBundle:Post' )->find($id);
        if(empty($post))
        {
            $response=array(
                'code'=>1,
                'message'=>'post not found',
                'error'=>null,
                'result'=>null
            );
           return new JsonResponse($response,Response::HTTP_NOT_FOUND);
        }
        $data=$this->get('jms_serializer')->serialize($post,'json');
        $response=array(
            'code'=>0,
            'message'=>'success',
            'error'=>null,
            'result'=>json_decode($data)
        );
        return new JsonResponse($response,200);
    }
 
}
