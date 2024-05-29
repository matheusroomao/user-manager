<?php

namespace App\Service;

use App\Repository\Contracts\UserInterface;
use Illuminate\Http\Request;

class UserService
{
    private UserInterface $userRepository;

    public function __construct(UserInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function all(Request $request)
    {
        return $this->userRepository->all($request);
    }

    public function findById($id)
    {
        return $this->userRepository->findById($id);
    }

    public function create(Request $request)
    {
        return $this->userRepository->create($request);
    }

    public function update(Request $request, $id)
    {
        return $this->userRepository->update($request, $id);
    }

    public function delete($id)
    {
        return $this->userRepository->delete($id);
    }

    public function getDetails(): \stdClass
    {
        return $this->userRepository->getDetails();
    }
}

