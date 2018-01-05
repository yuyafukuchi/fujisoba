<?php
$this->append('heading', '<p>' . $storeName . ' / '.$user->name_last .' '. $user->name_first .' 様' . '</p>');
$breadcrumb = !empty($timeCard['support']) ? $timeCard['support'] : '勤怠入力';
$this->append('breadcrumbs', '<p>勤怠入力確認・' . $data['type'] . '時</p>');
?>

<div class="row" style="zoom: 3;">
    <div class="col-md-12 text-center">
        <p style="font-weight: bold;"><?= $data['type'] ?>時間を<br><?= $data['time']?><br>で登録しました。</p>
    </div>
</div>
<div class="row" style="zoom: 1.5; margin-top: 50px;">
    <div class="col-md-12 text-right">
        <p style="font-weight: bold;">20秒後に自動ログアウトします。</p>
    </div>
</div>
<div class="row" style="zoom: 1.5; margin-top: 50px;">
    <div class="col-md-12 text-center">
        <a href="/attendance/time-cards/login" class="btn btn-default btn-large">従業員ログアウト</a>
    </div>
</div>

<!--
<meta http-equiv="refresh" content="20;URL=/attendance/time-cards/login">
-->
