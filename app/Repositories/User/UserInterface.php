<?php

namespace App\Repositories\User;

/**
 * Interface UserInterface
 * 
 * This interface defines the methods that must be implemented by any 
 * class that handles the data operations for the User model.
 */
interface UserInterface
{
    /**
     * Retrieve all User from the database.
     * 
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function all();


    /**
     * Create new User in the database.
     * 
     * @param array $data
     * @return \App\Models\User
     */
    public function create(array $data);


    /**
     * Update an existing User in the database.
     * 
     * @param array $data
     * @param int $id
     * @return \App\Models\User
     */
    public function update(array $data, $id);


    /**
     * Delete an existing User from the database.
     * 
     * @param int $id
     * @return void
     */
    public function delete($id);


    /**
     * Find an existing User in the database by their ID.
     * 
     * @param int $id
     * @return \App\Models\User
     */
    public function find($id);


    /**
     * Find an existing User in the database by their $attr.
     * 
     * @param string $attr
     * @param string $value
     * @return \App\Models\User
     */
    public function findByAttribute($attr, $value);

    /**
     * Find an existing User in the database by their $attr.
     * 
     * @param string $attr
     * @param string $value
     * @param bool $paginate
     * @param bool $limit
     * @return \App\Models\User
     */
    public function findByMultiAttributes(array $attrs, $single = false, $paginate = false, $limit = false);
    public function markEmailAsVerified($id);
}
