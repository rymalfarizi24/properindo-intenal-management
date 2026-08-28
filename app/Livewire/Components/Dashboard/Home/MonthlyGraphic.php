<?php

namespace App\Livewire\Components\Dashboard\Home;

use App\Models\Post;
use Asantibanez\LivewireCharts\Models\ColumnChartModel;
use Carbon\Carbon;
use Livewire\Component;

class MonthlyGraphic extends Component
{

    public $selectedYear1 = null;
    public $selectedYear2 = null;
    public $availableYears = null;

    protected $author_id = null;

    public function mount($scope = 'user')
    {
        $this->author_id = $scope === 'user' ? auth()->user()->id : null;
        $availableYears = Post::getAvailableYears($this->author_id);
        $this->availableYears = $availableYears;
        $this->selectedYear2 = $availableYears[0] ?? null;
        $this->selectedYear1 = $availableYears[1] ?? null;
    }

    public function render()
    {
        $chart = null;

        if ($this->selectedYear1 || $this->selectedYear2) {
            if ($this->selectedYear1) {
                $data1 = $this->getMonthlyData($this->selectedYear1);
            }

            if ($this->selectedYear2) {
                $data2 = $this->getMonthlyData($this->selectedYear2);
            }


            $chart = (new ColumnChartModel())
                ->setAnimated(true)
                ->multiColumn()
                ->withDataLabels()
                ->setJsonConfig([
                    'chart' => ['height' => 384],
                ]);
            $sameYear = $this->selectedYear1 == $this->selectedYear2;
            for ($index = 0; $index < 12; $index++) {
                $monthName = Carbon::create()->month($index + 1)->translatedFormat('F');

                if ($this->selectedYear1) {
                    $chart->addSeriesColumn($this->selectedYear1, $monthName, $data1[$index]);
                }
                if (!$sameYear && $this->selectedYear2) {
                    $chart->addSeriesColumn($this->selectedYear2, $monthName, $data2[$index]);
                }
            }
        }

        return view('livewire.components.dashboard.home.monthly-graphic', [
            'chart' => $chart
        ]);
    }

    private function getMonthlyData(int $year)
    {
        $stats = Post::monthlyStats($year, $this->author_id)->get();
        if (count($stats) == 0) {
            return null;
        }
        $data = array_fill(0, 12, 0);
        foreach ($stats as $stat) {
            $index = (int)$stat['month'] - 1;
            $data[$index] = $stat['total'];
        }
        return $data;
    }

    public function placeholder()
    {
        return view('components.placeholder.monthly-graphic');
    }
}
