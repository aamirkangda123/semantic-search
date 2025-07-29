<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Keyword;
use App\Services\VectorService;

class ImportKeywords extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:keywords';
   

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import keywords from Excel and store embeddings';

    /**
     * Execute the console command.
     */
    public function handle()
    {
         $filePath = storage_path('app/Lynx_Keyword_Enhanced_Services.xlsx');
        $rows = Excel::toCollection(null, $filePath)[0];

        $vectorService = new VectorService();

        foreach ($rows as $index => $row) {
            if ($index === 0 || empty($row[2])) continue;

            $record = Keyword::firstOrCreate([
                'category'    => $row[0],
                'subcategory' => $row[1],
                'keyword'     => $row[2],
            ]);

            if (!$record->embedding) {
                $embedding = $vectorService->getEmbedding($row[2]);
                $record->embedding = $embedding;
                $record->save();
            }
        }

        $this->info('Keywords imported with embeddings.');
    }
}
