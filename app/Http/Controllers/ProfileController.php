<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $listProfessor = User::where('role', User::ROLE_PROFESSOR)->get();
        return view('profile.edit', [
            'user' => $request->user(),
            'listProfessor' => $listProfessor,
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);
    
        $user = $request->user();
    
        // Inativa a conta em vez de deletar
        $user->update(['active' => false]); // Supondo que você tenha um campo `active` no banco
    
        Auth::logout();
    
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    
        return Redirect::to('/')->with('status', 'account-inactivated');
    }

    public function updateProfessor(Request $request): RedirectResponse
    {
        $request->validateWithBag('professorUpdate', [
            'professor' => 'required|exists:users,id',
        ]);
    
        $user = $request->user();
        $user->update(['professor_id' => $request->input('professor')]);
    
        return back()->with('status', 'professor-updated');
    }
    
    
}
