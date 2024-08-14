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

        $this->post('/publisher', $this->publisherData());

        $this->assertCount(1, Publisher::all());
    }

    /**
     * @test
     */
    public function publisher_first_and_second_name_is_required()
    {
        $response = $this->post('/publisher', array_merge($this->publisherData(), ['fname'=>'','sname'=>'']));
        $response->assertSessionHasErrors(['fname', 'sname']);
    }

    /**
     * @test
     */
    public function publisher_can_be_updated()
    {
        $this->post('/publisher', $this->publisherData());

        $publisher = Publisher::first();
        $response = $this->patch("/publisher/" . $publisher->id, [
            'fname' => 'osteve',
            'sname' => 'makobongo',
            'dob' => '05/14/1900'
        ]);

        $this->assertEquals('osteve', Publisher::first()->fname);
        $this->assertEquals('makobongo', Publisher::first()->sname);
        $response->assertRedirect('/publisher/' . $publisher->id);
    }

    /**
     * test
     */
    private function publisherData()
    {
        return [
            'fname' => 'Jason',
            'sname' => 'brown',
            'dob' => '05/14/1990'
        ];
    }
}
