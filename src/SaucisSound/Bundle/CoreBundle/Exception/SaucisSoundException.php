<?php

namespace SaucisSound\Bundle\CoreBundle\Exception;

use Symfony\Component\Form\FormError;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Validator\ConstraintViolation;

/**
 * Class SaucisSoundException
 * @package SaucisSound\Bundle\CoreBundle\Exception
 */
class SaucisSoundException extends HttpException
{
    /**
     * @param HttpException $exception reference HttpException
     * @param mixed         $data      some data to process
     */
    public function __construct(HttpException $exception, $data = null)
    {
        $data = $this->handleData($data);

        parent::__construct(
              $exception->getStatusCode(),
                  $exception->getMessage(),
                  $exception->getPrevious(),
                  array_merge($exception->getHeaders(), $data),
                  $exception->getCode()
        );

        // use the headers to transport some data
        // because Symfony2 FlattenException excludes
        // everything except data in HttpException
    }

    /**
     * Processes the $data var to extract something
     * useful to send back to the client.
     *
     * @param mixed $data some data to process
     *
     * @return array
     */
    private function handleData($data)
    {
        if ($data instanceof FormInterface) {
            return ['errors' => $this->getErrors($data)];
        }

        return [];
    }

    /**
     * Gets all errors from a form.
     *
     * @param FormInterface $form
     *
     * @return array
     */
    private function getErrors(FormInterface $form)
    {
        $errors = [];
        foreach ($form->getErrors(true, true) as $formError) {
            /** @var FormError $formError */

            $error = [
                'message_template'      => $formError->getMessageTemplate(),
                'message_pluralization' => $formError->getMessagePluralization(),
                'message_parameters'    => $formError->getMessageParameters(),
                'message'               => $formError->getMessage()
            ];

            $cause = $formError->getCause();
            if ($cause instanceof ConstraintViolation) {
                $error = array_merge(
                    $error,
                    [
                        'property' => $cause->getPropertyPath(),
                        'value'    => $cause->getInvalidValue()
                    ]
                );
            }

            $errors[] = $error;
        }

        return $errors;
    }
} 