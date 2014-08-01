<?php

namespace SaucisSound\Bundle\CommunityBundle\Controller;

use Doctrine\Common\Persistence\ObjectManager;
use FOS\RestBundle\View\View;
use SaucisSound\Bundle\CommunityBundle\Handler\MemberHandlerInterface;
use SaucisSound\Bundle\CoreBundle\Controller\SaucisSoundController;
use Symfony\Component\HttpFoundation\Request;

/**
 * Member controller.
 * /member endpoint for the API
 */
class MemberController extends SaucisSoundController
{
    /**
     * Creates a new Member entity.
     *
     * @param Request $request
     *
     * @return View
     */
    public function postMembersAction(Request $request)
    {
        /** @var MemberHandlerInterface $handler */
        $handler = $this->get('saucis_sound_community.handler.member');
        $member  = $handler->create($request->request->all());

        /** @var ObjectManager $manager */
        $manager = $this->getDoctrine()->getManager();
        $manager->persist($member);
        $manager->flush();

        return $this->getPostView($member, 'get_member', ['id' => 1], ['user_basic']);
    }

    /**
     * Gets a Member entity.
     *
     * @param $id
     *
     * @return View
     */
    public function getMemberAction($id)
    {
        /** @var MemberHandlerInterface $handler */
        $handler = $this->get('saucis_sound_community.handler.member');
        $member  = $handler->get($id);

        return $this->getGetView($member, ['user_basic']);
    }
}
