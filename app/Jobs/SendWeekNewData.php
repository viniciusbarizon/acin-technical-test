<?php

namespace App\Jobs;

use App\Mail\WeekNewData;
use App\Models\Brand;
use App\Models\UserRole;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendWeekNewData implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $reporters;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->storeExcel();

        $this->setReporters();
        $this->sendEmail();
    }

    private function storeExcel(): void
    {
        Brand::whereBetween('created_at', [now()->subWeek()->format('Y-m-d H:i:s'), now()])
            ->get()
            ->storeExcel('excel/week-new-data.xlsx');
    }

    private function setReporters(): void
    {
        $this->reporters = UserRole::where('role', 'reporter')->first()->users;
    }

    private function sendEmail(): void
    {
        foreach ($this->reporters as $reporter) {
            Mail::to($reporter->email)
                ->send(new WeekNewData);
        }
    }
}
