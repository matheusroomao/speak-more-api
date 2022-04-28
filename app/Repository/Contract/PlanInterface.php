<?php 
namespace App\Repository\Contract;
use Illuminate\Http\Request;

interface PlanInterface{
    public function all(Request $request);
    public function create(Request $request);
    public function update(Request $request,$id);

    public function delete($id);
    public function findById($id);

    public function getMessage();
}