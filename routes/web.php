<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CompetitionController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\IndividualController;
use App\Http\Controllers\IndividualEventScoreController;
use App\Http\Controllers\IndividualCompetitionScoreController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\TeamCompetitionScoreController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\TeamEventScoreController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Authentication routes
Route::get('/showregister', [AuthController::class, 'showRegister']);
Route::post('/register', [AuthController::class, 'register']);

Route::get('/showlogin', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/logout', [AuthController::class, 'logout']);

// Home page
Route::get('/', [UserController::class, 'showHome']);

// Authorize user for all routes
Route::middleware('auth')->group(function () {
    // competition details page
    Route::get('/competition-details/{id}', [CompetitionController::class, 'index']);
    // competition register
    Route::get('/competition-showregister/{id}', [CompetitionController::class, 'showRegister']);
    Route::post('/competition-register/{id}', [CompetitionController::class, 'competitionRegister']);

    // competition user rank
    Route::get('competition-rank/{id}', [CompetitionController::class, 'competitionRank']);

    // dashboard
    Route::middleware('admin')->group(function () {
        // admins
        Route::get('/dashboard/admins', [SuperAdminController::class, 'showAdmins'])->middleware('superadmin');
        Route::post('/dashboard/add-admin', [SuperAdminController::class, 'addAdmin'])->middleware('superadmin');
        Route::get('/dashboard/delete-admin/{id}', [SuperAdminController::class, 'deleteAdmin'])->middleware('superadmin');
        Route::put('/dashboard/update-admin/{id}', [SuperAdminController::class, 'updateAdmin'])->middleware('superadmin');
        // users
        Route::get('/dashboard/users', [UserController::class, 'showUsers']);
        Route::post('/dashboard/add-user', [UserController::class, 'addUser']);
        Route::get('/dashboard/delete-user/{id}', [UserController::class, 'deleteUser']);
        Route::put('/dashboard/update-user/{id}', [UserController::class, 'updateUser']);
        // competitions
        Route::get('/dashboard/competitions', [CompetitionController::class, 'showCompetitions']);
        Route::post('/dashboard/add-competition', [CompetitionController::class, 'addCompetition']);
        Route::get('/dashboard/delete-competition/{id}', [CompetitionController::class, 'deleteCompetition']);
        Route::put('/dashboard/update-competition/{id}', [CompetitionController::class, 'updateCompetition']);
        // events
        Route::get('/dashboard/events', [EventController::class, 'showEvents']);
        Route::post('/dashboard/add-event', [EventController::class, 'addEvent']);
        Route::get('/dashboard/delete-event/{id}', [EventController::class, 'deleteEvent']);
        Route::put('/dashboard/update-event/{id}', [EventController::class, 'updateEvent']);
        // teams
        Route::get('/dashboard/teams', [TeamController::class, 'showTeams']);
        Route::post('/dashboard/add-team', [TeamController::class, 'addTeam']);
        Route::get('/dashboard/delete-team/{id}', [TeamController::class, 'deleteTeam']);
        Route::put('/dashboard/update-team/{id}', [TeamController::class, 'updateTeam']);
        // teams events score
        Route::get('/dashboard/teams-events-score', [TeamEventScoreController::class, 'showTeamsEventScore']);
        Route::post('/dashboard/add-team-event-score', [TeamEventScoreController::class, 'addTeamEventScore']);
        Route::get('/dashboard/delete-team-event-score/{id}', [TeamEventScoreController::class, 'deleteTeamEventScore']);
        Route::put('/dashboard/update-team-event-score/{id}', [TeamEventScoreController::class, 'updateTeamEventScore']);
        // teams competitions score
        Route::get('/dashboard/teams-competitions-score', [TeamCompetitionScoreController::class, 'showTeamsCompetitionScore']);
        Route::post('/dashboard/add-team-competition-score', [TeamCompetitionScoreController::class, 'addTeamCompetitionScore']);
        Route::get('/dashboard/delete-team-competition-score/{id}', [TeamCompetitionScoreController::class, 'deleteTeamCompetitionScore']);
        Route::put('/dashboard/update-team-competition-score/{id}', [TeamCompetitionScoreController::class, 'updateTeamCompetitionScore']);
        // individuals
        Route::get('/dashboard/individuals', [IndividualController::class, 'showIndividuals']);
        Route::post('/dashboard/add-individual', [IndividualController::class, 'addIndividual']);
        Route::get('/dashboard/delete-individual/{id}', [IndividualController::class, 'deleteIndividual']);
        Route::put('/dashboard/update-individual/{id}', [IndividualController::class, 'updateIndividual']);
        // individuals events score
        Route::get('/dashboard/individuals-events-score', [IndividualEventScoreController::class, 'showIndividualsEventScore']);
        Route::post('/dashboard/add-individual-event-score', [IndividualEventScoreController::class, 'addIndividualEventScore']);
        Route::get('/dashboard/delete-individual-event-score/{id}', [IndividualEventScoreController::class, 'deleteIndividualEventScore']);
        Route::put('/dashboard/update-individual-event-score/{id}', [IndividualEventScoreController::class, 'updateIndividualEventScore']);
        // individuals competitions score
        Route::get('/dashboard/individuals-competitions-score', [IndividualCompetitionScoreController::class, 'showIndividualsCompetitionScore']);
        Route::post('/dashboard/add-individual-competition-score', [IndividualCompetitionScoreController::class, 'addIndividualsCompetitionScore']);
        Route::get('/dashboard/delete-individual-competition-score/{id}', [IndividualCompetitionScoreController::class, 'deleteIndividualsCompetitionScore']);
        Route::put('/dashboard/update-individual-competition-score/{id}', [IndividualCompetitionScoreController::class, 'updateIndividualsCompetitionScore']);
    });
});
