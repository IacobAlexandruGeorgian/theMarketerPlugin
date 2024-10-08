<?php

namespace UserActivityLogger;

class ActivityLogger
{
    public function trackEvent($data)
    {
        $eventData = [
            'user_name' => $data['user_name'],
            'page' => $data['page'],
            'event_description' => $data['event_description'],
            'timestamp' => now()->toDateTimeString()
        ];

        $csvFile = storage_path('logs/user_activity_log.csv');

        if (!file_exists($csvFile)) {
            $header = ['User Name', 'Page', 'Event description', 'Timestamp'];
            file_put_contents($csvFile, implode(',', $header) . "\n", FILE_APPEND);
        }

        file_put_contents($csvFile, implode(',', $eventData) . "\n", FILE_APPEND);

        return response()->json(['status' => 'Event logged'], 200);
    }
}
