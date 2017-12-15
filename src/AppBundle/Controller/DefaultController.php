<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Follow;
use AppBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $me = $this->getAuthedUser();

        $follows = $em->getRepository("AppBundle:Follow")->findBy(["follower" => $me]);
        $followeds = [];
        foreach ($follows as $follow) {
            $followeds[] = $follow->getFollowed();
        }

        $followables = $em->getRepository("AppBundle:User")->findAll();

        return $this->render("@App/index.html.twig", [
            "me" => $me,
            "followeds" => $followeds,
            "followables" => $followables,
        ]);
    }

    /**
     * @Route("/follow/{user}", name="follow")
     */
    public function followAction(Request $request, User $user)
    {
        $em = $this->getDoctrine()->getManager();

        $me = $this->getAuthedUser();

        $follow = (new Follow())
            ->setFollower($me)
            ->setFollowed($user)
        ;

        $em->persist($follow);
        $em->flush();

        return new RedirectResponse($this->generateUrl('homepage'));
    }

    /**
     * @Route("/profile/{user}", name="profile")
     */
    public function profileAction(Request $request, User $user)
    {
        $em = $this->getDoctrine()->getManager();

        $me = $this->getAuthedUser();

        $books = $em->getRepository("AppBundle:Book")->findBy(["owner" => $user]);

        return $this->render("@App/profile.html.twig", [
            "me" => $me,
            "user" => $user,
            "books" => $books,
        ]);
    }

    private function getAuthedUser()
    {
        $em = $this->getDoctrine()->getManager();
        return $em->getRepository("AppBundle:User")->find(1);
    }
}
