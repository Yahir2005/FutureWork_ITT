<?php

/**
 * Generic response class.
 *
 * @template T of class
 */
class RespuestaGenerica
{
    /**
     * @var string Status of the response
     */
    public $status;

    /**
     * @var T|null Body of the response, expected to be a class type
     */
    public $body;

    /**
     * @var string Message of the response
     */
    public $message;

    /**
     * Constructor to initialize the properties.
     *
     * @param string $status
     * @param T|null $body
     * @param string $message
     */
    public function __construct(string $status = '', $body = null, string $message = '')
    {
        $this->status = $status;
        $this->body = $body;
        $this->message = $message;
    }
}