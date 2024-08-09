<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Models\Event;
use Tests\TestCase;

class EventsReservationTest extends TestCase
{
    use RefreshDatabase;
    /**
     * @test
     */
    public function event_can_be_added_to_calender()
    {

        $this->withoutExceptionHandling();
        $response = $this->post('/events', [
            'title' => 'meeting on the lakeside',
            'publisher' => 'makobongo'
        ]);
        $response->assertOk();
        $this->assertCount(1, Event::all());
    }

    /**
     * @test
     */
    // public function a_title_is_required()
    // {
    //     $this->withoutExceptionHandling();

    //     $response = $this->post('/events', [
    //         'title' => '',
    //         'publisher' => 'makobongo'
    //     ]);
    //     $response->assertSessionHasErrors();
    // }
}
