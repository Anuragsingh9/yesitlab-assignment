<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AudioService;

class AudioController extends Controller
{
    protected $audioService;

    public function __construct(AudioService $audioService)
    {
        $this->audioService = $audioService;
    }

    public function getLength(Request $request)
    {
        // Validate the uploaded file
        $request->validate([
            'audio_file' => 'required|file|mimes:mp3,wav', // Add more mime types if needed
        ]);

        // Get the uploaded file
        $audioFile = $request->file('audio_file');

        // Store the uploaded file (optional)
        $filePath = $audioFile->store('audio_files');

        // Get the length of the audio file
        $length = $this->audioService->getAudioLength($audioFile->getRealPath());

        return "The length of the audio file is: $length";
    }
}
