<?php

namespace App\Exceptions;

use Exception;
use ApiReturn;

class AccountException extends Exception
{
    /**
     * 去通知一些人
     *
     * @return void
     */
    public function report()
    {
        //
    }

    /**
     * Render the exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function render($request)
    {
        return ApiReturn::fail()->setError($this->getMessage())->response();
    }
}