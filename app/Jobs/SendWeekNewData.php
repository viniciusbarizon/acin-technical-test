<?php

namespace App\Jobs;

use App\Models\Brand;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Maatwebsite\Excel\Facades\Excel;

class SendWeekNewData implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct() {}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->storeExcel();
    }

    private function storeExcel(): void
    {
        Brand::whereBetween('created_at', [now()->subWeek()->format("Y-m-d H:i:s"), now()])
            ->get()
            ->storeExcel('excel/week-new-data.xlsx');
    }

    private function sendEmail(): void
    {

    }
}
