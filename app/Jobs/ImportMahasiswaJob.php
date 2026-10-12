<?php

namespace App\Jobs;

use App\Imports\MahasiswaImport;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Maatwebsite\Excel\Facades\Excel;

class ImportMahasiswaJob implements ShouldQueue
{
    use Queueable;

    public function __construct(
        public string $filePath
    ) {
    }

    public function handle(): void
    {
        Excel::import(
            new MahasiswaImport,
            $this->filePath
        );
    }
}
