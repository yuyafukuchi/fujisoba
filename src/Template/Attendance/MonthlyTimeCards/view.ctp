<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\MonthlyTimeCard $monthlyTimeCard
 */
?>
<?php
function convert_week($week)
    {
        $ret = "";
        switch ($week) {
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
?>
<?=$data['index'] > 1 ? $this->Html->link('前', [ 'action' => 'view', $data['index']-1]) : ''?>
<?=$data['index'] < $data['length'] ? $this->Html->link('次', [ 'action' => 'view', $data['index']+1]) : ''?>
<div class="monthlyTimeCards view large-9 medium-8 columns content">
    <table>
        <thead>
            <tr>
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
            while (!(date('d',$day) == 16 && date('m',$day) == $current_month)){ ?>
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
    <table>
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
                <th><?=$workDayNum.'日/'.$dayNum.'日'?></th>
            </tr>
        </tbody>
    </table>
    <!--
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('employee_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('store_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('date') ?></th>
                <th scope="col"><?= $this->Paginator->sort('in_time') ?></th>
                <th scope="col"><?= $this->Paginator->sort('out_time') ?></th>
                <th scope="col"><?= $this->Paginator->sort('in_time2') ?></th>
                <th scope="col"><?= $this->Paginator->sort('out_time2') ?></th>
                <th scope="col"><?= $this->Paginator->sort('schedules_in_time') ?></th>
                <th scope="col"><?= $this->Paginator->sort('scheduled_out_time') ?></th>
                <th scope="col"><?= $this->Paginator->sort('work_time') ?></th>
                <th scope="col"><?= $this->Paginator->sort('over_time') ?></th>
                <th scope="col"><?= $this->Paginator->sort('paid_vacation') ?></th>
                <th scope="col"><?= $this->Paginator->sort('paid_vacation_start_time') ?></th>
                <th scope="col"><?= $this->Paginator->sort('paid_vacation_end_time') ?></th>
                <th scope="col"><?= $this->Paginator->sort('attendance_store_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created_by') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified_by') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($timeCards as $timeCard): ?>
            <tr>
                <td><?= $this->Number->format($timeCard->id) ?></td>
                <td><?= $timeCard->has('employee') ? $this->Html->link($timeCard->employee->id, ['controller' => 'Employees', 'action' => 'view', $timeCard->employee->id]) : '' ?></td>
                <td><?= $timeCard->has('store') ? $this->Html->link($timeCard->store->name, ['controller' => 'Stores', 'action' => 'view', $timeCard->store->id]) : '' ?></td>
                <td><?= h($timeCard->date) ?></td>
                <td><?= h($timeCard->in_time) ?></td>
                <td><?= h($timeCard->out_time) ?></td>
                <td><?= h($timeCard->in_time2) ?></td>
                <td><?= h($timeCard->out_time2) ?></td>
                <td><?= h($timeCard->schedules_in_time) ?></td>
                <td><?= h($timeCard->scheduled_out_time) ?></td>
                <td><?= $this->Number->format($timeCard->work_time) ?></td>
                <td><?= $this->Number->format($timeCard->over_time) ?></td>
                <td><?= $this->Number->format($timeCard->paid_vacation) ?></td>
                <td><?= $this->Number->format($timeCard->paid_vacation_start_time) ?></td>
                <td><?= $this->Number->format($timeCard->paid_vacation_end_time) ?></td>
                <td><?= $this->Number->format($timeCard->attendance_store_id) ?></td>
                <td><?= h($timeCard->created) ?></td>
                <td><?= $this->Number->format($timeCard->created_by) ?></td>
                <td><?= h($timeCard->modified) ?></td>
                <td><?= $this->Number->format($timeCard->modified_by) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $timeCard->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $timeCard->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $timeCard->id], ['confirm' => __('Are you sure you want to delete # {0}?', $timeCard->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
