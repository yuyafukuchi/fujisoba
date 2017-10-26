<?php use Cake\I18n\Time;
use Cake\Routing\Router;
/**
  * @var \App\View\AppView $this
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
$url = Router::url(NULL,true);
$now = Time::now();
	try{
		if(!isset($_GET['t']) || !preg_match('/\A\d{4}-\d{2}\z/', $_GET['t'])){
			throw new Exception();
		}
		$url_datetime = new DateTime($_GET['t']);
		$current_year = ($url_datetime->format('Y'));
		$current_month = intval($url_datetime->format('n'));
		$yeartime = $url_datetime->format('F Y');
		$first_day = new DateTime('first day of' . $yeartime);
	} catch (Exception $e) 
	{
		$current_month = intval($now->format('n'));
		$current_year = ($now->format('Y'));
		$first_day = new DateTime('first day of this month');
	}
$day = strtotime($current_year.'-'.$current_month.'-'.'16 -1 month');
$stopper = 0;

?>
<div class="timeCards index large-9 medium-8 columns content">
    <h3><?= __('Time Cards') ?></h3>
    <button type="button" onclick="location.href='<?=$url?>'">当月</button>
    <button type="button" onclick="location.href='<?=$url.'?t='.date('Y-m',$day)?>'">先月</button>
    <button type="button" onclick="location.href='<?php
        $day2 = $day;
        $day2 = strtotime('+2 month',$day2);
        echo $url.'?t='.date('Y-m',$day2);
    ?>'">翌月</button>
    <?=$current_year . '年' . $current_month . '月'?>
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
    -->
    <?php
        echo $this->Html->link('一括印刷', ['controller'=>'Users', 'action'=>'login']);
        ?> <br> <?php
        echo $this->Html->link('CSV', ['controller'=>'Users', 'action'=>'attendance']);
        ?> <br> <?php
        echo $this->Html->link('戻る', ['controller'=>'Users', 'action'=>'attendance']);
    ?>
    <!--
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
    -->
</div>
