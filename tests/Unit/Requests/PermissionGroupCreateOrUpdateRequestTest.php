<?php

namespace Cherish\Ly\Tests\Unit\Requests;


use Cherish\Ly\Http\Requests\PermissionGroup\CreateOrUpdateRequest;
use Cherish\Ly\Tests\TestCase;
use Validator;

class PermissionGroupCreateOrUpdateRequestTest extends TestCase
{
    public function test_create_or_update_form_request()
    {
        $request = new CreateOrUpdateRequest();

        $attributes = [
            'name' => 'name'
        ];

        $validator = Validator::make($attributes, $request->rules());

        $this->assertEquals(false, $validator->fails());

        $validator = Validator::make([], $request->rules());

        $this->assertEquals(true, $validator->fails());
    }
}