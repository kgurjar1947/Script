<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Models\CheckURL;
use Carbon\Carbon;



class DemoCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'DemoCron';

    public function handle()
    {
  /*  Run your task here */
  $minutes  = Carbon::now();
  CheckURL::where('date', '<=', $minutes)->where('time', '<=', $minutes)->delete();
  

}
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';


   
    /**
     * Execute the console command.
     *
     * @return int
     */
  
}
