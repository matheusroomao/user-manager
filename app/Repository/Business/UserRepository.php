<?php

namespace App\Repository\Business;
use App\Models\User;
use App\Repository\Contracts\UserInterface;

class UserRepository extends AbstractRepository implements UserInterface
{
    protected $model = User::class;

    public function __construct()
    {
        $this->model = app($this->model);
        parent::__construct($this->model);
    }

}
