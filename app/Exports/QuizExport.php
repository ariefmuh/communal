<?php

namespace App\Exports;

use App\Models\Quiz;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;

class QuizExport implements FromCollection, WithHeadings, WithMapping, WithStyles, WithColumnWidths, WithTitle, WithCustomStartCell, WithEvents
{
    protected $quiz;

    public function __construct(Quiz $quiz)
    {
        $this->quiz = $quiz;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return $this->quiz->questions;
    }

    /**
     * @return string
     */
    public function startCell(): string
    {
        return 'A6'; // Start data from row 6 to leave space for title and metadata
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'Q#',
            'Question Text',
            'Option A',
            'Option B',
            'Option C',
            'Option D',
            'Correct Answer'
        ];
    }

    /**
     * @param mixed $question
     * @return array
     */
    public function map($question): array
    {
        static $questionNumber = 1;
        return [
            $questionNumber++,
            $question->question_text,
            $question->option_a,
            $question->option_b,
            $question->option_c,
            $question->option_d,
            $question->correct_answer
        ];
    }

    /**
     * @param Worksheet $sheet
     * @return array
     */
    public function styles(Worksheet $sheet)
    {
        return [
            // Style the heading row
            6 => [
                'font' => ['bold' => true, 'color' => ['argb' => Color::COLOR_WHITE], 'size' => 12],
                'fill' => [
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => ['argb' => '366092']
                ],
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER
                ]
            ],

            // Style for title row
            1 => [
                'font' => ['bold' => true, 'size' => 16, 'color' => ['argb' => '366092']],
                'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER]
            ],

            // Style for metadata rows
            2 => ['font' => ['bold' => true, 'size' => 11]],
            3 => ['font' => ['bold' => true, 'size' => 11]],
            4 => ['font' => ['bold' => true, 'size' => 11]],
        ];
    }

    /**
     * @return array
     */
    public function columnWidths(): array
    {
        return [
            'A' => 8,   // Q#
            'B' => 50,  // Question Text
            'C' => 20,  // Option A
            'D' => 20,  // Option B
            'E' => 20,  // Option C
            'F' => 20,  // Option D
            'G' => 15,  // Correct Answer
        ];
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return 'Quiz Export';
    }

    /**
     * @return array
     */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();

                // Add title and metadata
                $sheet->setCellValue('A1', $this->quiz->title);
                $sheet->setCellValue('A2', 'Created by: ' . ($this->quiz->user->name ?? 'Unknown'));
                $sheet->setCellValue('A3', 'Total Questions: ' . $this->quiz->questions->count());
                $sheet->setCellValue('A4', 'Export Date: ' . now()->format('Y-m-d H:i:s'));

                // Merge cells for title
                $sheet->mergeCells('A1:G1');
                $sheet->mergeCells('A2:G2');
                $sheet->mergeCells('A3:G3');
                $sheet->mergeCells('A4:G4');

                // Add borders to data range
                $lastRow = 6 + $this->quiz->questions->count();
                $sheet->getStyle('A6:G' . $lastRow)->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => ['argb' => '000000'],
                        ],
                    ],
                ]);

                // Auto-wrap text for question column
                $sheet->getStyle('B7:B' . $lastRow)->getAlignment()->setWrapText(true);

                // Center align Q# and Correct Answer columns
                $sheet->getStyle('A6:A' . $lastRow)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                $sheet->getStyle('G6:G' . $lastRow)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

                // Set row height for better readability
                for ($row = 7; $row <= $lastRow; $row++) {
                    $sheet->getRowDimension($row)->setRowHeight(30);
                }
            }
        ];
    }
}
