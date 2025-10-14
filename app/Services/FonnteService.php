<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class FonnteService
{
    protected $token;
    protected $url;

    public function __construct()
    {
        $this->token = config('fonnte.token');
        $this->url = 'https://api.fonnte.com/send';
    }

    /**
     * Kirim pesan WhatsApp melalui Fonnte.
     *
     * @param string $target Nomor tujuan
     * @param string $message Isi pesan
     * @return bool
     */
    public function sendMessage(string $target, string $message): bool
    {
        if (!$this->token) {
            Log::error('Fonnte token is not set.');
            return false;
        }

        // Pastikan nomor telepon dalam format yang benar (tanpa +, spasi, atau -)
        $target = preg_replace('/[^0-9]/', '', $target);

        try {
            $response = Http::withHeaders([
                'Authorization' => $this->token,
            ])->post($this->url, [
                'target' => $target,
                'message' => $message,
            ]);

            if ($response->successful()) {
                Log::info('Message sent successfully to ' . $target);
                return true;
            } else {
                Log::error('Failed to send message to ' . $target . ': ' . $response->body());
                return false;
            }
        } catch (\Exception $e) {
            Log::error('Exception while sending message to ' . $target . ': ' . $e->getMessage());
            return false;
        }
    }
}
