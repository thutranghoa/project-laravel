<?php

<<<<<<< HEAD
test('that true is true', function () {
    expect(true)->toBeTrue();
});
=======
namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
<<<<<<< HEAD
     */
    public function test_that_true_is_true(): void
=======
     *
     * @return void
     */
    public function test_that_true_is_true()
>>>>>>> DuongAn
    {
        $this->assertTrue(true);
    }
}
>>>>>>> merged-branch
