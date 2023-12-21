<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

/**
 * Abstract base repository class for interacting with a specific model.
 */
abstract class BaseRepository
{

    /**
     * The model instance associated with the repository.
     *
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $model;

    /**
     * Create a new instance of the repository with the specified model.
     *
     * @param \Illuminate\Database\Eloquent\Model $model  The model instance associated with the repository.
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * Get an array of field data used by the repository.
     *
     * @return array  An array of field data.
     */
    abstract public function getFieldData(): array;

    /**
     * Get the model class name associated with the repository.
     *
     * @return string  The model class name.
     */
    abstract public function model(): string;

    /**
     * Retrieve paginated members based on provided query conditions.
     *
     * @param array  $query      Associative array of query conditions.
     * @param string $searchKey  The key for the search condition.
     */

    public function index(array $query = [], string $searchKey = 'name')
    {
        $queryBuilder = $this->model->query();
        foreach ($query as $column => $value) {
            $this->applyQueryCondition($queryBuilder, $column, $value, $searchKey);
        }
        return $queryBuilder->paginate(3);
    }

    /**
     * Store a new record in the database based on the validated data.
     *
     * @param array $validatedData  The validated data to be stored.
     *
     * @return void
     */

    public function store(array $validatedData)
    {
        $this->model->create($validatedData);
    }

    /**
     * Retrieve the object for editing based on the given identifier.
     *
     * @param mixed $object  The object to be edited.
     *
     * @return mixed  The object for editing.
     */
    public function edit($object)
    {
        return $object;
    }

    /**
     * Update the given object in the database with the validated data.
     *
     * @param array $validatedData  The validated data to update the object.
     * @param mixed $object         The object to be updated.
     *
     * @return mixed  The updated object.
     */
    public function update(array $validatedData, $object)
    {
        $object->update($validatedData);
        return $object;
    }

    /**
     * Delete the given object from the database.
     *
     * @param mixed $object  The object to be deleted.
     *
     * @return void
     */

    public function destroy($object)
    {
        $object->delete();
    }

    /**
     * Apply the appropriate query condition based on the given column and value.
     *
     * @param mixed  $queryBuilder  The query builder.
     * @param string $column        The column to be queried.
     * @param mixed  $value         The value to filter by.
     * @param string $searchKey     The key for the search condition.
     *
     * @return void
     */
    private function applyQueryCondition($queryBuilder, $column, $value, $searchKey)
    {
        switch ($column) {
            case 'search':
                $this->applySearchCondition($queryBuilder, $searchKey, $value);
                break;
            case 'role':
                $this->applyRoleCondition($queryBuilder, $value);
                break;
            case 'roleSearch':
                $this->applyRoleSearchCondition($queryBuilder, $searchKey, $value['role'], $value['search']);
                break;
            default:
                $queryBuilder->where($column, $value);
        }
    }

    /**
     * Apply the search condition on the specified column.
     *
     * @param mixed  $queryBuilder  The query builder.
     * @param string $searchKey     The key for the search condition.
     * @param mixed  $value         The value to search for.
     *
     * @return void
     */
    private function applySearchCondition($queryBuilder, $searchKey, $value)
    {
        $queryBuilder->where($searchKey, 'like', '%' . $value . '%');
    }

    /**
     * Apply the role condition on the specified role name.
     *
     * @param mixed  $queryBuilder  The query builder.
     * @param mixed  $value         The role name to filter by.
     *
     * @return void
     */
    private function applyRoleCondition($queryBuilder, $value)
    {
        $queryBuilder->whereHas('roles', function ($query) use ($value) {
            $query->where('name', $value);
        });
    }

    /**
     * Apply the combined role and search condition.
     *
     * @param mixed  $queryBuilder  The query builder.
     * @param string $searchKey     The key for the search condition.
     * @param mixed  $value         The role name to filter by.
     *
     * @return void
     */
    private function applyRoleSearchCondition($queryBuilder, $searchKey, $role, $value)
    {
        $queryBuilder->whereHas('roles', function ($query) use ($role) {
            $query->where('name', $role);
        })->where($searchKey, 'like', '%' . $value . '%');
    }


    /*
    * the old function index :
    public function index(array $query = [], string $searchKey = 'name')
    {
        $queryBuilder = $this->model->query();
        // Apply additional query logic if provided
        foreach ($query as $column => $value) {
            if ($column === 'search') {
                // Handle search condition separately
                $queryBuilder->where($searchKey, 'like', '%' . $value . '%');
            } elseif ($column === 'role') {
                // Filter members with the specified role
                $queryBuilder->whereHas('roles', function ($query) use ($value) {
                    $query->where('name', $value);
                });
            } elseif ($column === 'roleSearch') {
                // Filter members with the specified role and name like %$value%
                $queryBuilder->whereHas('roles', function ($query) use ($value, $searchKey) {
                    $query->where('name', $value);
                })->where($searchKey, 'like', '%' . $value . '%');
            } else {
                $queryBuilder->where($column, $value);
            }
        }
        return $queryBuilder->paginate(3);
    }
    */
}
