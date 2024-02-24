<?php

namespace App\Services;

use getID3;

class AudioService
{
    public function getAudioLength($filePath)
    {
        // Initialize getID3
        $getID3 = new getID3();

        // Analyze the audio file
        $fileInfo = $getID3->analyze($filePath);

        // Get the duration in seconds
        $durationSeconds = $fileInfo['playtime_seconds'];

        // Convert duration to hours, minutes, and seconds
        $hours = floor($durationSeconds / 3600);
        $minutes = floor(($durationSeconds / 60) % 60);
        $seconds = $durationSeconds % 60;

        // Format the duration
        $formattedDuration = sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);

        return $formattedDuration;
    }
}
