<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\StoreUserRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\View\View;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $users = User::all();
        return View('user.list', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        return view('user.sign-up');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreUserRequest  $request
     * @return Response
     */
    public function store(StoreUserRequest $request)
    {

        $validated = $request->validated();

        $response = Http::spikkl()->get(
                '&postal_code='.$validated['postal_code'].
                '&street_number='.$validated['house_number']
        );

        // Unable to get the correct response
//        if($response) return

        $user = new User($validated);
//        Iloveyou10!

        $user->save();
    }
}
