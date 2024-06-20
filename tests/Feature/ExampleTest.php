<?php

it('returns a successful response', function () {
    $response = $this->get('/');

<<<<<<< HEAD
    $response->assertStatus(200);
});
=======
// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
<<<<<<< HEAD
     */
    public function test_the_application_returns_a_successful_response(): void
=======
     *
     * @return void
     */
    public function test_the_application_returns_a_successful_response()
>>>>>>> DuongAn
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
>>>>>>> merged-branch
