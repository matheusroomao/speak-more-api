<?php

namespace App\Repository\Business;

use App\Models\Code;
use App\Repository\Contract\CodeInterface;

class CodeRepository extends AbstractRepository implements CodeInterface
{
    protected $model = Code::class;
    private $message;
    private $relationships = [];

    public function __construct()
    {
        $this->model = app($this->model);
        parent::__construct($this->model, $this->message, $this->relationships);
    }

}
