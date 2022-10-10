<?php

namespace App\Http\Controllers;

use App\Models\Beneficiary;
use App\Models\Role;
use App\Models\Status;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

use function PHPUnit\Framework\returnSelf;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $beneficiaries = Beneficiary::orderBy('name', 'ASC')->get();
        $roles = Role::orderBy('name', 'ASC')->get();
        $statuses = Status::orderBy('name', 'ASC')->get();
        $users = User::paginate('10');
        $data = [];
        foreach ($users as $user) {
            $beneficiary = Beneficiary::find($user->beneficiary_id);
            $status = Status::find($user->status_id);
            $stringRoles = "";
            foreach ($roles as $role) {
                foreach ($role->users as $value) {
                    if ($user->id == $value->id) {
                        $stringRoles .= $role->name . " / ";
                    }
                }
            }
            array_push($data, [
                'id' => $user->id,
                'name' => $beneficiary->name,
                'lastname' => $beneficiary->lastname,
                'firstname' => $beneficiary->firstname,
                'email' => $user->email,
                'status' => $status->name,
                'roles' => $stringRoles
            ]);
        }
        return view('ui.user.all', [
            'data' => $data,
            'users' => $users,
            'roles' => $roles,
            'beneficiaries' => $beneficiaries,
            'statuses' => $statuses
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($user = User::create([
            'email' => $request->email,
            'beneficiary_id' => $request->beneficiary,
            'password' => Hash::make('saSalemFin'),
            'status_id' => $request->status,
        ])) {
            $user->roles()->attach($request->roles);
            return redirect()->back()->with('success', 'Compte créé');
        }
        return redirect()->back()->with('fail', 'Une erreur est survenue lors de l\'enregistrement');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, User $user)
    {
        $beneficiaries = Beneficiary::orderBy('name', 'ASC')->get();
        $roles = Role::orderBy('name', 'ASC')->get();
        $statuses = Status::orderBy('name', 'ASC')->get();
        $user = User::find($request->id);
        return view('ui.user.show', [
            'user' => $user,
            'roles' => $roles,
            'beneficiaries' => $beneficiaries,
            'statuses' => $statuses
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $user = User::find($request->id);
        if ($user->update([
            'email' => $request->email,
            'beneficiary_id' => $request->beneficiary,
            'status_id' => $request->status,
        ])) {
            $user->roles()->sync($request->roles);
            return redirect()->route('users')->with('success', 'Compte modifié');
        }
        return redirect()->route('users')->with('fail', 'Une erreur est survenue lors de la modification');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function updateProfile(Request $request, User $user)
    {
        $user = User::find($request->id);
        if ($user->update([
            'email' => $request->email,
            'beneficiary_id' => $request->beneficiary,
            'status_id' => $request->status,
        ])) {
            $user->roles()->sync($request->roles);
            return redirect()->back()->with('success', 'Compte modifié');
        }
        return redirect()->back()->with('fail', 'Une erreur est survenue lors de la modification');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, User $user)
    {
        $user = User::find($request->id);
        if ($user->delete()) { {
                return redirect()->route('users')->with('success', 'Elément supprimé');
            }
            return redirect()->route('users')->with('fail', 'Une erreur est survenue lors de la suppression');
        }
    }

    public function resetPassword(Request $request)
    {
        $user = User::find($request->id);
        if ($user->update([
            'password' => Hash::make('saSalemFin'),
        ])) { {
                return redirect()->back()->with('success', 'Mot de passe réinitialiser');
            }
            return redirect()->back()->with('fail', 'Une erreur est survenue lors de la réinitialisation');
        }
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'password' => 'required|confirmed'
        ]);

        $user = User::find($request->id);
        if ($user->update([
            'password' => Hash::make($request->password),
        ])) { {
                return redirect()->back()->with('success', 'Mot de passe modifié');
            }
            return redirect()->back()->with('fail', 'Une erreur est survenue lors de la modification');
        }
    }

    public function showProfile()
    {
        $user = Auth::user();
        return view('ui.profile.profile', ['user' => $user]);
    }
}
