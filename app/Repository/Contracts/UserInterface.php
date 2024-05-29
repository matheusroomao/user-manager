<?php

namespace App\Repository\Contracts;
use Illuminate\Http\Request;

interface UserInterface
{
    public function all(Request $request);
    public function findById($id);
    public function create(Request $request);
    public function update(Request $request,$id);
    public function delete($id);
    public function getDetails();
}
