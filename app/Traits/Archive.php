<?php

namespace App\Traits;

use ZipArchive;
use Illuminate\Support\Facades\File;

trait Archive
{
    function extract($fileRealPath, $folderName)
    {
        try {
            $zip = new ZipArchive();
            $status = $zip->open($fileRealPath);
            if ($status !== true) {
                throw new \Exception($status);
            } else {
                $storageDestinationPath = public_path("3d/" . $folderName . "/");

                if (!File::exists($storageDestinationPath)) {
                    File::makeDirectory($storageDestinationPath, 0755, true);
                }

                $zip->extractTo($storageDestinationPath);
                $zip->close();
                return $zip;
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
