<?php

namespace Tests\Unit;

use App\Models\User;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\Test;

class UserTest extends TestCase
{
    #[Test]
    public function check_if_user_colums()
    {
        $expected = [
            'name',
            'email',
            'password'
        ];
        $user = new User();
        $this->assertEquals($expected, $user->getFillable());
    }
}
