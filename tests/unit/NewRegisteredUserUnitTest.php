<?php

use App\Events\NewUserWasRegistered;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class NewUserWasRegisteredUnitTest extends TestCase
{
    use DatabaseTransactions;
    use CreateUser, CreateContact;

    /**
     * @covers App\Events\NewUserWasRegistered::__construct
     * @test
     */
    public function it_fires_event_and_links_user()
    {
        $user = $this->createUser(['email' => 'guest@example.org', 'password' => bcrypt('demoguest')]);

        event(new NewUserWasRegistered($user));
    }

    /**
     * @covers App\Events\NewUserWasRegistered::broadcastOn
     * @test
     */
    public function it_verifies_broadcasts_on()
    {
        $user = $this->createUser(['email' => 'guest@example.org', 'password' => bcrypt('demoguest')]);

        $event = new NewUserWasRegistered($user);

        $this->assertEquals([], $event->broadcastOn());
    }
}
