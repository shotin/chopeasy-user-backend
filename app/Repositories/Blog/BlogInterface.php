<?php

namespace App\Repositories\Blog;

/**
 * Interface BlogInterface
 * 
 * This interface defines the methods that must be implemented by any 
 * class that handles the data operations for the Blog model.
 */
interface BlogInterface
{
    /**
     * Retrieve all Blog from the database.
     * 
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function all($filters = []);


    /**
     * Create new Blog in the database.
     * 
     * @param array $data
     * @return \App\Models\Blog
     */
    public function create(array $data);


    /**
     * Update an existing Blog in the database.
     * 
     * @param array $data
     * @param int $id
     * @return \App\Models\Blog
     */
    public function update(array $data, $id);


    /**
     * Delete an existing Blog from the database.
     * 
     * @param int $id
     * @return void
     */
    public function delete($id);


    /**
     * Find an existing Blog in the database by their ID.
     * 
     * @param int $id
     * @return \App\Models\Blog
     */
    public function find($id);


    /**
     * Find an existing Blog in the database by their $attr.
     * 
     * @param string $attr
     * @param string $value
     * @return \App\Models\Blog
     */
    public function findByAttribute($attr, $value);

    /**
     * Find an existing Blog in the database by their $attr.
     * 
     * @param string $attr
     * @param string $value
     * @param bool $paginate
     * @param bool $limit
     * @return \App\Models\Blog
     */
    public function findByMultiAttributes(array $attrs, $single = false, $paginate = false, $limit = false);
}
