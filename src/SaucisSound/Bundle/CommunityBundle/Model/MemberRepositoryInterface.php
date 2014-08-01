<?php

namespace SaucisSound\Bundle\CommunityBundle\Model;

use Doctrine\Common\Collections\Selectable;
use Doctrine\Common\Persistence\ObjectRepository;

/**
 * Interface MemberRepositoryInterface
 * @package SaucisSound\Bundle\CommunityBundle\Model
 */
interface MemberRepositoryInterface extends ObjectRepository, Selectable
{

} 