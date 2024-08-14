<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Models\Event;
use Tests\TestCase;

class EventsManagementTest extends TestCase
{
    use RefreshDatabase;
    /**
     * @test
     */
    public function events_can_be_added()
    {
        $response = $this->post('/events', $this->eventsData());
        $this->assertCount(1, Event::all());
        $response->assertRedirect('/events');
    }

    /**
     * @test
     */
    public function a_title_is_required()
    {
        $response = $this->post('/events', array_merge($this->eventsData(), ['title'=>'']));
        $response->assertSessionHasErrors('title');
    }

    /**
     * @test
     */
    public function a_publisher_is_required()
    {
        $response = $this->post('/events', array_merge($this->eventsData(), ['publisher'=>'']));
        $response->assertSessionHasErrors('publisher');
    }

    /**
     * @test
     */
    public function event_can_be_updated()
    {
        $this->post('/events', $this->eventsData());
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
        $this->post('/events', $this->eventsData());
        $this->assertCount(1, Event::all());
        $event = Event::first();
        $response = $this->delete('/events/' . $event->id);
        $this->assertCount(0, Event::all());
        $response->assertRedirect('/events');
    }

    private function eventsData(){
        return [
            'title' => 'one more',
            'publisher' => 'Tom Okeyo'
        ];
    }
}
