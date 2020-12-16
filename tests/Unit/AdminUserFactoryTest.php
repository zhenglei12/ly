<?php

namespace Cherish\Ly\Tests\Unit;


use Cherish\Ly\AdminUserFactory;
use Cherish\Ly\Models\AdminUser;
use Cherish\Ly\Tests\TestCase;

class AdminUserFactoryTest extends TestCase
{
    protected function setUp(): void
    {
        $this->setUpTheTestEnvironment();
    }

    public function test_if_it_is_admin_user()
    {
        $model = AdminUserFactory::adminUser();

        $this->assertInstanceOf(AdminUser::class, $model);
    }
}