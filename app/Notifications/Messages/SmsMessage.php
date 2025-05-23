<?php

namespace App\Notifications\Messages;

use Exception;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SmsMessage extends Notification
{
    protected string $baseUrl;

    protected string $sender;

    protected string $pattern;

    protected string $apiKey;

    protected string $to;

    protected string $level;

    public function __construct(array $lines = [])
    {
        $this->baseUrl = config('services.farazsms.endpoint');
        $this->sender = config('services.farazsms.sender');
        $this->pattern = config('services.farazsms.pattern');
        $this->apiKey = config('services.farazsms.api_key');
    }

    public function to(string $to): self
    {
        $this->to = $to;

        return $this;
    }

    public function level(string $level): self
    {
        $this->level = $level;

        return $this;
    }

    public function send(): bool
    {
        if (! $this->sender || ! $this->to) {
            throw new Exception('SMS not correct.');
        }

        $payload = [
            'code' => $this->pattern,
            'sender' => $this->sender,
            'recipient' => $this->to,
            'variable' => [
                'level' => $this->level,
            ],
        ];

        $headers = [
            'Accepts' => 'application/json',
            'Content-Type' => 'application/json',
            'apikey' => $this->apiKey,
        ];

        try {
            $response = Http::timeout(120)->withHeaders($headers)->post("$this->baseUrl/sms/pattern/normal/send", $payload)->json();

            if ($response['status'] !== 'OK') {
                throw new Exception($response['error_message']);
            }

            return true;

        } catch (Exception $e) {
            Log::error('Error in sms service . Exception', ['error' => $e->getMessage()]);

            return false;
        }
    }
}
