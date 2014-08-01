<?php

namespace SaucisSound\Bundle\CoreBundle\Handler;

use FOS\RestBundle\Util\ExceptionWrapper;
use FOS\RestBundle\View\ExceptionWrapperHandlerInterface;

/**
 * Class SaucisSoundExceptionHandler
 * @package SaucisSound\Bundle\CoreBundle\Handler
 */
class SaucisSoundExceptionHandler implements ExceptionWrapperHandlerInterface
{
    /**
     * Format exception rendering for FOSRestBundle.
     *
     * @param array $data
     *
     * @return array
     */
    public function wrap($data)
    {
        if (is_array($data) && isset($data['exception'])) {
            /** @var \Symfony\Component\HttpKernel\Exception\FlattenException $exception */
            $exception = $data['exception'];
            $headers   = $exception->getHeaders();

            // if this is a SaucisSoundException
            // there is a change for the errors header
            // to transport some errors
            if (isset($headers['errors'])) {
                $data['errors'] = $headers['errors'];

                // remove them from the exception
                unset($headers['errors']);
                $exception->setHeaders($headers);
            }
        }

        return new ExceptionWrapper($data);
    }
}