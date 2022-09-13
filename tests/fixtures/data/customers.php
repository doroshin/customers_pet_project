<?php

$time = time();

return [
    'customer1' => [
        'first_name' => 'TestFirstName1',
        'second_name' => 'TestSecondName1',
        'phone' => '0999999999',
        'address' => 'some test address 1',
        'email' => 'TestSecondName1@nomail.com',
        'status' => 1,
        'parent_id' => 1,
        'created_at' => $time,
        'modified_at' => $time,
    ],
    'customer2' => [
        'first_name' => 'TestSecondName2',
        'second_name' => 'TestSecondName2',
        'phone' => '0555555555',
        'address' => 'some test address 2',
        'email' => 'TestSecondName2@nomail.com',
        'status' => 0,
        'parent_id' => null,
        'created_at' => $time,
        'modified_at' => $time,
    ]
];
