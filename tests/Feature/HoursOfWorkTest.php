<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HoursOfWorkTest extends TestCase
{
    /** @test */
    public function login()
    {
        $response = $this->post('/api/login', ['email' => 'PSexvzwzBN@gmail.com', 'password' => '123456']);
        $response->assertCookie('token');
        $token = $response->headers->getCookies()[0]->getValue();
        $res1 = $this->withHeader('Authorization', 'Bearer ' . $token)->get('/api/total_hours_of_work_per_month');
        $res1->assertOk();
        $res2 = $this->withHeader('Authorization', 'Bearer ' . $token)->get('/api/total_hours_of_work_per_day');
        $res2->assertOk();
        $res3 = $this->withHeader('Authorization', 'Bearer ' . $token)->get('/api/total_hours_of_work_per_project/1');
        $res3->assertOk();
    }
}
