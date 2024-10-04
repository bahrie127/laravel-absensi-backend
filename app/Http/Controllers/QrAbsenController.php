<?php

namespace App\Http\Controllers;

use App\Models\QrAbsen;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
// use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;

class QrAbsenController extends Controller
{
    protected function generateQRCodeCheckin()
    {
        do {
            $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
            $code = substr(str_shuffle($characters), 0, 6);
        } while (QrAbsen::where('qr_checkin', $code)->exists()); // Memeriksa apakah kode sudah ada

        return $code;
    }

    private function generateQrCode($data)
    {
        $qrCode = QrCode::create($data)
            ->setSize(200)
            ->setMargin(10);

        $writer = new PngWriter();
        $result = $writer->write($qrCode);

        return base64_encode($result->getString());
    }

    protected function generateQRCodeCheckout()
    {
        do {
            $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
            $code = substr(str_shuffle($characters), 0, 6);
        } while (QrAbsen::where('qr_checkout', $code)->exists()); // Memeriksa apakah kode sudah ada

        return $code;
    }


    public function index(Request $request){
        $qrAbsen = QrAbsen::when($request->input('name'), function ($query, $name) {
            $query->whereHas('user', function ($query) use ($name) {
                $query->where('name', 'like', '%' . $name . '%');
            });
        })->orderBy('id', 'desc')->paginate(10);
        return view('pages.qr_absen.index', compact('qrAbsen'));
    }

    public function show($id){
        $qrAbsen = QrAbsen::find($id);
        return view('pages.qr_absen.show', compact('qrAbsen'));
    }

    public function create(){
        return view('pages.qr_absen.create');
    }

    public function downloadPDF($id)
    {
        $qrAbsen = QrAbsen::findOrFail($id);

        // Generate QR codes as base64 images
        $qrCodeCheckin = $this->generateQrCode($qrAbsen->qr_checkin);
        $qrCodeCheckout = $this->generateQrCode($qrAbsen->qr_checkout);

        $data = [
            'qrAbsen' => $qrAbsen,
            'qrCodeCheckin' => $qrCodeCheckin,
            'qrCodeCheckout' => $qrCodeCheckout,
        ];

        $pdf = Pdf::loadView('pdf.qr_absen', $data);

        // $pdf = PDF::loadView('pdf.qr_absen', compact('qrAbsen'));

        return $pdf->download('qr_absen_' . $qrAbsen->date . '.pdf');
    }

    public function store(Request $request){
        $request->validate([
            'month' => 'required|date_format:Y-m',
        ]);

        $month = Carbon::createFromFormat('Y-m', $request->month);
        $daysInMonth = $month->daysInMonth;

        for ($day = 1; $day <= $daysInMonth; $day++) {
            $date = $month->copy()->setDay($day);

            QrAbsen::create([
                'date' => $date->format('Y-m-d'),
                'qr_checkin' => $this->generateQRCodeCheckin(),
                'qr_checkout' => $this->generateQRCodeCheckout(),
            ]);
        }

        return redirect()->route('qr_absen.index')->with('success', 'QR codes generated successfully for ' . $month->format('F Y'));
    }
}
