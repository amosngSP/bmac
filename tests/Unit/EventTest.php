<?php

namespace Tests\Unit;

use App\Models\Event;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;

class EventTest extends TestCase
{

    use RefreshDatabase;

    /**
     * Test if a event can be added
     *
     * @return void
     */
    public function testItCreatesNewEvent()
    {
        $name = 'Amsterdam - Eelde Fly-In';
        $description = 'Si, Fly';
        $startEvent = now()->addMonth()->toDateTimeString();
        $endEvent = now()->addMonth()->addHours(3)->toDateTimeString();
        $startBooking = now()->addWeek()->toDateTimeString();
        $endBooking = now()->subDay()->toDateTimeString();

        Event::create([
            'name' => $name,
            'description' => $description,
            'startEvent' => $startEvent,
            'endEvent' => $endEvent,
            'startBooking' => $startBooking,
            'endBooking' => $endBooking,
        ]);

        $this->assertDatabaseHas('events', [
            'name' => $name,
            'description' => $description,
            'startEvent' => $startEvent,
            'endEvent' => $endEvent,
            'startBooking' => $startBooking,
            'endBooking' => $endBooking,
        ]);
    }
}
