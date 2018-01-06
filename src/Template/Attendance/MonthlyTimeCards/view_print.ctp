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
	    $current_month = $data['current_month'];
	    $day = strtotime($data['current_year'].'-'.$current_month.'-'.'16 -1 month');
        while (!(date('d',$day) == 16 && date('m',$day) == $current_month)): ?>
            <?php
            $currentDate = date('Y-m-d',$day);
            $timeCard = !empty($timeCards[$currentDate]) ? $timeCards[$currentDate] : [];
            $dirty = !empty($timeCard['dirty_fields']) ? unserialize($timeCard['dirty_fields']) : [];
            ?>
            <tr>
                <td>
                    <?= date('d ',$day) ?>
                    <?php if (!empty($timeCard['id'])): ?>
                        <?= $this->Form->hidden(sprintf('TimeCard[%s][id]', $currentDate), ['value' => $timeCard['id']]) ?>
                    <?php endif; ?>
                    <?= $this->Form->hidden(sprintf('TimeCard[%s][employee_id]', $currentDate), ['value' => $data['employee']->id]) ?>
                    <?= $this->Form->hidden(sprintf('TimeCard[%s][date]', $currentDate), ['value' => $currentDate]) ?>
                    <?= $this->Form->hidden(sprintf('TimeCard[%s][store_id]', $currentDate), ['value' => $data['employee']->store_id]) ?>
                    <?= $this->Form->hidden(sprintf('TimeCard[%s][attendance_store_id]', $currentDate), ['value' => !empty($timeCard['attendance_store_id']) ? $timeCard['attendance_store_id'] : $data['employee']->store_id]) ?>
                </td>
                <td>
                    <?= convert_week(date('w',$day)) ?>
                </td>
                <td>
                    <?= !empty($timeCard['in_time']) ? $timeCard['in_time']->format('H:i') : null ?>
                </td>
                <td>
                    <?php
                    // 24時を超える時刻の表示を修正
                    if (!empty($timeCard['out_time'])) {
                        if (date('d', $day) != $timeCard['out_time']->format('d')) {
                            $output = ((int)$timeCard['out_time']->format('H') + 24) . ':' . $timeCard['out_time']->format('i');
                        } else {
                            $output = $timeCard['out_time']->format('H:i');
                        }
                    }
                    ?>
                    <?= !empty($output) ? $output : null ?>
                    <?php unset($output); ?>
                </td>
                <td>
                    <?= !empty($timeCard['in_time2']) ? $timeCard['in_time2']->format('H:i') : null ?>
                </td>
                <td>
                    <?php
                    // 24時を超える時刻の表示を修正
                    if (!empty($timeCard['out_time2'])) {
                        if (date('d', $day) != $timeCard['out_time2']->format('d')) {
                            $output = ((int)$timeCard['out_time2']->format('H') + 24) . ':' . $timeCard['out_time2']->format('i');
                        } else {
                            $output = $timeCard['out_time2']->format('H:i');
                        }
                    }
                    ?>
                    <?= !empty($output) ? $output : null ?>
                    <?php unset($output); ?>
                </td>
                <td>
                    <?= !empty($timeCard['scheduled_in_time']) ? $timeCard['scheduled_in_time']->format('H:i') : null ?>
                </td>
                <td>
                    <?php
                    // 24時を超える時刻の表示を修正
                    if (!empty($timeCard['scheduled_out_time'])) {
                        if (date('d', $day) != $timeCard['scheduled_out_time']->format('d')) {
                            $output = ((int)$timeCard['scheduled_out_time']->format('H') + 24) . ':' . $timeCard['scheduled_out_time']->format('i');
                        } else {
                            $output = $timeCard['scheduled_out_time']->format('H:i');
                        }
                    }
                    ?>
                    <?= !empty($output) ? $output : null ?>
                    <?php unset($output); ?>
                </td>
                <td>
                    <?= !empty($timeCard['scheduled_in_time2']) ? $timeCard['scheduled_in_time2']->format('H:i') : null ?>
                </td>
                <td>
                    <?php
                    // 24時を超える時刻の表示を修正
                    if (!empty($timeCard['scheduled_out_time2'])) {
                        if (date('d', $day) != $timeCard['scheduled_out_time2']->format('d')) {
                            $output = ((int)$timeCard['scheduled_out_time2']->format('H') + 24) . ':' . $timeCard['scheduled_out_time2']->format('i');
                        } else {
                            $output = $timeCard['scheduled_out_time2']->format('H:i');
                        }
                    }
                    ?>
                    <?= !empty($output) ? $output : null ?>
                    <?php unset($output); ?>
                </td>
                <td>
                    <?= !empty($timeCard['paid_vacation']) ? 1 : null ?>
                </td>
                <td>
                    <?php if (!empty($timeCard['paid_vacation_diff'])): ?>
                        <?= $this->Form->hidden(sprintf('TimeCard[%s][paid_vacation_diff]', $currentDate), ['value' => (int)$timeCard['paid_vacation_diff']]) ?>
                        <?= (int)$timeCard['paid_vacation_diff'] ?>
                    <?php endif; ?>
                </td>
                <td>
                    <?php if (!empty($timeCard['paid_vacation']) && (!empty($timeCard['paid_vacation_start_time']) || !empty($timeCard['paid_vacation_end_time']))): ?>
                        <?= !empty($timeCard['paid_vacation_start_time']) ? (int)$timeCard['paid_vacation_start_time'] : null ?>
                        &nbsp;～&nbsp;
                        <?= !empty($timeCard['paid_vacation_end_time']) ? (int)$timeCard['paid_vacation_end_time'] : null ?>
                    <?php endif; ?>
                </td>
                <td class="diff"></td>
                <td class="over"></td>
                <td class="editable note">
                    <?= !empty($timeCard['note']) ? $timeCard['note']->format('H:i') : null ?>
                </td>
                <td><?= !empty($timeCard['storeName']) ? $timeCard['storeName'] : null ?></td>
            </tr>
            <?php $day = strtotime('+1 day', $day); ?>
        <?php endwhile; ?>
    </tbody>
</table>

<table class="table table-bordered">
    <thead>
        <tr>
            <th class="text-right">勤務日数</th>
            <th class="text-right">総労働時間</th>
            <th class="text-right">通常(5~22時)</th>
            <th class="text-right">深夜(22~5時)</th>
            <th class="text-right">残業</th>
            <th class="text-right">その他1</th>
            <th class="text-right">その他2</th>
            <th class="text-right">有給</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td class="text-right"><?= $monthlyTimeCard->total_working_days ?>日 / <?= $monthlyTimeCard->total_days ?>日</td>
            <td class="text-right">
                <?= sprintf('%.1f', $monthlyTimeCard->total_working_hours) ?>H<br>
                <?= $this->Number->format($monthlyTimeCard->total_working_amount) ?>円
            </td>
            <td class="text-right">
                <?= sprintf('%.1f', $monthlyTimeCard->total_working_hours) ?>H<br>
                <?= $this->Number->format($monthlyTimeCard->total_working_amount) ?>円
            </td>
            <td class="text-right">
                <?= sprintf('%.1f', (int)$monthlyTimeCard->normal_working_hours + (int)$monthlyTimeCard->paid_vacation_hours_normal) ?>H<br>
                <?= $this->Number->format((int)$monthlyTimeCard->normal_working_amount + (int)$monthlyTimeCard->paid_vacation_normal_amount) ?>円
            </td>
            <td class="text-right">
                <?= sprintf('%.1f', (int)$monthlyTimeCard->midnight_working_hours + (int)$monthlyTimeCard->paid_vacation_hours_midnight) ?>H<br>
                <?= $this->Number->format((int)$monthlyTimeCard->midnight_working_amount + (int)$monthlyTimeCard->paid_vacation_midnight_amount) ?>円
            </td>
            <td class="text-right">0.0H<br>0円</td>
            <td class="text-right">0.0H<br>0円</td>
            <td class="text-right">
                <?= $monthlyTimeCard->paid_vacation_days ?>日　　<?= sprintf('%.1f', $monthlyTimeCard->paid_vacation_hours) ?>H<br>
                通常 <?= sprintf('%.1f', $monthlyTimeCard->paid_vacation_hours_normal) ?>H<br>
                深夜 <?= sprintf('%.1f', $monthlyTimeCard->paid_vacation_hours_midnight) ?>H
            </td>
        </tr>
    </tbody>
</table>

<?php // debug($monthlyTimeCard); ?>