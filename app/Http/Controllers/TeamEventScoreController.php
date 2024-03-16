<?php

namespace App\Http\Controllers;

use App\Models\TeamCompetitionScore;
use App\Models\TeamEventScore;
use Exception;
use Illuminate\Http\Request;

class TeamEventScoreController extends Controller
{
    public function showTeamsEventScore()
    {
        try {
            $events_score = TeamEventScore::get();
            return view('admin_dashboard.teams_events_score', ['events_score' => $events_score]);
        } catch (Exception $e) {
            return response('Something is wrong ' . $e->getMessage());
        }
    }

    public function addTeamEventScore(Request $request)
    {
        try {
            TeamEventScore::insert([
                'team_id' => $request->team_id,
                'event_id' => $request->event_id,
                'event_score' => $request->event_score,
            ]);

            $totalScore = TeamEventScore::where('team_id', $request->team_id)->sum('event_score');
            TeamCompetitionScore::where('team_id', $request->team_id)->update([
                'total_score' => $totalScore
            ]);

            return redirect('/dashboard/teams-events-score');
        } catch (Exception $e) {
            return response('Something is wrong ' . $e->getMessage());
        }
    }

    public function deleteTeamEventScore($id)
    {
        try {
            TeamEventScore::findOrFail($id)->delete();
            return redirect('/dashboard/teams-events-score');
        } catch (Exception $e) {
            return response('Something is wrong ' . $e->getMessage());
        }
    }

    public function updateTeamEventScore(Request $request, $id)
    {
        try {
            TeamEventScore::findOrFail($id)->update([
                'event_id' => $request->event_id,
                'event_score' => $request->event_score,
            ]);

            return redirect('/dashboard/teams-events-score');
        } catch (Exception $e) {
            return response('Something is wrong ' . $e->getMessage());
        }
    }

}
