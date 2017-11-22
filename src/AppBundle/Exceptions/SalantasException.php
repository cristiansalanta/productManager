<?php
/**
 * Created by PhpStorm.
 * User: cristian.salanta
 * Date: 20/11/2017
 * Time: 12:39
 */

namespace AppBundle\Exceptions;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Throwable;

class SalantasException extends \Exception
{

    protected $request;
    protected $response;

    /**
     * Construct the error object.
     * @link http://php.net/manual/en/error.construct.php
     * @param string $message [optional] The Error message to throw.
     * @param int $code [optional] The Error code.
     * @param Throwable $previous
     * @param Request $request
     * @param Response $response
     */
    public function __construct($message, $code, $previous, $request, $response)
    {
        /**
         * ma folosesc de chestiile gata construite din parinte
         */
        parent::__construct($message, $code, $previous);
        $this->request = $request;
        $this->response = $response;
    }

    public function errorMessage(){

        $errorMsg = "Something has gone wrong on line: " . $this->code . ". ERORR:" . $this->message . $this->response . $this->request;

        return $errorMsg;
    }

    public function getRequest()
    {
        return $this->request;
    }

    public function getResponse()
    {
        return $this->response;
    }
}