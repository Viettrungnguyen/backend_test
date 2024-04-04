<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class FolderComparisonController extends Controller
{
    public function compareFolders(Request $request)
    {
        $folderOnePath = $request->input('folder1');
        $folderTwoPath = $request->input('folder2');

        $folderOneFiles = collect(File::files($folderOnePath))->map(function ($file) {
            return pathinfo($file)['basename'];
        });

        $folderTwoFiles = collect(File::files($folderTwoPath))->map(function ($file) {
            return pathinfo($file)['basename'];
        });

        // Find common filenames
        $commonFiles = $folderOneFiles->intersect($folderTwoFiles);

        return response()->json(['common_files' => $commonFiles]);
    }
}
