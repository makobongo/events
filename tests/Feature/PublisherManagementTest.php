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

        $this->post('/publisher', [
            'fname' => 'Jason',
            'sname' => 'brown',
            'dob' => '05/14/1990'
        ]);

        $this->assertCount(1, Publisher::all());
    }

    /**
     * @test
     */
    public function publisher_first_and_second_name_is_required()
    {
        $response = $this->post('/publisher', [
            'fname' => '',
            'sname' => ''
        ]);
        $response->assertSessionHasErrors(['fname', 'sname']);
    }

    /**
     * @test
     */
    public function publisher_can_be_updated()
    {
        $this->post('/publisher', [
            'fname' => 'Jason',
            'sname' => 'brown',
            'dob' => '05/14/1990'
        ]);

        $publisher = Publisher::first();
        $this->patch("/publisher/" . $publisher->id, [
            'fname' => 'osteve',
            'sname' => 'makobongo',
            'dob' => '05/14/1900'
        ]);

        $this->assertEquals('osteve', Publisher::first()->fname);
        $this->assertEquals('makobongo', Publisher::first()->sname);

    }
}
