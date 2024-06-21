<?php

namespace Tests;

use Illuminate\Contracts\Console\Kernel;
<<<<<<< HEAD
use Illuminate\Foundation\Application;
=======
>>>>>>> DuongAn

trait CreatesApplication
{
    /**
     * Creates the application.
<<<<<<< HEAD
     */
    public function createApplication(): Application
=======
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
>>>>>>> DuongAn
    {
        $app = require __DIR__.'/../bootstrap/app.php';

        $app->make(Kernel::class)->bootstrap();

        return $app;
    }
}
