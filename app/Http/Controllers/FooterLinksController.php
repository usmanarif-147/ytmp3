<?php

namespace App\Http\Controllers;

use App\Models\YadLink;
use App\Models\YtmLink;
use Exception;
use Illuminate\Http\Request;

class FooterLinksController extends Controller
{

    public function getYtmLink(Request $request)
    {
        try {
            $ytmLink = YtmLink::first();
            if ($ytmLink) {
                return response()->json(['link' => $ytmLink->link]);
            }
            return response()->json(['link' => '']);
        } catch (Exception $ex) {
            return response()->json(['success' => $ex->getMessage()]);
        }
    }

    public function getYadLink(Request $request)
    {
        try {
            $yatLink = YadLink::first();
            if ($yatLink) {
                return response()->json(['link' => $yatLink->link]);
            }
            return response()->json(['link' => '']);
        } catch (Exception $ex) {
            return response()->json(['success' => $ex->getMessage()]);
        }
    }

    public function setYtmLink(Request $request)
    {
        try {
            $ytmLink = YtmLink::first();
            if ($ytmLink) {
                YtmLink::where('id', $ytmLink->id)->update([
                    'link' => $request->link
                ]);
            } else {
                YtmLink::create([
                    'link' => $request->link
                ]);
            }
            return response()->json(['success' => 'YouTubeToMP3 Url set Successfully']);
        } catch (Exception $ex) {
            return response()->json(['success' => $ex->getMessage()]);
        }
    }

    public function setYadLink(Request $request)
    {
        try {
            $yatLink = YadLink::first();
            if ($yatLink) {
                YadLink::where('id', $yatLink->id)->update([
                    'link' => $request->link
                ]);
            } else {
                YadLink::create([
                    'link' => $request->link
                ]);
            }
            return response()->json(['success' => 'YouTube Audio Downloader Url set Successfully']);
        } catch (Exception $ex) {
            return response()->json(['success' => $ex->getMessage()]);
        }
    }
}
