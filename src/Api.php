<?php

namespace Kolirt\ApiResponse;

class Api
{

    private $responseCode = 200;
    private $responseOk = true;

    private $description = null;
    private $errors = null;
    private $data = null;

    private $cookies = [];

    /**
     * @param int $code
     * @return $this
     */
    public function error($code = 400)
    {
        $this->setResponseOk(false);
        $this->setCode($code);

        return $this;
    }

    /**
     * @param int $code
     * @return $this
     */
    public function success($code = 200)
    {
        $this->setResponseOk(true);
        $this->setCode($code);

        return $this;
    }

    /**
     * @param $text
     * @return $this
     */
    public function setDescription($text)
    {
        $this->description = $text;

        return $this;
    }

    /**
     * @param $errors
     * @return $this
     */
    public function setErrors($errors, $errored = true)
    {
        if ($errored) {
            $this->setResponseOk(false);
            $this->setCode(422);
        }
        $this->errors = $errors;

        return $this;
    }

    /**
     * @param $code
     * @return $this
     */
    public function setCode($code)
    {
        $this->responseCode = $code;

        return $this;
    }

    /**
     * @param $data
     * @return $this
     */
    public function setData($data)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * @param $cookie
     * @return $this
     */
    public function cookie($cookie)
    {
        $this->cookies[] = $cookie;

        return $this;
    }

    /**
     * @return mixed
     */
    public function render()
    {
        $result = [
            'ok' => $this->getResponseOk(),
        ];

        if (!$this->getResponseOk())
            $result['error_code'] = $this->getResponseCode();

        if ($this->getDescription())
            $result['description'] = $this->getDescription();

        if ($this->getErrors())
            $result['errors'] = $this->getErrors();

        if ($this->getData())
            $result['result'] = $this->getData();

        $response = response()->json($result, $this->getResponseCode());

        foreach ($this->cookies as $cookie) {
            $response->withCookie($cookie);
        }

        return $response;
    }

    /**
     * @param $message
     * @param int $code
     * @return $this
     */
    public function abort($message, $code = 400)
    {
        $response = $this->error($code)->setDescription($message)->render();
        abort($response);
    }

    /**
     * @return mixed
     */
    public function __toString()
    {
        return $this->render();
    }

    private function setResponseOk($status)
    {
        $this->responseOk = $status;
    }

    private function getResponseCode()
    {
        return $this->responseCode;
    }

    private function getResponseOk()
    {
        return $this->responseOk;
    }

    private function getDescription()
    {
        return $this->description;
    }

    private function getErrors()
    {
        return $this->errors;
    }

    private function getData()
    {
        return $this->data;
    }
}
