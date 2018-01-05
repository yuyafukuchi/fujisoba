<?php
function convert_week($week)
{
    $ret = "";
    switch($week) {
        case 0:
            $ret = "日";
            break;
        case 1:
            $ret = "月";
            break;
        case 2:
            $ret = "火";
            break;
        case 3:
            $ret = "水";
            break;
        case 4:
            $ret = "木";
            break;
        case 5:
            $ret = "金";
            break;
        case 6:
            $ret = "土";
            break;
    }
    return $ret;
}

// debug($data);
?>

<div class="row" style="margin: 0 0 20px;">
    <div class="col-xs-8">
        <h1><?= $data['current_year'] ?>年<?= $data['current_month'] ?>月　勤務表</h1>
        <h2><?= $data['employee']->store->name ?></h2>
    </div>
    <div class="col-xs-4" style="border-bottom: 2px solid;">
        <h3><?= $data['employee']->company->name ?></h3>
        <div class="row">
            <div class="col-xs-6">
                <h3 style=""><?= $data['employee']->name_last ?>　<?= $data['employee']->name_first ?></h3>
            </div>
            <div class="col-xs-6 text-right">
                <span style="border-radius: 1em; border: 1px solid; display: inline-block; padding: .1em .3em; margin: 20px 0 0;">印</span>
            </div>
        </div>
    </div>
</div>



<table class="table table-bordered">
    <thead>
        <tr class="active">
            <th>日</th>
            <th>曜日</th>
            <th>出勤時刻</th>
            <th>退勤時刻</th>
            <th>出勤時刻2</th>
            <th>退勤時刻2</th>
            <th>予定出勤</th>
            <th>予定退勤</th>
            <th>予定出勤2</th>
            <th>予定退勤2</th>
            <th>有給</th>
            <th>時間</th>
            <th>対象時間</th>
            <th>総労働時間</th>
            <th>残業</th>
            <th>備考</th>
            <th>店舗名</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $dayNum = 0;
        $workDayNum = 0;
	    $current_month = $data['current_month'];
	    $day = strtotime($data['current_year'].'-'.$current_month.'-'.'16 -1 month');
        while(!(date('d',$day) == 16 && date('m',$day) == $current_month)){ ?>
        <tr>
            <th><?=date('d ',$day)?></th>
            <th><?=convert_week(date('w',$day))?></th>
            <?php if(array_key_exists(date('Y-m-d',$day), $timeCards)) {
                $timeCard = $timeCards[date('Y-m-d',$day)];?>
            <th><?=$timeCard['in_time'] != null ?$timeCard['in_time']->i18nFormat('H:mm') : ''?></th>
            <th><?=$timeCard['out_time'] != null ?$timeCard['out_time']->i18nFormat('H:mm') : ''?></th>
            <th><?=$timeCard['in_time2'] != null ?$timeCard['in_time2']->i18nFormat('H:mm') : ''?></th>
            <th><?=$timeCard['out_time2'] != null ?$timeCard['out_time2']->i18nFormat('H:mm') : ''?></th>
            <th><?=$timeCard['schedules_in_time'] != null ?$timeCard['scheduled_in_time']->i18nFormat('H:mm') : ''?></th>
            <th><?=$timeCard['schedules_out_time'] != null ?$timeCard['scheduled_out_time']->i18nFormat('H:mm') : ''?></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th><?=$timeCard['note']?></th>
            <th><?=$timeCard['storeName']?></th>
            <?php $workDayNum ++;} else { ?>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <?php } ?>
        </tr>
        <?php $day = strtotime('+1 day',$day); $dayNum ++;} ?>
    </tbody>
</table>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>勤務日数</th>
            <th>総労働時間</th>
            <th>通常(5~22時)</th>
            <th>深夜(22~5時)</th>
            <th>残業</th>
            <th>その他1</th>
            <th>その他2</th>
            <th>有給</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><?= $workDayNum.'日 / '.$dayNum.'日' ?></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
    </tbody>
</table>

<?php debug($monthlyTimeCard); ?>