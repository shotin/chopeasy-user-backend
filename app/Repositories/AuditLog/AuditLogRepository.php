<?php

namespace App\Repositories\AuditLog;

use App\Models\AuditLog;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class AuditLogRepository implements AuditLogInterface
{
    /**
     * Retrieve a collection of AuditLog from the database.
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function all()
    {
        return AuditLog::all();
    }


    /**
     * Create new AuditLog in the database.
     *
     * @param array $data
     * @return \App\Models\AuditLog
     */
    public function create(array $data)
    {
        return AuditLog::create($data);
    }


    /**
     * Update an existing AuditLog in the database.
     *
     * @param array $data
     * @param int $id
     * @return \App\Models\AuditLog
     */
    public function update(array $data, $id)
    {
        $record = AuditLog::findOrFail($id);
        $record->update($data);
        return $record;
    }


    /**
     * Delete an existing AuditLog from the database.
     *
     * @param int $id
     * @return void
     */
    public function delete($id)
    {
        $record = AuditLog::findOrFail($id);
        $record->delete();
    }


    /**
     * Find an existing AuditLog in the database by their ID.
     *
     * @param int $id
     * @return \App\Models\AuditLog
     */
    public function find($id)
    {
        return AuditLog::find($id);
    }


    /**
     * Find an existing AuditLog in the database by their $attr.
     *
     * @param string $attr
     * @param string $value
     * @return \App\Models\AuditLog
     */
    public function findByAttribute($attr, $value)
    {
        return AuditLog::where($attr, $value)->first();
    }


    /**
     * Find an existing AuditLog in the database by their $attr.
     *
     * @param string $attr
     * @param string $value
     * @param bool $single
     * @param bool $paginate
     * @param bool $limit
     * @return \App\Models\AuditLog
     */
    public function findByMultiAttributes($attrs, $single = false, $paginate = false, $limit = false)
    {
        $record = AuditLog::query();

        foreach ($attrs as $attr => $value) {
            $record = $record->where($attr, $value);
        }

        if ($single) {
            return $record->first();
        }

        if ($paginate) {
            return $record->paginate(10);
        }

        if ($limit) {
            return $record->take(10)->get();
        }

        return $record->get();
    }

    /**
     * Find an existing AuditLog in the database by their ID.
     *
     * @param int $id
     * @param array $relations // Array of relationships to eager load.
     * @return \App\Models\AuditLog
     */

    public function findWithRelations($id, array $relations = [])
    {
        $query = AuditLog::query()
            ->with($relations)
            ->find($id);

        // Return null if record not found
        if (!$query) {
            return null;
        }

        return $query;
    }


    public function getAllAuditLogs($search = null, $sortBy = 'DESC', $startDate = null, $endDate = null, $single = false, $paginate = false, $limit = false, $attrs = [], $relations = [], $roleCategory = null, $set = [])
    {
        $dateSearchParams = !empty($startDate) && !empty($endDate);

        // Base query with optional relationships
        $record = AuditLog::query()->with($relations);

        // Add search filter
        $record->when($search, function ($query) use ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('action_type', 'LIKE', '%' . $search . '%')
                  ->orWhere('log_name', 'LIKE', '%' . $search . '%');

                // Search through causer's firstname and lastname
                $q->orWhereHas('causer', function ($subQuery) use ($search) {
                    $subQuery->where('firstname', 'LIKE', '%' . $search . '%')
                             ->orWhere('lastname', 'LIKE', '%' . $search . '%');
                });
            });
        });

        // Add sorting
        $record->when($sortBy, function ($query) use ($sortBy) {
            return $query->orderBy('created_at', $sortBy);
        });

        // Add date range filter
        $record->when($dateSearchParams, function ($query) use ($startDate, $endDate) {
            $startDate = Carbon::parse($startDate)->startOfDay();
            $endDate = Carbon::parse($endDate)->endOfDay();
            return $query->whereBetween(DB::raw('DATE(created_at)'), [$startDate, $endDate]);
        });


        // Add attribute-based filters
        $record->when(!empty($attrs), function ($query) use ($attrs) {
            foreach ($attrs as $key => $value) {
                if (is_array($value) && count($value) === 3) {
                    // [column, operator, value]
                    [$column, $operator, $conditionValue] = $value;
                    $query->where($column, $operator, $conditionValue);
                } elseif (is_array($value) && count($value) === 2) {
                    // [column, value]
                    [$column, $conditionValue] = $value;
                    $query->where($column, $conditionValue);
                } elseif (is_string($key)) {
                    // Key-value pair
                    $query->where($key, $value);
                }
            }
        });

        //filter by role
        if (!empty($roleCategory)) {
            $record->whereHas('causer', function ($query) use ($roleCategory) {
                $query->whereHas('roles', function ($query) use ($roleCategory) {
                    $query->where('slug', $roleCategory);
                });
            });
        }

        // Apply Set-Based Filtering
        if (!empty($set)) {
            $record->whereHas('causer', function ($query) use ($set) {
                $query->whereIn('set_id', $set);
            });
        }

        // Fetch single record if requested
        if ($single) {
            return $record->first();
        }

        // Paginate results if requested
        if ($paginate) {
            return $record->paginate(10);
        }

        // Limit results if requested
        if ($limit) {
            return $record->take($limit)->get();
        }

        // Get the audit log records
        return $record->get();
    }

    /**
     * Helper function to get roles from the role category using getRoleCategory().
     */
    private function getRolesFromCategory($roleCategory)
    {
        $roleMappings = [
            'project_superadmin' => ['globaladmin', 'technicalcommittee', 'executivemember', 'financemanager'],
            'project_admin' => ['setadmin', 'setchairman'],
            'project_member' => ['member'],
            'project_family_members' => ['familymember'],
            'project_general_users' => ['customer'],
            'project_guest' => ['guest'],
        ];

        return $roleMappings[$roleCategory] ?? [];
    }
}
