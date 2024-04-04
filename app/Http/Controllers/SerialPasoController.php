<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SerialPasoController extends Controller
{
    public function show(Request $request)
    {
        $file = $request->input('file');
        $appEnv = $request->input('app_env');
        $contractServer = $request->input('contract_server');

        // Construct file path based on parameters
        $filePath = "C:/imprints_html_file/{$this->getAppEnvName($appEnv)}/{$this->getContractServerName($contractServer)}/{$file}.html";

        // Check if the file exists
        if (!File::exists($filePath)) {
            return response()->json([
                'success' => false,
                'FileName' => "",
                'message' => 'Seal Info response false'
            ], 404);
        }

        // Read HTML content from file
        $content = File::get($filePath);

        // Encode content to base64
        $encodedContent = base64_encode($content);

        return response()->json([
            'success' => true,
            'filename' => basename($filePath),
            'content' => $encodedContent,
            'message' => 'Seal Info response successfully'
        ]);
    }

    private function getAppEnvName($appEnv)
    {
        $names = ['AWS', 'K5', 'T2'];
        return $names[$appEnv] ?? '';
    }

    private function getContractServerName($contractServer)
    {
        $names = ['app1', 'app2'];
        return $names[$contractServer] ?? '';
    }
}
