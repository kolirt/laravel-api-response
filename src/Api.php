<?php

namespace Kolirt\ApiResponse;

class Api
{

    private int $responseCode = 200;
    private bool $responseOk = true;

    private string|array|null $description = null;
    private array|null $errors = null;
    private mixed $data = null;

    private array $cookies = [];

    /**
     * @param int $code
     * @return $this
     */
    public function error(int $code = 400): self
    {
        $this->setResponseOk(false);
        $this->setCode($code);

        return $this;
    }

    /**
     * @param int $code
     * @return $this
     */
    public function success(int $code = 200): self
    {
        $this->setResponseOk(true);
        $this->setCode($code);

        return $this;
    }

    /**
     * @param string|array $text
     * @return $this
     */
    public function setDescription(string|array $text): self
    {
        $this->description = $text;

        return $this;
    }

    /**
     * @param array $errors
     * @return $this
     */
    public function setErrors(array $errors): self
    {
        $this->errors = $errors;

        return $this;
    }

    /**
     * @param int $code
     * @return $this
     */
    public function setCode(int $code): self
    {
        $this->responseCode = $code;

        return $this;
    }

    /**
     * @param mixed $data
     * @return $this
     */
    public function setData(mixed $data): self
    {
        $this->data = $data;

        return $this;
    }

    /**
     * @param $cookie
     * @return $this
     */
    public function cookie($cookie): self
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
     * @param string|array $message
     * @param int $code
     */
    public function abort(string|array $message, int $code = 400): void
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

    private function setResponseOk(bool $status): void
    {
        $this->responseOk = $status;
    }

    private function getResponseCode(): int
    {
        return $this->responseCode;
    }

    private function getResponseOk(): bool
    {
        return $this->responseOk;
    }

    private function getDescription(): array|string|null
    {
        return $this->description;
    }

    private function getErrors(): ?array
    {
        return $this->errors;
    }

    private function getData()
    {
        return $this->data;
    }
}
