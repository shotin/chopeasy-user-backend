<?php

namespace App\Services\AuditLog;

use App\Repositories\AuditLog\AuditLogInterface;

/**
 * Class AuditLogService
 * 
 * This class provides services related to AuditLog operations and acts as a 
 * layer between the Controller and the AuditLogRepository.
 */
class AuditLogService
{
    protected AuditLogInterface $AuditLogInterface;
    /**
     * AuditLog constructor.
     * 
     * @param AuditLogInterface $AuditLogInterface
     */
    public function __construct(AuditLogInterface $AuditLogInterface)
    {
        $this->AuditLogInterface = $AuditLogInterface;
    }

    /**
     * Retrieve all AuditLog.
     * 
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function all()
    {
        return $this->AuditLogInterface->all();
    }

    /**
     * Create a new AuditLog using the data provided.
     * 
     * @param array $data
     * @return \App\Models\AuditLog
     */
    public function create(array $data)
    {
        return $this->AuditLogInterface->create($data);
    }


    /**
     * Update an existing AuditLog with the provided data.
     * 
     * @param array $data
     * @param int $id
     * @return \App\Models\AuditLog
     */
    public function update(array $data, $id)
    {
        return $this->AuditLogInterface->update($data, $id);
    }


    /**
     * Delete a AuditLog by heir ID.
     * 
     * @param int $id
     * @return void
     */
    public function delete($id)
    {
        return $this->AuditLogInterface->delete($id);
    }


    /**
     * Find a AuditLog by their ID.
     * 
     * @param int $id
     * @return \App\Models\AuditLog
     */
    public function find($id)
    {
        return $this->AuditLogInterface->find($id);
    }


    /**
     * Find an existing AuditLog  by their $attr.
     * 
     * @param string $attr
     * @param string $value
     * @return \App\Models\AuditLog
     */
    public function findByAttribute($attr, $value)
    {
        return $this->AuditLogInterface->findByAttribute($attr, $value);
    }

    public function findByMultiAttributes(array $attrs, $single = false, $paginate = false, $limit = false)
    {
        return $this->AuditLogInterface->findByMultiAttributes($attrs, $single, $paginate, $limit);
    }

    public function getAllAuditLogs($search, $sortBy = 'DESC', $startDate, $endDate, $single, $paginate = false, $limit = false, $attrs = [], $relations = [], $roleCategory = [], $set = [])
    {
        return $this->AuditLogInterface->getAllAuditLogs($search, $sortBy, $startDate, $endDate, $single, $paginate, $limit, $attrs, $relations, $roleCategory, $set);
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
         return $this->AuditLogInterface->findWithRelations($id, $relations);
     }
}
