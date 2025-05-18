<?php

declare(strict_types=1);

namespace App\Models;

use CodeIgniter\Shield\Models\UserModel as ShieldUserModel;

class UserModel extends ShieldUserModel
{
    protected function initialize(): void
    {
        parent::initialize();

        $this->allowedFields = array_merge($this->allowedFields, [
            'full_name',
            'matric_no',
            'phone'
        ]);
    }
}