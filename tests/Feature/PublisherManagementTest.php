<?php

namespace Tests\Feature;

use App\Models\Publisher;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PublisherManagementTest extends TestCase
{
    use RefreshDatabase;
    /**
     * @test
     */
    public function a_publisher_can_be_created()
    {

        $this->withoutExceptionHandling();

        $this->post('/publisher', [
            'fname' => 'Jason',
            'sname' => 'brown',
            'dob' => '05/14/1990'
        ]);

        $this->assertCount(1, Publisher::all());
    }
}
