<?php

namespace App\Http\Controllers;

use App\Models\Competition;
use App\Models\Individual;
use App\Models\IndividualCompetitionScore;
use App\Models\Team;
use App\Models\TeamCompetitionScore;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompetitionController extends Controller
{
    public function index($id)
    {
        // get a competition details
        try {
            $competition = Competition::findOrFail($id);
        } catch (Exception $e) {
            return response('Error on fetching data ' . $e->getMessage());
        }

        // check if the user participated in the competition
        try {
            $status = null;

            $individual = Individual::where('user_id', Auth::user()->id)->get();
            $team = Team::where('team_leader_id', Auth::user()->id)->get();

            if ($team->isNotEmpty()) {
                $competition_ids = TeamCompetitionScore::whereIn('team_id', $team->pluck('id'))->pluck('competition_id')->toArray();
                if (in_array($competition->id, $competition_ids)) {
                    $status = "participated";
                } else {
                    $status = 'not participated';
                }
            } elseif ($individual->isNotEmpty()) {
                $competition_ids = IndividualCompetitionScore::whereIn('individual_id', $individual->pluck('id'))->pluck('competition_id')->toArray();
                if (in_array($competition->id, $competition_ids)) {
                    $status = "participated";
                } else {
                    $status = 'not participated';
                }
            }

            if ($status !== "participated") {
                $individualsCount = Individual::where('competition_id', $competition->id)->count();
                $teamsCount = Team::where('competition_id', $competition->id)->count();

                if ($teamsCount >= 4 && $individualsCount >= 20) {
                    $status = "completed";
                }
            }
        } catch (Exception $e) {
            return response('Something went wrong: ' . $e->getMessage());
        }

        return view('competition.competition_details', [
            'competition' => $competition,
            'status' => $status ?? 'not participated'
        ]);
    }

    public function showRegister($id)
    {
        return view('competition.competition_register', ['id' => $id]);
    }

    public function competitionRegister(Request $request, $id)
    {
        if ($request->participation_type == 'team') {
            try {
                $teamID = Team::insertGetId([
                    'team_name' => $request->team_name,
                    'team_leader_id' => Auth::user()->id,
                    'competition_id' => $id
                ]);

                TeamCompetitionScore::insert([
                    'competition_id' => $id,
                    'team_id' => $teamID
                ]);

                return redirect('/');
            } catch (Exception $e) {
                return response('Error in inserting data: ' . $e->getMessage());
            }

        } else if ($request->participation_type == 'individual') {
            try {
                $individualID = Individual::insertGetId([
                    'team_name' => $request->team_name,
                    'user_id' => Auth::user()->id,
                    'competition_id' => $id
                ]);

                IndividualCompetitionScore::insert([
                    'competition_id' => $id,
                    'individual_id' => $individualID
                ]);

                return redirect('/');
            } catch (Exception $e) {
                return response('Error in inserting data: ' . $e->getMessage());
            }
        }

    }

    public function competitionRank($competition_id)
    {
        try {
            // check if the competition should start or not
            $individualsCount = Individual::where('competition_id', $competition_id)->count();
            $teamsCount = Team::where('competition_id', $competition_id)->count();

            if ($teamsCount < 4 || $individualsCount < 20) {
                return view('competition.competition_rank');
            } else {
                // the competition should start now
                Competition::findOrFail($competition_id)->update([
                    'start_date' => date('Y-m-d')
                ]);

                // check if the user participated as team or individual
                $isIndividual = Individual::where('user_id', Auth::user()->id)->first();
                $isTeam = Team::where('team_leader_id', Auth::user()->id)->first();

                $teams = [];
                $points = [];

                if ($isTeam) {
                    $competition_scores = TeamCompetitionScore::where('competition_id', $competition_id)
                        ->orderBy('total_score', 'desc')
                        ->get();
                    foreach ($competition_scores as $competition_score) {
                        $team = Team::where('id', $competition_score->team_id)->first();
                        array_push($teams, $team->team_name);
                        array_push($points, $competition_score->total_score);
                    }
                } else if ($isIndividual) {
                    $competition_scores = IndividualCompetitionScore::where('competition_id', $competition_id)
                        ->orderBy('total_score', 'desc')
                        ->get();
                    foreach ($competition_scores as $competition_score) {
                        $individual = Individual::where('id', $competition_score->individual_id)->first();
                        array_push($teams, $individual->team_name);
                        array_push($points, $competition_score->total_score);
                    }
                }

                return view('competition.competition_rank', ['teams' => $teams, 'points' => $points]);
            }
        } catch (Exception $e) {
            return response('Something went wrong: ' . $e->getMessage());
        }

    }


    public function showCompetitions()
    {
        try {
            $competitions = Competition::get();
            return view('admin_dashboard.competitions', ['competitions' => $competitions]);
        } catch (Exception $e) {
            return response('Something is wrong ' . $e->getMessage());
        }
    }

    public function addCompetition(Request $request)
    {
        try {
            Competition::insert([
                'competition_name' => $request->competition_name,
                'num_of_events' => $request->num_of_events,
                'description' => $request->description
            ]);

            return redirect('/dashboard/competitions');
        } catch (Exception $e) {
            return response('Something is wrong ' . $e->getMessage());
        }
    }

    public function deleteCompetition($id)
    {
        try {
            Competition::findOrFail($id)->delete();
            return redirect('/dashboard/competitions');
        } catch (Exception $e) {
            return response('Something is wrong ' . $e->getMessage());
        }
    }

    public function updateCompetition(Request $request, $id)
    {
        try {
            Competition::findOrFail($id)->update([
                'competition_name' => $request->competition_name,
                'num_of_events' => $request->num_of_events,
                'description' => $request->description,
                'start_date' => $request->start_date,
                'expire_date' => $request->expire_date,
            ]);

            return redirect('/dashboard/competitions');
        } catch (Exception $e) {
            return response('Something is wrong ' . $e->getMessage());
        }
    }
}
