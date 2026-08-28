<?php

namespace App\Livewire\Components\Dashboard\Home;

use App\Models\Category;
use Asantibanez\LivewireCharts\Models\PieChartModel;
use Livewire\Component;

class CategoryGraphic extends Component
{
    protected $author_id = null;

    public function mount($scope = 'user')
    {
        $this->author_id = $scope === 'user' ? auth()->user()->id : null;
    }

    public function render()
    {
        $stats = Category::postsCategoriesCount($this->author_id)->get();
        $chart = null;

        if (count($stats) > 0) {
            $chart = (new PieChartModel())
                ->setAnimated(true)
                ->withDataLabels()
                ->setJsonConfig([
                    'chart' => ['height' => 384],
                ]);

            foreach ($stats as $stat) {
                $chart->addSlice($stat['name'], (int)$stat['posts_count'], $stat['color']);
            }
        }

        return view('livewire.components.dashboard.home.category-graphic', [
            'chart' => $chart
        ]);
    }

    public function placeholder()
    {
        return view('components.placeholder.category-graphic');
    }
}
