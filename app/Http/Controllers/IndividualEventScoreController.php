<?php

namespace App\Http\Controllers;

use App\Models\IndividualCompetitionScore;
use App\Models\IndividualEventScore;
use Exception;
use Illuminate\Http\Request;

class IndividualEventScoreController extends Controller
{
    public function showIndividualsEventScore()
    {
        try {
            $events_score = IndividualEventScore::get();
            return view('admin_dashboard.individuals_events_score', ['events_score' => $events_score]);
        } catch (Exception $e) {
            return response('Something is wrong ' . $e->getMessage());
        }
    }

    public function addIndividualEventScore(Request $request)
    {
        try {
            IndividualEventScore::insert([
                'individual_id' => $request->individual_id,
                'event_id' => $request->event_id,
                'event_score' => $request->event_score,
            ]);

            $totalScore = IndividualEventScore::where('individual_id', $request->individual_id)->sum('event_score');
            IndividualCompetitionScore::where('individual_id', $request->individual_id)->update([
                'total_score' => $totalScore
            ]);

            return redirect('/dashboard/individuals-events-score');
        } catch (Exception $e) {
            return response('Something is wrong ' . $e->getMessage());
        }
    }

    public function deleteIndividualEventScore($id)
    {
        try {
            IndividualEventScore::findOrFail($id)->delete();
            return redirect('/dashboard/individuals-events-score');
        } catch (Exception $e) {
            return response('Something is wrong ' . $e->getMessage());
        }
    }

    public function updateIndividualEventScore(Request $request, $id)
    {
        try {
            IndividualEventScore::findOrFail($id)->update([
                'event_id' => $request->event_id,
                'event_score' => $request->event_score,
            ]);

            return redirect('/dashboard/individuals-events-score');
        } catch (Exception $e) {
            return response('Something is wrong ' . $e->getMessage());
        }
    }
}
