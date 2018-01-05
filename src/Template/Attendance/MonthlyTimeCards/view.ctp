<?php
use Cake\I18n\Time;
use Cake\Routing\Router;

$this->append('heading', '<p>' . $data2['name'] . '</p>');
$this->append('breadcrumbs', sprintf('<p>%s＞%s＞勤怠データ詳細 (管理者用)</p>',
    $this->Html->link('トップ', ['controller' => 'Users', 'action' => 'attendance', 'prefix' => false]),
    $this->Html->link('勤怠データ検索・一覧', ['controller' => 'MonthlyTimeCards', 'action' => 'index', 'prefix' => 'attendance'])
));

$this->append('script', $this->Html->script(['time-cards']));

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

// debug($this->request->query);
// debug($data['employee']);
?>

<?= $this->Form->create(null) ?>
<div class="row" id="user-info" style="margin: 0 0 20px;" data-regular-amount="<?= $data['employee']->regular_amount ?>" data-midnight-amount="<?= $data['employee']->midnight_amount ?>">
    <div class="col-sm-8">
        <div class="row" style="margin: 0 0 15px; font-size: large; font-weight: bold;">
            <?= $data['employee']->company->name ?>／<?= $data['employee']->store->name ?>／<?= $data['employee']->name_last ?><?= $data['employee']->name_first ?>

            <?php if (isset($currentMonthlyTimeCard->printed) && $currentMonthlyTimeCard->printed): ?>
                <span class="text-info" style="display: inline-block; margin: 0 0 0 20px; font-size: large; font-weight: normal;">印刷済み</span>
            <?php endif; ?>

            <?php if (isset($currentMonthlyTimeCard->approved) && $currentMonthlyTimeCard->approved): ?>
                <span class="text-info" style="display: inline-block; margin: 0 0 0 20px; font-size: large; font-weight: normal;">承認済み</span>
            <?php endif; ?>

            <?php if (isset($currentMonthlyTimeCard->csv_exported) && $currentMonthlyTimeCard->csv_exported): ?>
                <span class="text-info" style="display: inline-block; margin: 0 0 0 20px; font-size: large; font-weight: normal;">CSV出力済み</span>
            <?php endif; ?>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <?php
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
                <button type="button" onclick="location.href='<?=$url?>'" class="btn btn-default btn-md">当月</button>
                <button type="button" onclick="location.href='<?=$url.'?t='.date('Y-m',$day)?>'" class="btn btn-default btn-md">先月</button>
                <button type="button" onclick="location.href='<?php
                    $day2 = $day;
                    $day2 = strtotime('+2 month',$day2);
                    echo $url.'?t='.date('Y-m',$day2);
                ?>'" class="btn btn-default btn-md">翌月</button>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <span style="font-size: large; zoom: 1.5;"><?= $data['current_year'] ?>年<?= $data['current_month'] ?>月</span>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="row" style="margin-bottom: 15px;">
            <div class="col-sm-3">
                <?= $data['index'] > 1 ? $this->Html->link('前', ['action' => 'view', $data['index']-1, '?' => $this->request->query], ['class' => 'btn btn-default btn-block']) : $this->Html->link('前', ['action' => 'view', $data['index']-1, '?' => $this->request->query], ['class' => 'btn btn-default btn-block disabled']) ?>
            </div>
            <div class="col-sm-3">
                <?= $data['index'] < $data['length'] ? $this->Html->link('次', ['action' => 'view', $data['index']+1, '?' => $this->request->query], ['class' => 'btn btn-default btn-block']) : $this->Html->link('次', ['action' => 'view', $data['index']+1, '?' => $this->request->query], ['class' => 'btn btn-default btn-block disabled']) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-3">
                <?= $this->Form->submit($data['approveButton'], ['name' => 'button', 'class' => 'btn btn-default btn-block']) ?>
            </div>
            <div class="col-sm-3">
                <?= $this->Html->link('印刷', ['action' => 'viewPrint', $data['index'], '?' => $this->request->query], ['class' => 'btn btn-default btn-block', 'target' => '_blank']) ?>
            </div>
            <div class="col-sm-3">
                <?= $this->Form->submit('登録', ['name' => 'button', 'class' => 'btn btn-default btn-block']) ?>
            </div>
            <div class="col-sm-3">
                <a href="javascript:history.back()" class="btn btn-default btn-block">戻る</a>
            </div>
        </div>
    </div>
</div>

<?php // debug($timeCards); ?>

<table class="table table-bordered" data-shift-type="<?= $data['employee']->employee_shift ?>" id="time-cards">
    <thead>
        <tr class="active">
            <th class="text-center" style="width: 4em;">日</th>
            <th class="text-center" style="width: 4em;">曜日</th>
            <th>出勤時刻</th>
            <th>退勤時刻</th>
            <th>出勤時刻2</th>
            <th>退勤時刻2</th>
            <th>予定出勤</th>
            <th>予定退勤</th>
            <th>予定出勤2</th>
            <th>予定退勤2</th>
            <th>有給</th>
            <th class="text-center" style="width: 4em;">時間</th>
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
            <tr data-date="<?= $currentDate ?>">
                <td class="text-center">
                    <?= date('d ',$day) ?>
                    <?php if (!empty($timeCard['id'])): ?>
                        <?= $this->Form->hidden(sprintf('TimeCard[%s][id]', $currentDate), ['value' => $timeCard['id']]) ?>
                    <?php endif; ?>
                    <?= $this->Form->hidden(sprintf('TimeCard[%s][employee_id]', $currentDate), ['value' => $data['employee']->id]) ?>
                    <?= $this->Form->hidden(sprintf('TimeCard[%s][date]', $currentDate), ['value' => $currentDate]) ?>
                    <?= $this->Form->hidden(sprintf('TimeCard[%s][store_id]', $currentDate), ['value' => $data['employee']->store_id]) ?>
                    <?= $this->Form->hidden(sprintf('TimeCard[%s][attendance_store_id]', $currentDate), ['value' => !empty($timeCard['attendance_store_id']) ? $timeCard['attendance_store_id'] : $data['employee']->store_id]) ?>
                </td>
                <td class="text-center">
                    <?= convert_week(date('w',$day)) ?>
                </td>
                <td class="editable in_time">
                    <?= $this->Form->input(sprintf('TimeCard[%s][in_time]', $currentDate), [
                        'label' => false,
                        'placeholder' => '__:__',
                        'class' => 'is-time',
                        'style' => in_array('in_time', $dirty) ? 'color: #c00 !important;' : null,
                        'default' => !empty($timeCard['in_time']) ? $timeCard['in_time']->format('H:i') : '',
                        'data-full-date' => !empty($timeCard['in_time']) ? $timeCard['in_time']->format('Y-m-d H:i') : '',
                    ]) ?>
                </td>
                <td class="editable out_time">
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
                    <?= $this->Form->input(sprintf('TimeCard[%s][out_time]', $currentDate), [
                        'label' => false,
                        'placeholder' => '__:__',
                        'class' => 'is-time',
                        'style' => in_array('out_time', $dirty) ? 'color: #c00 !important;' : null,
                        'default' => !empty($output) ? $output : '',
                        'data-full-date' => !empty($timeCard['out_time']) ? $timeCard['out_time']->format('Y-m-d H:i') : '',
                    ]) ?>
                    <?php unset($output); ?>
                </td>
                <td class="editable in_time2">
                    <?= $this->Form->input(sprintf('TimeCard[%s][in_time2]', $currentDate), [
                        'label' => false,
                        'placeholder' => '__:__',
                        'class' => 'is-time',
                        'style' => in_array('in_time2', $dirty) ? 'color: #c00 !important;' : null,
                        'default' => !empty($timeCard['in_time2']) ? $timeCard['in_time2']->format('H:i') : '',
                        'data-full-date' => !empty($timeCard['in_time2']) ? $timeCard['in_time2']->format('Y-m-d H:i') : '',
                    ]) ?>
                </td>
                <td class="editable out_time2">
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
                    <?= $this->Form->input(sprintf('TimeCard[%s][out_time2]', $currentDate), [
                        'label' => false,
                        'placeholder' => '__:__',
                        'class' => 'is-time',
                        'style' => in_array('out_time2', $dirty) ? 'color: #c00 !important;' : null,
                        'default' => !empty($output) ? $output : '',
                        'data-full-date' => !empty($timeCard['out_time2']) ? $timeCard['out_time2']->format('Y-m-d H:i') : '',
                    ]) ?>
                    <?php unset($output); ?>
                </td>
                <td class="editable schedules_in_time">
                    <?= $this->Form->input(sprintf('TimeCard[%s][schedules_in_time]', $currentDate), [
                        'label' => false,
                        'placeholder' => '__:__',
                        'class' => 'is-time',
                        'style' => in_array('schedules_in_time', $dirty) ? 'color: #c00 !important;' : null,
                        'default' => !empty($timeCard['schedules_in_time']) ? $timeCard['schedules_in_time']->format('H:i') : '',
                        'data-full-date' => !empty($timeCard['schedules_in_time']) ? $timeCard['schedules_in_time']->format('Y-m-d H:i') : '',
                    ]) ?>
                </td>
                <td class="editable schedules_out_time">
                    <?php
                    // 24時を超える時刻の表示を修正
                    if (!empty($timeCard['schedules_out_time'])) {
                        if (date('d', $day) != $timeCard['schedules_out_time']->format('d')) {
                            $output = ((int)$timeCard['schedules_out_time']->format('H') + 24) . ':' . $timeCard['schedules_out_time']->format('i');
                        } else {
                            $output = $timeCard['schedules_out_time']->format('H:i');
                        }
                    }
                    ?>
                    <?= $this->Form->input(sprintf('TimeCard[%s][schedules_out_time]', $currentDate), [
                        'label' => false,
                        'placeholder' => '__:__',
                        'class' => 'is-time',
                        'style' => in_array('schedules_out_time', $dirty) ? 'color: #c00 !important;' : null,
                        'default' => !empty($output) ? $output : '',
                        'data-full-date' => !empty($timeCard['schedules_out_time']) ? $timeCard['schedules_out_time']->format('Y-m-d H:i') : '',
                    ]) ?>
                    <?php unset($output); ?>
                </td>
                <td class="editable schedules_in_time2">
                    <?= $this->Form->input(sprintf('TimeCard[%s][schedules_in_time2]', $currentDate), [
                        'label' => false,
                        'placeholder' => '__:__',
                        'class' => 'is-time',
                        'style' => in_array('schedules_in_time2', $dirty) ? 'color: #c00 !important;' : null,
                        'default' => !empty($timeCard['schedules_in_time2']) ? $timeCard['schedules_in_time2']->format('H:i') : '',
                        'data-full-date' => !empty($timeCard['schedules_in_time2']) ? $timeCard['schedules_in_time2']->format('Y-m-d H:i') : '',
                    ]) ?>
                </td>
                <td class="editable schedules_out_time2">
                    <?php
                    // 24時を超える時刻の表示を修正
                    if (!empty($timeCard['schedules_out_time2'])) {
                        if (date('d', $day) != $timeCard['schedules_out_time2']->format('d')) {
                            $output = ((int)$timeCard['schedules_out_time2']->format('H') + 24) . ':' . $timeCard['schedules_out_time2']->format('i');
                        } else {
                            $output = $timeCard['schedules_out_time2']->format('H:i');
                        }
                    }
                    ?>
                    <?= $this->Form->input(sprintf('TimeCard[%s][schedules_out_time2]', $currentDate), [
                        'label' => false,
                        'placeholder' => '__:__',
                        'class' => 'is-time',
                        'style' => in_array('schedules_out_time2', $dirty) ? 'color: #c00 !important;' : null,
                        'default' => !empty($output) ? $output : '',
                        'data-full-date' => !empty($timeCard['schedules_out_time2']) ? $timeCard['schedules_out_time2']->format('Y-m-d H:i') : '',
                    ]) ?>
                    <?php unset($output); ?>
                </td>
                <td class="editable paid_vacation">
                    <?= $this->Form->checkbox(sprintf('TimeCard[%s][paid_vacation]', $currentDate), [
                        'label' => false,
                        'default' => !empty($timeCard['paid_vacation']) ? 1 : 0,
                        'style' => 'zoom: 2;',
                        'class' => 'check_paid_vacation',
                    ]) ?>
                </td>
                <td class="paid_vacation_time text-center" data-diff="<?= !empty($timeCard['paid_vacation_diff']) ? (int)$timeCard['paid_vacation_diff'] : 0 ?>">
                    <?php if (!empty($timeCard['paid_vacation_diff'])): ?>
                        <?= $this->Form->hidden(sprintf('TimeCard[%s][paid_vacation_diff]', $currentDate), ['value' => (int)$timeCard['paid_vacation_diff']]) ?>
                        <?= (int)$timeCard['paid_vacation_diff'] ?>
                    <?php endif; ?>
                </td>
                <td class="paid_vacation_time_range long <?= (!empty($timeCard['paid_vacation']) && (!empty($timeCard['paid_vacation_start_time']) || !empty($timeCard['paid_vacation_end_time']))) ? 'editable' : null ?>">
                    <?php if (!empty($timeCard['paid_vacation']) && (!empty($timeCard['paid_vacation_start_time']) || !empty($timeCard['paid_vacation_end_time']))): ?>
                        <?= $this->Form->input(sprintf('TimeCard[%s][paid_vacation_start_time]', $currentDate), [
                            'label' => false,
                            'type' => 'select',
                            'options' => range(0, 23),
                            'value' => !empty($timeCard['paid_vacation_start_time']) ? (int)$timeCard['paid_vacation_start_time'] : null,
                            'class' => 'paid_vacation_start_time',
                            'style' => in_array('paid_vacation_start_time', $dirty) ? 'color: #c00 !important;' : null,
                        ]) ?>
                        &nbsp;～&nbsp;
                        <?= $this->Form->input(sprintf('TimeCard[%s][paid_vacation_end_time]', $currentDate), [
                            'label' => false,
                            'type' => 'select',
                            'options' => range(0, 23),
                            'value' => !empty($timeCard['paid_vacation_end_time']) ? (int)$timeCard['paid_vacation_end_time'] : null,
                            'class' => 'paid_vacation_end_time',
                            'style' => in_array('paid_vacation_end_time', $dirty) ? 'color: #c00 !important;' : null,
                        ]) ?>
                    <?php endif; ?>
                </td>
                <td class="diff"></td>
                <td class="over"></td>
                <td class="editable note">
                    <?= $this->Form->input(sprintf('TimeCard[%s][note]', $currentDate), [
                        'label' => false,
                        'default' => !empty($timeCard['note']) ? $timeCard['note']->format('H:i') : '',
                    ]) ?>
                </td>
                <td><?= !empty($timeCard['storeName']) ? $timeCard['storeName'] : null ?></td>
            </tr>
            <?php $day = strtotime('+1 day', $day); ?>
        <?php endwhile; ?>
    </tbody>
</table>

<table class="table table-bordered" id="summary">
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
        <tr class="text-right">
            <td class="working-days"></td>
            <td class="total-working-hours"></td>
            <td class="normal-working-hours"></td>
            <td class="midnight-working-hours"></td>
            <td class="over"></td>
            <td class="">0.0H<br>0円</td>
            <td class="">0.0H<br>0円</td>
            <td class="paid-vacation-hours"></td>
        </tr>
    </tbody>
</table>
<?= $this->Form->end() ?>

<style>
.paid_vacation_time_range .form-group {
    display: inline-block;
}
</style>