<?php

namespace app\components;

use app\models\Customers;
use app\models\Leads;

class Helper
{
    /**
     * @return array
     */
    public static function LeadsStatuses()
    {
        return [
            Leads::STATUS_ACTIVE => 'Active',
            Leads::STATUS_INACTIVE => 'Inactive',
        ];
    }

    /**
     * @return array
     */
    public static function CustomersStatuses()
    {
        return [
            Customers::STATUS_ACTIVE => 'Active',
            Customers::STATUS_INACTIVE => 'Inactive',
        ];
    }
}