<?php

namespace App\Http\Controllers\v1\Admin;

use App\Exports\AuditLogsExport;
use App\Http\Controllers\Controller;
use App\Responser\JsonResponser;
use App\Services\AuditLog\AuditLogService;
use App\Services\User\UserService;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class AuditTrailController extends Controller
{
    protected $userService;
    protected $auditLogService;

    public function __construct(
        UserService $userService,
        AuditLogService $auditLogService,
    ) {
        $this->userService = $userService;
        $this->auditLogService = $auditLogService;
    }

    public function allAuditLogs(Request $request)
    {
        try {
            $currentUser = auth()->user();
            if (is_null($currentUser)) {
                return JsonResponser::send(true, 'User not found.', [], 404);
            }

            $searchTerm = $request->searchTerm;
            $sortBy = $request->sort_by ?? 'DESC';
            $startDate = $request->start_date;
            $endDate = $request->end_date;
            $single = $request->single;
            $set = $request->set_id;
            $limit = $request->limit ?? false;
            $paginate = $limit ? false : ($request->paginate ?? false);
            $attrs = [];
            $roleCategory = $request->role_category;
            $relations = ['causer.set:id,name', 'causer:id,firstname,lastname,set_id', 'causer.roles:id,name,slug']; //'action'

            $records = $this->auditLogService->getAllAuditLogs($searchTerm, $sortBy, $startDate, $endDate, $single, $paginate, $limit, $attrs, $relations, $roleCategory, $set);

            $count = $records instanceof \Illuminate\Pagination\LengthAwarePaginator
                ? $records->total()
                : $records->count();

            $data = [
                'recordsCount' => $count,
                'records' => $records,
            ];

            return JsonResponser::send(false, 'Record(s) found successfully.', $data, 200);
        } catch (\Throwable $th) {
            return JsonResponser::send(true, 'Internal server error', [], 500, $th);
        }
    }

    public function singleAuditLog($id)
    {
        try {
            $currentUser = auth()->user();
            if (is_null($currentUser)) {
                return JsonResponser::send(true, 'User not found.', [], 404);
            }

            $relations = ['causer.set:id,name', 'causer:id,firstname,lastname,set_id', 'causer.roles:id,name,slug']; //'action'

            $record = $this->auditLogService->findWithRelations($id, $relations);

            $data = [
                'record' => $record,
                'trail' => [],
            ];

            return JsonResponser::send(false, 'Record(s) found successfully.', $data, 200);
        } catch (\Throwable $th) {
            return JsonResponser::send(true, 'Internal server error', [], 500, $th);
        }
    }

    public function downloadAuditLogs(Request $request)
    {
        try {
            $currentUser = auth()->user();
            if (is_null($currentUser)) {
                return JsonResponser::send(true, 'User not found.', [], 404);
            }

            $searchTerm = $request->searchTerm;
            $sortBy = $request->sort_by ?? 'ASC';
            $startDate = $request->start_date;
            $endDate = $request->end_date;
            $single = $request->single;
            $set = $request->set_id;
            $roleCategory = $request->role_category;
            $relations = ['causer.set:id,name', 'causer:id,firstname,lastname,set_id', 'causer.roles:id,name,slug'];

            $records = $this->auditLogService->getAllAuditLogs($searchTerm, $sortBy, $startDate, $endDate, $single, false, false, [], $relations, $roleCategory, $set);
            $fileName = 'audit_logs_' . date('Y-m-d_H-i-s') . '.csv';

            return Excel::download(new AuditLogsExport($records), $fileName, \Maatwebsite\Excel\Excel::CSV);
        } catch (\Throwable $th) {
            return JsonResponser::send(true, 'Error generating Excel file', [], 500, $th);
        }
    }
}
