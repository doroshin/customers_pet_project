<?php

namespace tests\unit\models;

use app\models\Customers;
use app\tests\fixtures\CustomerFixture;
use Codeception\Test\Unit;
use Codeception\Util\Debug;
use UnitTester;

class CustomersTest extends Unit
{
    /**
     * @var UnitTester
     */
    protected $tester;

    public function _fixtures()
    {
        return [
            'customers' => 'app\tests\fixtures\CustomerFixture',
        ];
    }

    /**
     * Test for update Customer entity
     */
    public function testUpdateCustomer()
    {
        $customerFixture1 = $this->tester->grabFixture('customers', 'customer1');
        // Creating customer to update
        $addCustomer = new Customers();
        $addCustomer->first_name = $customerFixture1['first_name'];
        $addCustomer->second_name = $customerFixture1['second_name'];
        $addCustomer->phone = $customerFixture1['phone'];
        $addCustomer->address = $customerFixture1['address'];
        $addCustomer->email = $customerFixture1['email'];
        $addCustomer->status = $customerFixture1['status'];
        $addCustomer->parent_id = $customerFixture1['parent_id'];
        $addCustomer->created_at = $customerFixture1['created_at'];
        $addCustomer->modified_at = $customerFixture1['modified_at'];
        if ($addCustomer->save()) {
            $customerToUpdate = (new Customers())->findOne(['first_name' => $customerFixture1['first_name']]);
            $valuesToUpdate = [
                'second_name' => 'someNewSecondName',
                'address' => 'someNewAdress'
            ];
            $customerToUpdate->attributes = $valuesToUpdate;
            $this->assertTrue(true, $customerToUpdate->update());   // Updating customers 'second_name' and 'address'
        }
    }

    /**
     * Test for delete Customer entity
     */
    public function testDeleteCustomer()
    {
        $fixture = $this->tester->grabFixture('customers', 'customer1');
        // Creating customer to delete
        $addCustomer = new Customers();
        $addCustomer->first_name = $fixture['first_name'];
        $addCustomer->second_name = $fixture['second_name'];
        $addCustomer->phone = $fixture['phone'];
        $addCustomer->address = $fixture['address'];
        $addCustomer->email = $fixture['email'];
        $addCustomer->status = $fixture['status'];
        $addCustomer->parent_id = $fixture['parent_id'];
        $addCustomer->created_at = $fixture['created_at'];
        $addCustomer->modified_at = $fixture['modified_at'];
        if ($addCustomer->save()) {
            $this->assertTrue(true, $addCustomer->delete());   // Deleting customer
        }
    }

    /**
     * Test for create Customer entity
     */
    public function testCreateCustomer()
    {
        $customerFixture = $this->tester->grabFixture('customers', 'customer2');
        // insert records in database
        $this->tester->haveRecord('app\models\Customers',
            [
                'first_name' => $customerFixture['first_name'],
                'second_name' => $customerFixture['second_name'],
                'phone' => $customerFixture['phone'],
                'address' => $customerFixture['address'],
                'email' => $customerFixture['email'],
                'status' => $customerFixture['status'],
                'parent_id' => $customerFixture['parent_id'],
                'created_at' => $customerFixture['created_at'],
                'modified_at' => $customerFixture['modified_at']
            ]);

        // check records in database
        $this->tester->seeRecord('app\models\Customers',
            [
                'first_name' => $customerFixture['first_name'],
                'second_name' => $customerFixture['second_name'],
                'email' => $customerFixture['email']
            ]
        );
    }
}
