<?php

namespace App\Repositories\User;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserInterface
{
    protected $model;

    public function __construct(User $user)
    {
        $this->model = $user;
    }

    public function all()
    {
        return $this->model->all();
    }

    public function create(array $data)
    {
        $data['password'] = Hash::make($data['password']);
        return $this->model->create($data);
    }

    public function update(array $data, $id)
    {
        $record = $this->model->findOrFail($id);
        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }
        $record->update($data);
        return $record;
    }

    public function delete($id)
    {
        $record = $this->model->findOrFail($id);
        $record->delete();
    }

    public function find($id)
    {
        return $this->model->find($id);
    }

    public function findByAttribute($attr, $value)
    {
        return $this->model->where($attr, $value)->first();
    }

    public function findByMultiAttributes($attrs, $single = false, $paginate = false, $limit = false)
    {
        $record = $this->model->query();
        foreach ($attrs as $attr => $value) {
            $record = $record->where($attr, $value);
        }
        if ($single) return $record->first();
        if ($paginate) return $record->paginate(10);
        if ($limit) return $record->take(10)->get();
        return $record->get();
    }

    public function markEmailAsVerified($id)
    {
        $user = $this->find($id);
        if ($user) {
            $user->is_verified = true;
            $user->can_login = true;
            $user->email_verified_at = now();
            $user->save();
            return $user;
        }
        return null;
    }
}
