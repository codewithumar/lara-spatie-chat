<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateTeamMemberRequest;
use App\Services\TeamMemberService;

class TeamMemberController extends Controller
{

    public function getAllTeamMembers(TeamMemberService $teamMemberService)
    {
        $response=$teamMemberService->show_all();
        return $response;
    }

    public function postTeam(CreateTeamMemberRequest $request, TeamMemberService $teamMemberService)
    {
        $validate=$request->validated();
        $response=$teamMemberService->add($validate);
        return $response;
    }

    public function getTeamMember($team_id, TeamMemberService $teamMemberService)
    {
        $response=$teamMemberService->showTeam($team_id);
        return $response;
    }

    public function updateTeamMember($user_id, CreateTeamMemberRequest $request, TeamMemberService $teamMemberService)
    {
        $validate=$request->validated();
        $response=$teamMemberService->update($user_id, $validate);
        return $response;
    }

    public function deleteTeamMember($user_id, TeamMemberService $teamMemberService)
    {
        $response=$teamMemberService->delete($user_id);
        return $response;
    }
}