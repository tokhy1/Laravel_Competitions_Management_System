<?php

namespace App\Http\Controllers;

use App\Models\IndividualCompetitionScore;
use App\Models\IndividualEventScore;
use Exception;
use Illuminate\Http\Request;

class IndividualCompetitionScoreController extends Controller
{
    public function showIndividualsCompetitionScore()
    {
        try {
            $competitions_score = IndividualCompetitionScore::get();
            return view('admin_dashboard.individuals_competitions_score', ['competitions_score' => $competitions_score]);
        } catch (Exception $e) {
            return response('Something is wrong ' . $e->getMessage());
        }
    }

    public function addIndividualEventScore(Request $request)
    {
        try {
            // get count of team events score
            $totalScore = IndividualEventScore::where('individual_id', $request->individual_id)->sum('event_score');
            IndividualCompetitionScore::insert([
                'individual_id' => $request->team_id,
                'competition_id' => $request->competition_id,
                'total_score' => $totalScore,
            ]);

            return redirect('/dashboard/individuals-competitions-score');
        } catch (Exception $e) {
            return response('Something is wrong ' . $e->getMessage());
        }
    }

    public function deleteIndividualCompetitionScore($id)
    {
        try {
            IndividualCompetitionScore::findOrFail($id)->delete();
            return redirect('/dashboard/individuals-competitions-score');
        } catch (Exception $e) {
            return response('Something is wrong ' . $e->getMessage());
        }
    }

    public function updateIndividualCompetitionScore(Request $request, $id)
    {
        try {
            IndividualCompetitionScore::findOrFail($id)->update([
                'competition_id' => $request->competition_id,
                'individual_id' => $request->team_id,
                'total_score' => $request->total_score,
            ]);

            return redirect('/dashboard/individuals-competitions-score');
        } catch (Exception $e) {
            return response('Something is wrong ' . $e->getMessage());
        }
    }
}
