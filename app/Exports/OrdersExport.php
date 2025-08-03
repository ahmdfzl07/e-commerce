<?php

namespace App\Exports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class OrdersExport implements FromCollection, WithHeadings, WithMapping, WithEvents
{
    protected $bulan;
    protected $data;
    protected $total;

    public function __construct($bulan)
    {
        $this->bulan = $bulan;
    }

    public function collection()
    {
        $query = Order::query();

        if ($this->bulan) {
            $query->whereYear('created_at', substr($this->bulan, 0, 4))
                  ->whereMonth('created_at', substr($this->bulan, 5, 2));
        }

        $this->data = $query->get(['invoice', 'customer_name', 'customer_address', 'subtotal', 'created_at']);
        $this->total = $this->data->sum('subtotal');

        return $this->data;
    }

    public function headings(): array
    {
        return [
            'Invoice',
            'Nama Customer',
            'Alamat',
            'Subtotal',
            'Tanggal',
        ];
    }

    public function map($row): array
    {
        return [
            $row->invoice,
            $row->customer_name,
            $row->customer_address,
            $row->subtotal,
            $row->created_at->format('Y-m-d'),
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $rowCount = count($this->data) + 2; // +1 for heading, +1 for next row
                $cellSubtotal = 'D' . $rowCount;
                $cellLabel = 'C' . $rowCount;

                $event->sheet->setCellValue($cellLabel, 'Total');
                $event->sheet->setCellValue($cellSubtotal, $this->total);

                // Optional: format number
                $event->sheet->getStyle($cellSubtotal)
                    ->getNumberFormat()
                    ->setFormatCode(NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);

                // Optional: bold total row
                $event->sheet->getStyle("{$cellLabel}:{$cellSubtotal}")->getFont()->setBold(true);
            },
        ];
    }
}
