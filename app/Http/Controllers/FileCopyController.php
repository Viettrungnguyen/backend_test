<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class FileCopyController extends Controller
{
    public function copyFile(Request $request)
    {
        $sourcePath = 'C:/imprints_html_file/AWS/app1/hhss.html';
        $destinationFolder1 = 'C:/imprints_html_file/compare-folders/folder1';
        $destinationFolder2 = 'C:/imprints_html_file/compare-folders/folder2';

        // Check if the source file exists
        if (!File::exists($sourcePath)) {
            return response()->json([
                'success' => false,
                'message' => 'Source file not found'
            ], 404);
        }

        // Copy the file 100 times to folder1
        for ($i = 1; $i <= 100; $i++) {
            $newFilename = 'hhss_' . $i . '.html';
            $destinationPath = $destinationFolder1 . '/' . $newFilename;
            File::copy($sourcePath, $destinationPath);
        }

        // Copy the file 100 times to folder2
        for ($i = 1; $i <= 100; $i++) {
            $newFilename = 'hhss_' . $i . '.html';
            $destinationPath = $destinationFolder2 . '/' . $newFilename;
            File::copy($sourcePath, $destinationPath);
        }

        return response()->json([
            'success' => true,
            'message' => 'Files copied successfully'
        ]);
    }
}
