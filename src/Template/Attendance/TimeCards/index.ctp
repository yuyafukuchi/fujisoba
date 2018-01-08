<?php
use Cake\I18n\Time;
use Cake\Routing\Router;

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

$url = Router::url(NULL,true);
$now = Time::now();
try {
	if(!isset($_GET['t']) || !preg_match('/\A\d{4}-\d{2}\z/', $_GET['t'])){
		throw new Exception();
	}
	$url_datetime = new DateTime($_GET['t']);
	$current_year =($url_datetime->format('Y'));
	$current_month = intval($url_datetime->format('n'));
	$yeartime = $url_datetime->format('F Y');
	$first_day = new DateTime('first day of' . $yeartime);
} catch(Exception $e) {
	$current_month = intval($now->format('n'));
	$current_year =($now->format('Y'));
	$first_day = new DateTime('first day of this month');
}
$day = strtotime($current_year.'-'.$current_month.'-'.'16 -1 month');
$stopper = 0;
?>

<?php
$this->append('heading', '<p>' . $storeName . ' / '.$user->name_last .' '. $user->name_first .' 様' . '</p>');
$this->append('breadcrumbs', '<p>勤怠データ詳細</p>');
?>

<div class="row">
    <div class="col-xs-12" style="padding: 20px;">
        <button type="button" onclick="location.href='/attendance/time-cards/login'" class="btn btn-default btn-md pull-right hidden">戻る</button>
        <button type="button" onclick="location.href='<?=$url?>'" class="btn btn-default btn-md">当月</button>
        <button type="button" onclick="location.href='<?=$url.'?t='.date('Y-m',$day)?>'" class="btn btn-default btn-md">先月</button>
        <button type="button" onclick="location.href='<?php
            $day2 = $day;
            $day2 = strtotime('+2 month',$day2);
            echo $url.'?t='.date('Y-m',$day2);
        ?>'" class="btn btn-default btn-md">翌月</button>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <span style="font-size: large; zoom: 1.5;"><?=$current_year . '年' . $current_month . '月'?></span>
    </div>
</div>

<table class="table table-bordered">
    <thead>
        <tr class="active">
            <th class="text-center">日</th>
            <th class="text-center">曜日</th>
            <th class="text-center">出勤時刻</th>
            <th class="text-center">退勤時刻</th>
            <th class="text-center">出勤時刻2</th>
            <th class="text-center">退勤時刻2</th>
            <th class="text-center">予定出勤</th>
            <th class="text-center">予定退勤</th>
            <th class="text-center">予定出勤2</th>
            <th class="text-center">予定退勤2</th>
            <th class="text-center">有給</th>
            <th class="text-center">時間</th>
            <th class="text-center">対象時間</th>
            <th class="text-center">総労働時間</th>
            <th class="text-center">残業</th>
            <th class="text-center">備考</th>
            <th class="text-center">店舗名</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $dayNum = 0;
        $workDayNum = 0;
        ?>

        <?php while (!(date('d',$day) == 16 && date('m',$day) == $current_month)): ?>
        <tr>
            <th class="text-center"><?=date('d ',$day)?></th>
            <th class="text-center"><?=convert_week(date('w',$day))?></th>
            <?php if (array_key_exists(date('Y-m-d',$day), $timeCards)): ?>
                <?php $timeCard = $timeCards[date('Y-m-d',$day)]; ?>
                <th class="text-center"><?=$timeCard['in_time'] != null ?$timeCard['in_time']->i18nFormat('H:mm') : ''?></th>
                <th class="text-center"><?=$timeCard['out_time'] != null ?$timeCard['out_time']->i18nFormat('H:mm') : ''?></th>
                <th class="text-center"><?=$timeCard['in_time2'] != null ?$timeCard['in_time2']->i18nFormat('H:mm') : ''?></th>
                <th class="text-center"><?=$timeCard['out_time2'] != null ?$timeCard['out_time2']->i18nFormat('H:mm') : ''?></th>
                <th class="text-center"><?=$timeCard['scheduled_in_time'] != null ?$timeCard['scheduled_in_time']->i18nFormat('H:mm') : ''?></th>
                <th class="text-center"><?=$timeCard['scheduled_out_time'] != null ?$timeCard['scheduled_out_time']->i18nFormat('H:mm') : ''?></th>
                <th class="text-center"><?=$timeCard['scheduled_in_time2'] != null ?$timeCard['scheduled_in_time2']->i18nFormat('H:mm') : ''?></th>
                <th class="text-center"><?=$timeCard['scheduled_out_time2'] != null ?$timeCard['scheduled_out_time2']->i18nFormat('H:mm') : ''?></th>
                <th class="text-center"><?=$timeCard['paid_vacation'] != null ?$timeCard['paid_vacation'] : ''?></th>
                <th class="text-center"><?=$timeCard['paid_vacation_diff'] != null ?$timeCard['paid_vacation_diff'] : ''?></th>
                <th class="text-center"><?=$timeCard['paid_vacation_start_time'] != null ?$timeCard['paid_vacation_start_time'] . " ~ " . $timeCard['paid_vacation_end_time']: ''?></th>
                <th class="text-center"><?=$timeCard['work_time'] != null ?$timeCard['work_time'] : ''?></th>
                <th class="text-center"><?=$timeCard['over_time'] != null ?$timeCard['over_time'] : ''?></th>
                <th class="text-center"><?=$timeCard['note']?></th>
                <th class="text-left"><?=$timeCard['storeName']?></th>
                <?php $workDayNum ++; ?>
            <?php else: ?>
                <th class="text-center"></th>
                <th class="text-center"></th>
                <th class="text-center"></th>
                <th class="text-center"></th>
                <th class="text-center"></th>
                <th class="text-center"></th>
                <th class="text-center"></th>
                <th class="text-center"></th>
                <th class="text-center"></th>
                <th class="text-center"></th>
                <th class="text-center"></th>
                <th class="text-center"></th>
                <th class="text-center"></th>
                <th class="text-center"></th>
                <th class="text-left"></th>
            <?php endif; ?>
        </tr>
        <?php $day = strtotime('+1 day',$day); $dayNum ++; ?>
        <?php endwhile; ?>
    </tbody>
</table>

<table class="table table-bordered">
    <thead>
        <tr>
            <th class="text-center">勤務日数</th>
            <th class="text-center">総労働時間</th>
            <th class="text-center">通常(5~22時)</th>
            <th class="text-center">深夜(22~5時)</th>
            <th class="text-center">残業</th>
            <th class="text-center">その他1</th>
            <th class="text-center">その他2</th>
            <th class="text-center">有給</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <th class="text-right"><?= $monthlyTimeCard->total_working_days ?>日 / <?= $monthlyTimeCard->total_days ?>日</th>
            <th class="text-right"><?= sprintf('%.1f', $monthlyTimeCard->total_working_hours) ?>H</th>
            <th class="text-right"><?= sprintf('%.1f', $monthlyTimeCard->normal_working_hours + $monthlyTimeCard->paid_vacation_hours_normal) ?>H</th>
            <th class="text-right"><?= sprintf('%.1f', $monthlyTimeCard->midnight_working_hours + $monthlyTimeCard->paid_vacation_midnight_amount_hours) ?>H</th>
            <th class="text-right"><?= sprintf('%.1f', $monthlyTimeCard->over_working_hours) ?>H</th>
            <th class="text-right">0.0H</th>
            <th class="text-right">0.0H</th>
            <th class="text-right"><?= $monthlyTimeCard->paid_vacation_days ?>日　　<?= sprintf('%.1f', $monthlyTimeCard->paid_vacation_hours) ?>H</th>
        </tr>
    </tbody>
</table>

<!--
<?= $this->Html->link('印刷', ['controller'=>'Users', 'action'=>'login']) ?>
<?= $this->Html->link('CSV', ['controller'=>'Users', 'action'=>'attendance']) ?>
-->
