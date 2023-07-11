<?php

namespace App\Jobs;

use App\Models\Category;
use App\Models\Documents;
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

    protected $documentInfo;

    /**
     * Create a new job instance.
     */
    public function __construct($data)
    {
        $this->documentInfo = $data;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            // Pesquisa a categoria pelo nome, se não encontrar irá criar uma nova
            $category = Category::firstOrCreate(
                ['name' => $this->documentInfo['category']]
            );

            // Realiza a pesquisa e previne a criação de duplicatas
            Documents::firstOrCreate([
                'category_id' => $category->id,
                'title' => $this->documentInfo['title'],
                'contents' =>  $this->documentInfo['contents'],
                'reference' => $this->documentInfo['reference'],
            ]);
        } catch (\Exception $e) {
            throw new RuntimeException("Failed to process job. " . $e->getMessage());
        }
    }
}
