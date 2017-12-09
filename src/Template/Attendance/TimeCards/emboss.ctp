<?php
$this->append('heading', '<p>' . $storeName . ' / '.$user->name_first .' '. $user->name_last .' 様' . '</p>');
$breadcrumb = !empty($timeCard['support']) ? $timeCard['support'] : '勤怠入力';
$this->append('breadcrumbs', '<p>' . $breadcrumb . '</p>');
?>

<div class="vertical-center">
    <?= $this->Form->create(null) ?>
        <div class="row" style="zoom: 2;">
            <div class="col-md-3"></div>
            <div class="col-md-3 text-center">
                <?= $this->Form->input("", [
                    "type" => "text",
                    'label' => false,
                    'class' => 'input-lg',
                    'placeholder' => date('Y/m/d'),
                    'default' => date('Y/m/d'),
                    'style' => 'background-color: #f2dede !important;',
                    'id' => 'clock_date',
                ]) ?>
            </div>
            <div class="col-md-3 text-center">
                <?= $this->Form->input("", [
                    "type" => "text",
                    'label' => false,
                    'class' => 'input-lg',
                    'placeholder' => date('H:i:s'),
                    'default' => date('H:i:s'),
                    'style' => 'background-color: #f2dede !important;',
                    'id' => 'clock_time',
                ]) ?>
            </div>
        </div>
        <div class="row" style="zoom: 2;">
            <div class="col-md-3"></div>
            <div class="col-md-3 text-center text-primary">
                <?php
                // 同日（出勤時刻が前回の出勤時刻と同日）の出勤の場合、出勤ボタンを押した際メッセージを出し、はいの場合、打刻し、いいえの場合何もしない
                if (!empty($timeCard['out_time'])) {
                    $onClick = 'return confirm(\'同日に再出勤してよいですか？\');';
                } else {
                    $onClick = null;
                }
                ?>
                <?= $this->Form->submit("出勤", ['class' => 'btn btn-lg btn-blocka', 'name' => 'button', 'onclick' => $onClick])?>

                <?php if (!empty($timeCard['in_time'])): ?>
                    <br><?= h($timeCard['in_time']->format('m/d H:i')) ?>
                <?php endif; ?>

                <?php if (!empty($timeCard['in_time2'])): ?>
                    <br><?= h($timeCard['in_time2']->format('m/d H:i')) ?>
                <?php endif; ?>
            </div>
            <div class="col-md-3 text-center text-primary">
                <?= $this->Form->submit("退勤", [
                    'class' => 'btn btn-lg btn-blocka',
                    'name' => 'button',
                    'disabled' => $timeCard['in_time']== null || ($timeCard['out_time']!= null && $timeCard['in_time2'] == null) || $timeCard['out_time2'] != null,
                ])?>

                <?php if (!empty($timeCard['out_time'])): ?>
                    <br><?= h($timeCard['out_time']->format('m/d H:i')) ?>
                <?php endif; ?>

                <?php if (!empty($timeCard['out_time2'])): ?>
                    <br><?= h($timeCard['out_time2']->format('m/d H:i')) ?>
                <?php endif; ?>
            </div>
        </div>
        <div class="row" style="zoom: 1.5; margin-top: 50px;">
            <div class="col-md-12 text-center">
                <a href="/attendance/time-cards/login" class="btn btn-default btn-large">従業員ログアウト</a>
            </div>
        </div>
    <?= $this->Form->end() ?>
</div>

<script>
var toDoubleDigits = function(num) {
    num += "";
    if (num.length === 1) {
        num = "0" + num;
    }
    return num;
};

function clock() {
    var now = new Date();
    var y = now.getFullYear();
    var mo = toDoubleDigits(now.getMonth() + 1);
    var d = toDoubleDigits(now.getDate());
    var h = toDoubleDigits(now.getHours());
    var mi = toDoubleDigits(now.getMinutes());
    var s = toDoubleDigits(now.getSeconds());

    //　HTML: <span id="clock_date">(ココの日付文字列を書き換え)</span>
    $("#clock_date").val(y + "/" + mo + "/" + d);
    //　HTML: <span id="clock_time">(ココの時刻文字列を書き換え)</span>
    $("#clock_time").val(h + ":" + mi + ":" + s);
}

setInterval(clock, 1000);
</script>