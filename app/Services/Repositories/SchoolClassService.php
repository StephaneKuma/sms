<?php

namespace App\Services\Repositories;

use App\Models\SchoolClass;
use App\Repositories\SchoolClassRepository;
use Illuminate\Foundation\Http\FormRequest;
use App\Contracts\Repositories\SchoolClassContract;

class SchoolClassService implements SchoolClassContract
{
    public function __construct(private SchoolClassRepository $repository)
    {}

    public function create(FormRequest $request)
    {
        $this->repository->create($request);
    }

    public function getAll()
    {
        return $this->repository->getAll();
    }

    public function getAllBySession(int $sessionId)
    {
        return $this->repository->getAllBySession($sessionId);
    }

    public function update(FormRequest $request, SchoolClass $class)
    {
        return $this->repository->update($request, $class);
    }
    public function delete(SchoolClass $class)
    {
        return $this->repository->delete($class);
    }
}
