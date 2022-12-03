<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Events\BeforeSheet;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithDrawings;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

class BookingExport implements FromCollection,WithHeadings,WithHeadingRow,WithEvents,ShouldAutoSize
{
    public $data;
    /**
    * @return \Illuminate\Support\Collection
    */
    function __construct($data) 
    {
        $this->data = $data;
    }
    
    public function collection()
    {
        return  collect($this->data);
    }
    
        public function registerEvents(): array {
        $styleArray=['font'=>['bold'=>true,'size'=>12,],
               'borders' => [
               'allborders' => [
               'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
               'color' => ['argb' => 'FFFFFFFF'],],],];
        
        $styleArray1=['font'=>['size'=>23,],
           'borders' => [
           'allborders' => [
           'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
           'color' => ['argb' => 'FFFFFFFF'],],],];


       return [
           AfterSheet::class=> function(AfterSheet $event) use ($styleArray,$styleArray1) {

             $event->sheet->insertNewRowBefore(1, 2);
             $event->sheet->mergeCells('A1:P1');
             $event->sheet->mergeCells('A2:P2');
             $event->sheet->setCellValue('A1','GAMA ROOMS');
             $event->sheet->getStyle('A1')->applyFromArray($styleArray1);
             $event->sheet->getStyle('A2')->applyFromArray($styleArray);
             $event->sheet->getStyle('A1:P1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
             $event->sheet->getStyle('A1:P1')->getFill()->getStartColor()->setRGB('c755fb');
             $event->sheet->getStyle('A2:P2')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
             $event->sheet->getStyle('A2:P2')->getFill()->getStartColor()->setRGB('c755fb');
             $event->sheet->getStyle('A3:P3')->applyFromArray($styleArray);
             $event->sheet->getStyle('A3:P3')->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_BLACK);
             $event->sheet->getRowDimension('1')->setRowHeight(30);
             $event->sheet->getRowDimension('1')->setOutlineLevel(1);
             $event->sheet->getStyle('A3:P3')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
             $event->sheet->getStyle('A3:P3')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

             /*$event->sheet->getStyle('A2:G8')->applyFromArray($styleArray);*/
                        
          	},
       ];
   }

    public function headings(): array
    {
        return [
           'Agent',
		   'Location',
		   'Reference Id',
		   'API Reference',
		   'Hotel',
		   'Currency',
		   'Booking Amount',
		   'Commission',
		   'Status',
		   'Payment',
		   'Payment Mode',
		   'Payment Success',
		   'Booking Date',
		   'CheckIn & CheckOut',
		   'Cancellation Amount',
		   'Cancellation Date',
        ];
    }
}
