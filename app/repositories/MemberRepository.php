<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\Member;
use App\Repositories\BaseRepository;

class MemberRepository extends BaseRepository
{

    protected $fillable = [
        'firstName',
        'lastName',
        'email',
        'password',
    ];

    public function __construct(User $user)
    {
        $this->model = $user;
    }

    public function getFieldData(): array
    {
        return $this->fillable;
    }

    public function model(): string
    {
        return User::class;
    }
}
