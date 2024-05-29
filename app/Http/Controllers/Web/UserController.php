<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Service\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private const VIEW_INDEX = "user.index";
    private const VIEW_CREATE = "user.create";

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
        $models = $this->user_service->all($request);
        return response()->view(self::VIEW_INDEX, compact('models'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return response()->view(self::VIEW_CREATE);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id): RedirectResponse
    {
        $this->user_service->delete($id);
        return $this->redirection();
    }

    private function redirection(): RedirectResponse
    {
        toastr(
            $this->user_service->getDetails()->message,
            $this->user_service->getDetails()->type
        );

        return back();
    }
}
