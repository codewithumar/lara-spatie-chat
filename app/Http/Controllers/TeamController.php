<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Models\Team;





class TeamController extends Controller
{
    public function index()
    {

        $teams = Team::all();
        return $teams;
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $team = Team::create([
            'name' => $request->name,
            'department_id' => $request->department_id,
            'teamlead_id' => $request->teamlead_id,
        ]);

        if(! $team){
            return response()->json([
                'message' => 'Failed to create a new Team',
            ]);
        }

        return response()->json([
            'message' => 'Team Created Successfully',
        ]);
    }


    public function show(Request $request)
    {
        $id = $request->team_id;
        $team = Team::find($id);
        if (!$team) {
            return response()->json([
                'message' => 'Team not found'
            ], 404);
        }
        return response()->json(['data' => $team]);
    }


    public function update(Request $request, $id)
    {
        $team = Team::find($id);
        if (!$team) {
            return response()->json(['error' => 'Team not found'], 404);
        }
        $team->update([
            'name' => empty($request->name) ? $team->name : $request->name,
            'department_id' => empty($request->department_id) ? $team->department_id : $request->department_id,
            'teamlead_id' => empty($request->teamlead_id) ? $team->teamlead_id : $request->teamlead_id,
        ]);
        return response()->json(['message' => 'Team updated successfully', 'data' => $team]);
    }


    public function destroy(Request $request,$id)
    {
        $team = Team::find($id);

        if (!$team) {
            return response()->json(['error' => 'Team not found'], 404);
        }

        $team->delete();

        return response()->json(['message' => 'Team deleted successfully']);
    }
}