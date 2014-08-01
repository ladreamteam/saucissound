<?php

namespace SaucisSound\Bundle\CommunityBundle\Entity;

use Doctrine\ORM\EntityRepository;
use SaucisSound\Bundle\CommunityBundle\Model\MemberRepositoryInterface;

/**
 * MemberRepository
 */
class MemberRepository extends EntityRepository implements MemberRepositoryInterface
{
}
