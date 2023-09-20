<?php

namespace App\Services;

use App\Models\TeamMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TeamMemberService
{
    public function add(array $data)
    {
        $teamMember = TeamMember::create([
            'team_id' => $data['team_id'],
            'user_id' => $data['user_id'],
        ]);

        if(! $teamMember){
            return response()->json([
                'message' => 'Failed to add Team Member'
            ]);
        }
        return response()->json([
            'message' => 'Team Member added successfully'
        ], 200);
    }

    public function show_all()
    {
        $teamMembers = TeamMember::all();
        return response()->json ([
            'message' => "All Teams along with their members",
            'data' => $teamMembers
        ], 200);
    }

    public function showTeam($team_id)
    {
        $teamMember = TeamMember::where('team_id', $team_id)->get();

        if (! $teamMember) {
            return response()->json([
                'message' => 'Team doest not exist'
            ], 404);
        }
    
        return response()->json([
            'message' => 'Team Found',
            'data' => $teamMember
        ], 200);
    }

    public function update($user_id, array $data)
    {
        $teamMember = TeamMember::where('user_id', $user_id)->first();

        if(! $teamMember)
        {
            return response()->json([
                'message' => 'User not found'
            ], 404);
        }
        
        $teamMember->update([
            'user_id' => $data['user_id'],
            'team_id' => $data['team_id']
        ]);

        return response()->json([
            'message' => 'Team Member Successfully Updated',
            'data' => $teamMember
        ], 200);

    }

    public function delete($user_id)
    {
        $teamMember = TeamMember::where('user_id', $user_id)->first();

        if(! $teamMember)
        {
            return response()->json([
                'message' => 'User not found'
            ], 404);
        }
        
        $id = $teamMember->id;
        TeamMember::where('id', $id)->delete();

        return response()->json([
            'message' => 'Team Member Successfully Deleted',
        ], 200);

    }
}