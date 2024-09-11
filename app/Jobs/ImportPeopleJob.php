<?php

namespace App\Jobs;

use App\Models\People;
use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class ImportPeopleJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $filePath;

    /**
     * Create a new job instance.
     *
     * @param string $filePath
     * @return void
     */
    public function __construct($filePath)
    {
        $this->filePath = $filePath;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $reader = ReaderEntityFactory::createXLSXReader();
        $reader->open($this->filePath);

        foreach ($reader->getSheetIterator() as $sheet) {
            foreach ($sheet->getRowIterator() as $row) {
                $cells = $row->getCells();

                // Skip the header row if necessary
                if ($cells[0]->getValue() == 'id') {
                    continue;
                }

                // Map the row data to the corresponding fields
                $data = [
                    'id'         => $cells[0]->getValue(),
                    'first_name' => $cells[1]->getValue(),
                    'last_name'  => $cells[2]->getValue(),
                    'email'      => $cells[3]->getValue(),
                    'gender'     => $cells[4]->getValue(),
                    'ip_address' => $cells[5]->getValue(),
                    'created_at' => now(),
                    'updated_at' => now(),
                ];

                // Insert into the database
                People::create($data);
            }
        }

        $reader->close();
        Log::info('People import completed.');
    }
}
