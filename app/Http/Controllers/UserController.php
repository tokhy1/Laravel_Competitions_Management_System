<?php

namespace App\Http\Controllers;

use App\Models\Competition;
use App\Models\Individual;
use App\Models\IndividualCompetitionScore;
use App\Models\Team;
use App\Models\TeamCompetitionScore;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function showHome()
    {
        // check if the user participated as team or individual
        if (Auth::check()) {
            try {
                $competition_ids = [];

                // Fetch individuals and teams associated with the user
                $individuals = Individual::where('user_id', Auth::user()->id)->get();
                $teams = Team::where('team_leader_id', Auth::user()->id)->get();

                if ($teams) {
                    // Fetch competition IDs associated with teams
                    foreach ($teams as $team) {
                        $competition_ids = array_merge($competition_ids, TeamCompetitionScore::where('team_id', $team->id)->pluck('competition_id')->toArray());
                    }
                }

                if ($individuals) {
                    // Fetch competition IDs associated with individuals
                    foreach ($individuals as $individual) {
                        $competition_ids = array_merge($competition_ids, IndividualCompetitionScore::where('individual_id', $individual->id)->pluck('competition_id')->toArray());
                    }
                }

                if ($competition_ids) {
                    // Retrieve competitions based on collected IDs
                    $competitions = Competition::whereIn('id', $competition_ids)->get(['id', 'competition_name', 'description']);
                }

                if (empty($competitions)) {
                    return view('home.home_page', ['competitions' => []]);
                } else {
                    return view('home.home_page', ['competitions' => $competitions]);
                }
            } catch (Exception $e) {
                return response('Something is wrong ' . $e->getMessage());
            }
        }

        return view('home.home_page', ['competitions' => []]);
    }

    public function showUsers()
    {
        try {
            $users = User::where('role', 'normal')->get();
            return view('admin_dashboard.users', ['users' => $users]);
        } catch (Exception $e) {
            return response('Something is wrong ' . $e->getMessage());
        }
    }

    public function addUser(Request $request)
    {
        try {
            User::insert([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            return redirect('/dashboard/users');
        } catch (Exception $e) {
            return response('Something is wrong ' . $e->getMessage());
        }
    }

    public function deleteUser($id)
    {
        try {
            User::findOrFail($id)->delete();
            return redirect('/dashboard/users');
        } catch (Exception $e) {
            return response('Something is wrong ' . $e->getMessage());
        }
    }

    public function updateUser(Request $request, $id)
    {
        try {
            User::findOrFail($id)->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);

            return redirect('/dashboard/users');
        } catch (Exception $e) {
            return response('Something is wrong ' . $e->getMessage());
        }
    }
}
