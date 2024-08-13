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
    public function events_can_be_added()
    {
        $response = $this->post('/events', [
            'title' => 'meeting on the lakeside',
            'publisher' => 'makobongo'
        ]);
        $this->assertCount(1, Event::all());
        $response->assertRedirect('/events');
    }

    /**
     * @test
     */
    public function a_title_is_required()
    {
        $response = $this->post('/events', [
            'title' => '',
            'publisher' => 'james hendrix'
        ]);
        $response->assertSessionHasErrors('title');
    }

    /**
     * @test
     */
    public function a_publisher_is_required()
    {
        $response = $this->post('/events', [
            'title' => 'meetings in the hotel on 4th',
            'publisher' => ''
        ]);
        $response->assertSessionHasErrors('publisher');
    }

    /**
     * @test
     */
    public function event_can_be_updated()
    {
        $this->post('/events', [
            'title' => 'one more',
            'publisher' => 'Tom Okeyo'
        ]);
        $event = Event::first();
        $response = $this->patch('/events/' . $event->id, [
            'title' => 'second more',
            'publisher' => 'Valary Ogada'
        ]);

        $this->assertEquals('second more', Event::first()->title);
        $this->assertEquals('Valary Ogada', Event::first()->publisher);

        $response->assertRedirect('/events/' . $event->id);
    }

    /**
     * @test
     */
    public function event_can_be_deleted()
    {
        $this->post('/events', [
            'title' => 'one more',
            'publisher' => 'Tom Okeyo'
        ]);
        $this->assertCount(1, Event::all());
        $event = Event::first();
        $response = $this->delete('/events/' . $event->id);
        $this->assertCount(0, Event::all());
        $response->assertRedirect('/events');
    }
}
