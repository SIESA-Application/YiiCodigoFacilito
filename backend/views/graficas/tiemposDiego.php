<?php


use yii\helpers\Html;

use miloschuman\highcharts\Highcharts;
use miloschuman\highcharts\HighchartsAsset;

HighchartsAsset::register($this)->withScripts(['highstock', 'modules/exporting', 'modules/drilldown']);

$this->title = Yii::t('app', 'Productividad');
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="container">

    <?=
    Highcharts::widget([
        'options' => [
            'credits' => ['enabled' => false],
            'chart' => ['type' => 'area'],
            'title' => ['text' => 'Productividad ' . Yii::$app->user->identity->username],
            'exporting' => [
                'chartOptions' => [// specific options for the exported image
                    'plotOptions' => [
                        'series' => [
                            'dataLabels' => [
                                'enabled' => true
                            ]
                        ]
                    ]
                            ],
                'scale' => 3,
                'fallbackToExportServer' => false
                        ],
            'plotOptions' => [
                'area' => [
                    'stacking' => 'normal',
                    'lineColor' => '#666666',
                    'lineWidth' => 1,
                    'maker' => [
                        'lineWidth' => 1,
                        'lineColor' => '#666666'
                    ]
                ]
                    ],
            'xAxis' => [
                'categories' => $fechas /* [22-02-2022, 17-02-2022, 25-02-2022] */
            ],
            'yAxis' => [
                'title' => ['text' => 'Horas productivas'],
               
            ],
            'series' => $series /* [[1, 5.4, 12.44], [8.2, 5.4, 12.44],[2, 0, 4],] */
        ]
        ]);
        ?>
        


</div>