<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use RuntimeException;

class DocumentsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $validatedData;

    /**
     * Create a new job instance.
     */
    public function __construct($data)
    {
        $this->validatedData = $data;        
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try{

        }catch(\Exception $e){
            throw new RuntimeException("Failed to process job. " . $e->getMessage());
        }
    }
}
