<?php

namespace App\Repositories\Blog;

use App\Models\Blog;

class BlogRepository implements BlogInterface
{
    /**
     * Retrieve a collection of Blog from the database.
     * 
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function all($filters = [])
    {
        $query = Blog::query();

        if (isset($filters['status'])) {
            $query->where('status', $filters['status']);
        }

        if (isset($filters['author_name'])) {
            $query->where('author_name', 'like', '%' . $filters['author_name'] . '%');
        }

        return $query->latest()->paginate(10);
    }


    /**
     * Create new Blog in the database.
     * 
     * @param array $data
     * @return \App\Models\Blog
     */
    public function create(array $data)
    {
        return Blog::create($data);
    }


    /**
     * Update an existing Blog in the database.
     * 
     * @param array $data
     * @param int $id
     * @return \App\Models\Blog
     */
    public function update(array $data, $id)
    {
        $record = Blog::findOrFail($id);
        $record->update($data);
        return $record;
    }


    /**
     * Delete an existing Blog from the database.
     * 
     * @param int $id
     * @return void
     */
    public function delete($id)
    {
        $record = Blog::findOrFail($id);
        $record->delete();
    }


    /**
     * Find an existing Blog in the database by their ID.
     * 
     * @param int $id
     * @return \App\Models\Blog
     */
    public function find($id)
    {
        return Blog::find($id);
    }


    /**
     * Find an existing Blog in the database by their $attr.
     * 
     * @param string $attr
     * @param string $value
     * @return \App\Models\Blog
     */
    public function findByAttribute($attr, $value)
    {
        return Blog::where($attr, $value)->first();
    }


    /**
     * Find an existing Blog in the database by their $attr.
     * 
     * @param string $attr
     * @param string $value
     * @param bool $single
     * @param bool $paginate
     * @param bool $limit
     * @return \App\Models\Blog
     */
    public function findByMultiAttributes($attrs, $single = false, $paginate = false, $limit = false)
    {
        $record = Blog::query();

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
}
