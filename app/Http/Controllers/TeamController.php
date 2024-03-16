<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Exception;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function showTeams()
    {
        try {
            $teams = Team::get();
            return view('admin_dashboard.teams', ['teams' => $teams]);
        } catch (Exception $e) {
            return response('Something is wrong ' . $e->getMessage());
        }
    }

    public function addTeam(Request $request)
    {
        try {
            Team::insert([
                'team_name' => $request->team_name,
                'team_leader_id' => $request->team_leader_id,
                'competition_id' => $request->competition_id,
            ]);

            return redirect('/dashboard/teams');
        } catch (Exception $e) {
            return response('Something is wrong ' . $e->getMessage());
        }
    }

    public function deleteTeam($id)
    {
        try {
            Team::findOrFail($id)->delete();
            return redirect('/dashboard/teams');
        } catch (Exception $e) {
            return response('Something is wrong ' . $e->getMessage());
        }
    }

    public function updateTeam(Request $request, $id)
    {
        try {
            Team::findOrFail($id)->update([
                'team_name' => $request->team_name,
                'competition_id' => $request->competition_id,
            ]);

            return redirect('/dashboard/teams');
        } catch (Exception $e) {
            return response('Something is wrong ' . $e->getMessage());
        }
    }
}
