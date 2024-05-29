<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\UserRequest;
use App\Service\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private UserService $user_service;

    public function __construct(UserService $user_service)
    {
        $this->user_service = $user_service;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return response()->json($this->user_service->all($request), $this->user_service->getDetails()->status);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        return response()->json(
            [
                'data' => $this->user_service->create($request),
                'message' => $this->user_service->getDetails()->message
            ],
            $this->user_service->getDetails()->status
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return response()->json(
            [
                'data' => $this->user_service->findById($id),
                'message' => $this->user_service->getDetails()->message
            ],
            $this->user_service->getDetails()->status
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, string $id)
    {
        return response()->json(
            [
                'data' => $this->user_service->update($request, $id),
                'message' => $this->user_service->getDetails()->message
            ],
            $this->user_service->getDetails()->status
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->user_service->delete($id);
        return response()->json(
            [
                'message' => $this->user_service->getDetails()->message
            ],
            $this->user_service->getDetails()->status
        );
    }
}
