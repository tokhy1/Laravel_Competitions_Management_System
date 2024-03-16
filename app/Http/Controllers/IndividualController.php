<?php

namespace App\Http\Controllers;

use App\Models\Individual;
use Exception;
use Illuminate\Http\Request;

class IndividualController extends Controller
{
    public function showIndividuals()
    {
        try {
            $individuals = Individual::get();
            return view('admin_dashboard.individuals', ['individuals' => $individuals]);
        } catch (Exception $e) {
            return response('Something is wrong ' . $e->getMessage());
        }
    }

    public function addIndividual(Request $request)
    {
        try {
            Individual::insert([
                'team_name' => $request->team_name,
                'user_id' => $request->user_id,
                'competition_id' => $request->competition_id,
            ]);

            return redirect('/dashboard/individuals');
        } catch (Exception $e) {
            return response('Something is wrong ' . $e->getMessage());
        }
    }

    public function deleteIndividual($id)
    {
        try {
            Individual::findOrFail($id)->delete();
            return redirect('/dashboard/individuals');
        } catch (Exception $e) {
            return response('Something is wrong ' . $e->getMessage());
        }
    }

    public function updateIndividual(Request $request, $id)
    {
        try {
            Individual::findOrFail($id)->update([
                'team_name' => $request->team_name,
                'competition_id' => $request->competition_id,
            ]);

            return redirect('/dashboard/individuals');
        } catch (Exception $e) {
            return response('Something is wrong ' . $e->getMessage());
        }
    }
}
