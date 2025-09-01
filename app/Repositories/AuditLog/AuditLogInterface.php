<?php

namespace App\Repositories\AuditLog;

/**
 * Interface AuditLogInterface
 * 
 * This interface defines the methods that must be implemented by any 
 * class that handles the data operations for the AuditLog model.
 */
interface AuditLogInterface
{
    /**
     * Retrieve all AuditLog from the database.
     * 
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function all();


    /**
     * Create new AuditLog in the database.
     * 
     * @param array $data
     * @return \App\Models\AuditLog
     */
    public function create(array $data);


    /**
     * Update an existing AuditLog in the database.
     * 
     * @param array $data
     * @param int $id
     * @return \App\Models\AuditLog
     */
    public function update(array $data, $id);


    /**
     * Delete an existing AuditLog from the database.
     * 
     * @param int $id
     * @return void
     */
    public function delete($id);


    /**
     * Find an existing AuditLog in the database by their ID.
     * 
     * @param int $id
     * @return \App\Models\AuditLog
     */
    public function find($id);


    /**
     * Find an existing AuditLog in the database by their $attr.
     * 
     * @param string $attr
     * @param string $value
     * @return \App\Models\AuditLog
     */
    public function findByAttribute($attr, $value);

    /**
     * Find an existing AuditLog in the database by their $attr.
     * 
     * @param string $attr
     * @param string $value
     * @param bool $paginate
     * @param bool $limit
     * @return \App\Models\AuditLog
     */
    public function findByMultiAttributes(array $attrs, $single = false, $paginate = false, $limit = false);

    /**
     * Find an existing AuditLog in the database by their ID.
     * 
     * @param int $id
     * @param array $relations // Array of relationships to eager load.
     * @return \App\Models\AuditLog
     */

     public function findWithRelations($id, array $relations = []);

     public function getAllAuditLogs($search, $sortBy = 'DESC', $startDate, $endDate, $single, $paginate = false, $limit = false, $attrs = [], $relations = [], $roleCategory = null, $set = []);
}
