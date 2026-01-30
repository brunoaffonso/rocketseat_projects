<?php

namespace App\Http\Controllers;

use App\Models\CampaignMail;
use Illuminate\Http\Request;

class TrackController extends Controller
{
    public function open(string $uuid)
    {
        $mail = CampaignMail::where('uuid', $uuid)->first();

        if ($mail) {
            $mail->increment('openings');
        }

        // Return a 1x1 transparent GIF
        return response(base64_decode('R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7'), 200, [
            'Content-Type' => 'image/gif',
            'Cache-Control' => 'no-cache, no-store, must-revalidate',
            'Pragma' => 'no-cache',
            'Expires' => '0',
        ]);
    }

    public function click(string $uuid, Request $request)
    {
        $mail = CampaignMail::where('uuid', $uuid)->first();

        if ($mail) {
            $mail->increment('clicks');
        }

        $url = $request->query('url');

        if (! $url) {
            return redirect('/');
        }

        return redirect($url);
    }
}
