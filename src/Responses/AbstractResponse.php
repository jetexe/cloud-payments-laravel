<?php

namespace AvtoDev\CloudPayments\Responses;

abstract class AbstractResponse
{
    /**
     * @var array
     */
    protected $model_fields = [];

    /**
     * @var bool
     */
    protected $success;

    /**
     * @var string
     */
    protected $message;

    /**
     * @return bool
     */
    public function isSuccess(): bool
    {
        return $this->success;
    }

    /**
     * @param bool $success
     *
     * @return AbstractResponse
     */
    public function setSuccess(bool $success): AbstractResponse
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
     * @param string $message
     *
     * @return AbstractResponse
     */
    public function setMessage(string $message): AbstractResponse
    {
        $this->message = $message;

        return $this;
    }

    /**
     * @return array
     */
    public function getModel(): array
    {
        return $this->model_fields;
    }

    /**
     * @param array $model_fields
     *
     * @return AbstractResponse
     */
    public function setModel(array $model_fields): AbstractResponse
    {
        $this->model_fields = $model_fields;

        return $this;
    }
}
