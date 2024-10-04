<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\QrAbsen;
use Illuminate\Http\Request;

class QrAbsenController extends Controller
{
    public function checkQR(Request $request){

        $request->validate([
            'qr_code' => 'required',
            'date'=> 'required|date_format:Y-m-d',
            'type_qr' => 'required|in:qr_checkin,qr_checkout',
        ]);

        $QrAbsen = QrAbsen::where('date', $request->date)->first();
        if (!$QrAbsen) {
            return response()->json([
                'success' => false,
                'status_code' => 404,
                'message' => 'QR Absen not found for the given date',
                'is_valid' => false,
            ]);
        }
        if ($request->type_qr == 'qr_checkin') {
            if ($request->qr_code == $QrAbsen->qr_checkin) {
                return response()->json([
                    'success' => true,
                    'status_code' => 200,
                    'message' => 'QR code is valid',
                    'is_valid' => true,
                ]);
            } else{
                return response()->json([
                    'success' => false,
                    'status_code' => 400,
                    'message' => 'QR code is not valid',
                    'is_valid' => false,
                ]);
            }
        } elseif ($request->type_qr == 'qr_checkout') {

            if ($request->qr_code == $QrAbsen->qr_checkout) {
                return response()->json([
                    'success' => true,
                    'status_code' => 200,
                    'message' => 'QR code is valid',
                    'is_valid' => true,
                ]);
            } else{
                return response()->json([
                    'success' => false,
                    'status_code' => 400,
                    'message' => 'QR code is not valid',
                    'is_valid' => false,
                ]);
            }

        }


    }
}
