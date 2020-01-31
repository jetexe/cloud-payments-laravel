<?php

declare(strict_types = 1);

namespace AvtoDev\CloudPayments\Responses\Traits;

trait HasModel
{
    /**
     * @var array|null
     */
    protected $model_fields;

    /**
     * @return array|null
     */
    public function getModel(): ?array
    {
        return $this->model_fields;
    }

    /**
     * @param array|null $model_fields
     *
     * @return $this
     */
    public function setModel(?array $model_fields): self
    {
        $this->model_fields = $model_fields;

        return $this;
    }
}
