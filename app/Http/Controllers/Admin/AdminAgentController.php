<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AgentEarning;
use App\Models\AgentWithdrawal;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AdminAgentController extends Controller
{
    /**
     * List all agents for admin with earnings
     */
    public function index(Request $request): JsonResponse
    {
        $perPage = $request->query('per_page', 15);
        $search = $request->query('search');

        $query = User::where('user_type', 'agent')
            ->with('agentBankDetails')
            ->when($search, fn($q) => $q->where(function ($q2) use ($search) {
                $q2->where('fullname', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            }))
            ->orderByDesc('created_at');

        $agents = $query->paginate($perPage);

        $agentIds = $agents->pluck('id');

        $totalEarnings = AgentEarning::whereIn('agent_id', $agentIds)
            ->selectRaw('agent_id, SUM(amount) as total')
            ->groupBy('agent_id')
            ->pluck('total', 'agent_id');

        $pendingWithdrawals = AgentWithdrawal::whereIn('agent_id', $agentIds)
            ->where('status', 'pending')
            ->selectRaw('agent_id, SUM(amount) as total')
            ->groupBy('agent_id')
            ->pluck('total', 'agent_id');

        $formatted = $agents->map(function ($agent) use ($totalEarnings, $pendingWithdrawals) {
            $bank = $agent->agentBankDetails;
            $accountNumber = $bank && $bank->account_number
                ? substr($bank->account_number, 0, 3) . '****' . substr($bank->account_number, -3)
                : null;

            return [
                'id' => (string) $agent->id,
                'name' => $agent->fullname,
                'email' => $agent->email,
                'bank_name' => $bank->bank_name ?? null,
                'account_number' => $accountNumber,
                'total_earnings' => (float) ($totalEarnings[$agent->id] ?? 0),
                'pending_withdrawal' => (float) ($pendingWithdrawals[$agent->id] ?? 0),
                'status' => $agent->is_active ? 'active' : 'blocked',
            ];
        });

        return response()->json([
            'data' => $formatted,
            'pagination' => [
                'currentPage' => $agents->currentPage(),
                'lastPage' => $agents->lastPage(),
                'perPage' => $agents->perPage(),
                'total' => $agents->total(),
            ],
            'summary' => [
                'total_agents' => User::where('user_type', 'agent')->count(),
                'total_earnings' => (float) AgentEarning::sum('amount'),
                'pending_withdrawals' => (float) AgentWithdrawal::where('status', 'pending')->sum('amount'),
            ],
        ]);
    }

    /**
     * Get single agent details
     */
    public function show(int $id): JsonResponse
    {
        $agent = User::where('user_type', 'agent')->with('agentBankDetails')->find($id);

        if (!$agent) {
            return response()->json(['error' => 'Agent not found'], 404);
        }

        $totalEarnings = AgentEarning::where('agent_id', $id)->sum('amount');
        $pendingWithdrawal = AgentWithdrawal::where('agent_id', $id)->where('status', 'pending')->sum('amount');
        $bank = $agent->agentBankDetails;

        return response()->json([
            'data' => [
                'id' => (string) $agent->id,
                'name' => $agent->fullname,
                'email' => $agent->email,
                'bank_name' => $bank->bank_name ?? null,
                'account_number' => $bank->account_number ?? null,
                'account_name' => $bank->account_name ?? null,
                'total_earnings' => (float) $totalEarnings,
                'pending_withdrawal' => (float) $pendingWithdrawal,
                'status' => $agent->is_active ? 'active' : 'blocked',
            ],
        ]);
    }
}
