<?php

namespace App\Services\Blog;

use App\Repositories\Blog\BlogInterface;

/**
 * Class BlogService
 * 
 * This class provides services related to Blog operations and acts as a 
 * layer between the Controller and the BlogRepository.
 */
class BlogService
{
    protected BlogInterface $BlogInterface;
    /**
     * Blog constructor.
     * 
     * @param BlogInterface $BlogInterface
     */
    public function __construct(BlogInterface $BlogInterface)
    {
        $this->BlogInterface = $BlogInterface;
    }

    /**
     * Retrieve all Blog.
     * 
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function all(array $filters = [])
    {
        return $this->BlogInterface->all($filters);
    }

    /**
     * Create a new Blog using the data provided.
     * 
     * @param array $data
     * @return \App\Models\Blog
     */
    public function create(array $data)
    {
        return $this->BlogInterface->create($data);
    }


    /**
     * Update an existing Blog with the provided data.
     * 
     * @param array $data
     * @param int $id
     * @return \App\Models\Blog
     */
    public function update(array $data, $id)
    {
        return $this->BlogInterface->update($data, $id);
    }


    /**
     * Delete a Blog by heir ID.
     * 
     * @param int $id
     * @return void
     */
    public function delete($id)
    {
        return $this->BlogInterface->delete($id);
    }


    /**
     * Find a Blog by their ID.
     * 
     * @param int $id
     * @return \App\Models\Blog
     */
    public function find($id)
    {
        return $this->BlogInterface->find($id);
    }


    /**
     * Find an existing Blog  by their $attr.
     * 
     * @param string $attr
     * @param string $value
     * @return \App\Models\Blog
     */
    public function findByAttribute($attr, $value)
    {
        return $this->BlogInterface->findByAttribute($attr, $value);
    }

    public function findByMultiAttributes(array $attrs, $single = false, $paginate = false, $limit = false)
    {
        return $this->BlogInterface->findByMultiAttributes($attrs, $single, $paginate, $limit);
    }
}
