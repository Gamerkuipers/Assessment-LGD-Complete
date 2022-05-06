<?php

namespace App\Http\Controllers;

use App\Models\Spikkl_data;
use App\Models\User;
use App\Http\Requests\StoreUserRequest;
use Illuminate\Http\RedirectResponse;
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
        return view('user.list', ['users' => $users]);
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
     * @return RedirectResponse
     */
    public function store(StoreUserRequest $request): RedirectResponse
    {

        $validated = $request->validated();

        $user = new User($validated);

        $user->setPassword($validated['password']);

        $spikkl_response = $request->get('spikkl_data');
        $spikkl_data = new Spikkl_data();

        $spikkl_data->street_name = $spikkl_response['street_name'];
        $spikkl_data->city = $spikkl_response['city'];
        $spikkl_data->country = $spikkl_response['country']['name'];
        $spikkl_data->setCoordinates(
            $spikkl_response['centroid']['latitude'],
            $spikkl_response['centroid']['longitude']
        );

        $user->save();
        $user->spikkl_data()->save($spikkl_data);

        return redirect()->route('user.list');
    }
}
