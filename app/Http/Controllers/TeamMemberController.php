<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateTeamMemberRequest;
use App\Services\TeamMemberService;
use Illuminate\Auth\Events\Validated;

class TeamMemberController extends Controller
{

    public function getAllTeamMembers(TeamMemberService $teamMemberService)
    {
        $response = $teamMemberService->show_all();
        return response()->json([
            'message' => "All Teams along with their members",
            'data' => $response
        ], 200);
    }

    public function postTeam(CreateTeamMemberRequest $request, TeamMemberService $teamMemberService)
    {
        $validate = $request->validated();
        // return $validate;
        $response = $teamMemberService->checkTeam($validate['user_id']);
        return $response;
        $response = $teamMemberService->add($validate);
        if (!$response) {
            return response()->json([
                'message' => 'Failed to add Team Member'
            ]);
        }
        return response()->json([
            'message' => 'Team Member added successfully'
        ], 200);
    }

    public function getTeamMember($team_id, TeamMemberService $teamMemberService)
    {
        $response = $teamMemberService->showTeam($team_id);
        if (!$response) {
            return response()->json([
                'message' => 'Team doest not exist'
            ], 404);
        }

        return response()->json([
            'message' => 'Team Found',
            'data' => $response
        ], 200);
        return $response;
    }

    public function updateTeamMember($user_id, CreateTeamMemberRequest $request, TeamMemberService $teamMemberService)
    {
        $validate = $request->validated();
        $response = $teamMemberService->update($user_id, $validate);
        if ($response == -1) {
            return response()->json([
                'message' => 'User not found'
            ], 404);
        }
        return response()->json([
            'message' => 'Team Member Successfully Updated',
            'data' => $response
        ], 200);
    }

    public function deleteTeamMember($user_id, TeamMemberService $teamMemberService)
    {
        $response = $teamMemberService->delete($user_id);
        if ($response == -1) {
            return response()->json([
                'message' => 'Team member not found'
            ], 404);
        }
        return response()->json([
            'message' => 'Team Member Successfully Deleted',
        ], 200);
    }
}
