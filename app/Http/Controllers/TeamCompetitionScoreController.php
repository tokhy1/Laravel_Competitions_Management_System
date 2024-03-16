<?php

namespace App\Http\Controllers;

use App\Models\TeamCompetitionScore;
use App\Models\TeamEventScore;
use Exception;
use Illuminate\Http\Request;

class TeamCompetitionScoreController extends Controller
{
    public function showTeamsCompetitionScore()
    {
        try {
            $competitions_score = TeamCompetitionScore::get();
            return view('admin_dashboard.teams_competitions_score', ['competitions_score' => $competitions_score]);
        } catch (Exception $e) {
            return response('Something is wrong ' . $e->getMessage());
        }
    }

    public function addTeamCompetitionScore(Request $request)
    {
        try {
            // get count of team events score
            $totalScore = TeamEventScore::where('team_id', $request->team_id)->sum('event_score');
            TeamCompetitionScore::insert([
                'team_id' => $request->team_id,
                'competition_id' => $request->competition_id,
                'total_score' => $totalScore,
            ]);

            return redirect('/dashboard/teams-competitions-score');
        } catch (Exception $e) {
            return response('Something is wrong ' . $e->getMessage());
        }
    }

    public function deleteTeamCompetitionScore($id)
    {
        try {
            TeamCompetitionScore::findOrFail($id)->delete();
            return redirect('/dashboard/teams-competitions-score');
        } catch (Exception $e) {
            return response('Something is wrong ' . $e->getMessage());
        }
    }

    public function updateTeamCompetitionScore(Request $request, $id)
    {
        try {
            TeamCompetitionScore::findOrFail($id)->update([
                'competition_id' => $request->competition_id,
                'team_id' => $request->team_id,
                'total_score' => $request->total_score,
            ]);

            return redirect('/dashboard/teams-competitions-score');
        } catch (Exception $e) {
            return response('Something is wrong ' . $e->getMessage());
        }
    }
}
