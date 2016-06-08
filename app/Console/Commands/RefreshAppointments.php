<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class RefreshAppointments extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'refreshappointments';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command is made the refresh the appointments database weekly, and to parse data in mySQL, replacing some tables content.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */

    public function handle()
    {
    
}
