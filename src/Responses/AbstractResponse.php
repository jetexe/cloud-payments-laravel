<?php

namespace AvtoDev\CloudPayments\Responses;

abstract class AbstractResponse implements ResponseInterface
{
    /**
     * @var bool
     */
    protected $success;

    /**
     * @var string|null
     */
    protected $message;

    /**
     * @return bool
     */
    public function isSuccess(): bool
    {
        return $this->success ?? false;
    }

    /**
     * @param bool $success
     *
     * @return $this
     */
    public function setSuccess(bool $success): self
    {
        $this->success = $success;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getMessage(): ?string
    {
        return $this->message;
    }

    /**
     * @param string|null $message
     *
     * @return $this
     */
    public function setMessage(?string $message): self
    {
        $this->message = $message;

        return $this;
    }
}
