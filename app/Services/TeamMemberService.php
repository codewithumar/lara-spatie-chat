<?php

namespace App\Services;

use App\Models\TeamMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TeamMemberService
{
    public function add(array $data)
    {
        return  TeamMember::create([
            'team_id' => $data['team_id'],
            'user_id' => $data['user_id'],
        ]);
    }

    public function show_all()
    {
        return TeamMember::all();
    }

    public function showTeam($team_id)
    {
        return  TeamMember::where('team_id', $team_id)->get();
    }

    public function update($user_id, array $data)
    {
        $teamMember = TeamMember::where('user_id', $user_id)->first();

        if (!$teamMember) {
            return -1;
        }

        return  $teamMember->update([
            'user_id' => $data['user_id'],
            'team_id' => $data['team_id']
        ]);
    }

    public function delete($user_id)
    {
        $teamMember = TeamMember::where('user_id', $user_id)->first();

        if (!$teamMember) {
            return -1;
        }

        $id = $teamMember->id;
        return TeamMember::where('id', $id)->delete();
    }
}
