<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class UserTest extends TestCase
{
    use DatabaseTransactions;
   
    public function test_if_user()  
    {
        $response = $this->getJson('/api/users/');
        $response->assertSuccessful();
    }

    public function test_if_user_saving_successful()  
    {
        $data = User::factory()->make()->getAttributes();
        $data['password'] = 'asdfasdf';
        $data['password_confirmation'] = 'asdfasdf';

        $response = $this->postJson('/api/users/',$data);
        $response->assertSuccessful();
    }

    public function test_if_user_update_successful()  
    {
        $data = User::factory()->create();
        $dataUpdate = ['name'=>fake()->name()];

        $response = $this->putJson('/api/users/'.$data->id, $dataUpdate);
        $response->assertSuccessful();
    }

    public function test_if_user_find_successful()  
    {
        $data = User::factory()->create();
        $response = $this->getJson('/api/users/'.$data->id);
        $response->assertSuccessful();
    }

    public function test_if_user_find_not_found()  
    {
        $data = User::factory()->create();
        $response = $this->deleteJson('/api/users/'.$data->id);

        $response = $this->getJson('/api/users/'.$data->id);
        $response->assertNotFound();
    }

    public function test_if_user_name_size_min_validation()  
    {
        $data = User::factory()->make(['name'=>'jo'])->getAttributes();
        $data['password'] = 'asdfasdf';
        $data['password_confirmation'] = 'asdfasdf';

        $response = $this->postJson('/api/users/',$data);
        $response->assertUnprocessable();
    }

    public function test_if_user_name_size_max_validation()  
    {
        $data = User::factory()->make(['name'=>fake()->realTextBetween(51)])->getAttributes();
        $data['password'] = 'asdfasdf';
        $data['password_confirmation'] = 'asdfasdf';

        $response = $this->postJson('/api/users/',$data);
        $response->assertUnprocessable();
    }

    public function test_if_user_password_validation()  
    {
        $data = User::factory()->make()->getAttributes();
        $data['password'] = 'asdfasdf';
        $data['password_confirmation'] = '12345';

        $response = $this->postJson('/api/users/',$data);
        $response->assertUnprocessable();
    }

    public function test_if_user_password_confirmation_null_validation()  
    {
        $data = User::factory()->make()->getAttributes();
        $data['password'] = 'asdfasdf';

        $response = $this->postJson('/api/users/',$data);
        $response->assertUnprocessable();
    }

    public function test_if_user_email_invalid_validation()  
    {
        $data = User::factory()->make(['email'=>'john.doe'])->getAttributes();
        $data['password'] = 'asdfasdf';
        $data['password_confirmation'] = 'asdfasdf';

        $response = $this->postJson('/api/users/',$data);
        $response->assertUnprocessable();
    }
}
