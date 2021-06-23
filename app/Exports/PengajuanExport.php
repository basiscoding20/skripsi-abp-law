<?php

namespace App\Exports;

use App\Models\File;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class PengajuanExport implements FromView, WithEvents, ShouldAutoSize
{
    protected $status;
    protected $category;

   function __construct($status, $category)
    {
        $this->status = $status;
        $this->category = $category;
    }
    public function registerEvents(): array
    {
        //MEMANIPULASI CELL
        return [
            AfterSheet::class    => function (AfterSheet $event) {
                //DEFINISIKAN STYLE UNTUK CELL
                $styleArray = [
                    'font' => [
                        'bold' => true,
                    ],
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                    ],
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        ],
                    ],
                    'fill' => [
                        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                        'rotation' => 90,
                        'startColor' => [
                            'argb' => '89f0e3',
                        ],
                    ],
                ];

                $styleBorders = [
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        ],
                    ],
                ];
                $style = [
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    ]
                ];
                //AKAN DI-MERGE
                $event->sheet->mergeCells('B1:J1');

                //MENGGUNBKBN STYLE DARI $style
                $event->sheet->getStyle('B1:J1')->applyFromArray($style);

                //MENGGUNAKAN STYLE DARI $styleArray
                $event->sheet->getStyle('B3:J3')->applyFromArray($styleArray);

                $status = $this->status;
                $category = $this->category;
                if(!empty($status) || !empty($category))
                {
                    $laporan = File::when($status, function ($query) use ($status) {
                        $query->where('status', $status);
                    })->when($category, function ($query) use ($category) {
                        $query->where('category_id', $category);
                    })->latest()->get();
                    
                }else{
                    $laporan = File::whereIn('status', [1,2])->latest()->get();
                }
                $k = 4;
                if (count($laporan) > 0) {
                    foreach ($laporan as $db) {
                        $event->sheet->getStyle('B' . $k . ':J'. $k)->applyFromArray($styleBorders);
                        $k++;
                    }
                } 
 
            },
        ];
    }

    public function view(): View
    {
        $status = $this->status;
        $category = $this->category;
        if(!empty($status) || !empty($category))
        {
            $laporan = File::when($status, function ($query) use ($status) {
                $query->where('status', $status);
            })->when($category, function ($query) use ($category) {
                $query->where('category_id', $category);
            })->latest()->get();
            
        }else{
            $laporan = File::whereIn('status', [1,2])->latest()->get();
        }
        return view('admin.laporan.export', compact('laporan'));
    }
}
