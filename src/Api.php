<?php

namespace Kolirt\ApiResponse;


class Api
{

    private $responseCode = 200;
    private $responseOk = true;

    private $description = null;
    private $data = null;

    private $responseCodes = [
        /* 1xx */
        100,
        101,
        102,

        /* 2xx */
        200,
        201,
        202,
        203,
        204,
        205,
        206,
        207,
        208,
        226,

        /* 3xx */
        300,
        301,
        302,
        302,
        303,
        304,
        305,
        306,
        307,
        308,

        /* 4xx */
        400,
        401,
        402,
        403,
        404,
        405,
        406,
        407,
        408,
        409,
        410,
        411,
        412,
        413,
        414,
        415,
        416,
        417,
        418,
        419,
        421,
        422,
        423,
        424,
        426,
        428,
        429,
        431,
        449,
        451,
        499,

        /* 5xx */
        500,
        501,
        502,
        503,
        504,
        505,
        506,
        507,
        508,
        509,
        510,
        511,
        520,
        521,
        522,
        523,
        524,
        525,
        526,
    ];

    public function error($code = 400)
    {
        $this->setResponseOk(false);
        $this->setCode($code);

        return $this;
    }

    public function success($code = 200)
    {
        $this->setResponseOk(true);
        $this->setCode($code);

        return $this;
    }

    public function setDescription($text)
    {
        $this->description = $text;

        return $this;
    }

    public function setCode($code)
    {
        $this->responseCode = $code;

        return $this;
    }

    public function setData($data)
    {
        $this->data = $data;

        return $this;
    }

    public function send()
    {
        $response = [
            'ok' => $this->getResponseOk(),
        ];

        if (!$this->getResponseOk())
            $response['error_code'] = $this->getResponseCode();

        if ($this->getDescription())
            $response['description'] = $this->getDescription();

        if ($this->getData())
            $response['result'] = $this->getData();

        return response()->json($response, $this->getResponseCode());
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

    private function getData()
    {
        return $this->data;
    }
}