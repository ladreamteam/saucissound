<?php

namespace SaucisSound\Bundle\CoreBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View;

/**
 * Class SaucisSoundController
 * @package SaucisSound\Bundle\CoreBundle\Controller
 */
class SaucisSoundController extends FOSRestController
{
    /**
     * Creates a new View for a post request response.
     *
     * @param mixed  $resource   the created resource
     * @param string $route      name of the route to get the resource created
     * @param array  $parameters parameters for the route
     * @param array  $groups     groups to serialize
     *
     * @return View
     */
    public function getPostView($resource, $route, array $parameters = [], array $groups = [])
    {
        // classic view for a 201
        $view = $this->routeRedirectView($route, $parameters);

        // add the resource to avoid a query
        $view->setData($resource);
        $view->getSerializationContext()->setGroups($groups);

        return $view;
    }

    /**
     * Creates a new View for a get request response.
     *
     * @param mixed $resource resource to display to the client
     * @param array $groups   groups to serialize
     *
     * @return View
     */
    public function getGetView($resource, array $groups = [])
    {
        $view = $this->view($resource, 200);
        $view->getSerializationContext()->setGroups($groups);

        return $view;
    }
} 