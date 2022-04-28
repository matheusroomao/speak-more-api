<?php

namespace App\Repository\Business;

use App\Models\Plan;
use App\Repository\Contract\PlanInterface;

class PlanRepository extends AbstractRepository implements PlanInterface
{
    protected $model = Plan::class;
    private $message;
    private $relationships = [];

    public function __construct()
    {
        $this->model = app($this->model);
        parent::__construct($this->model, $this->message, $this->relationships);
    }

}
