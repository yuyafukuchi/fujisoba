<header class="row">
    <div class="col-sm-8">
        <h2><?= $data['name']?>　売上集計表　<?= date('Y年m月度', $date) ?></h2>
    </div>
    <div class="col-sm-4">
        <?= $this->Form->create(null, ['class' => 'form-inline pull-right'])?>
        <?= $this->Form->input("date", [
            "label" => false,
            "type" => "datetime",
            "dateformat" => "YM",
            "monthNames" => false,
            "separator" => "/",
            "templates" => [ "dateWidget" => '{{year}} 年 {{month}} 月' ],
            "minYear" => date("Y" ) - 70,
            "maxYear" => date("Y"),
            "default" => date("Y-m", $date),
        ])?>
        <div style="display: inline-block;"><?= $this->Form->submit('検索', ['name' => 'button']) ?></div>
        <?= $this->Form->end()?>
    </div>
</header>

<?php $week_name = array("日", "月", "火", "水", "木", "金", "土");?>
<?php $lastDay = date('d', strtotime('last day of this month', $date)) ?>
<?php $day = strtotime('first day of this month',$date);?>

<table class="table table-bordered">
    <thead>
        <tr>
            <th colspan='2'>稼働日数</th>
        </tr>
        <tr>
            <th colspan='2' class="pink">予算</th>
        </tr>
        <tr>
            <th colspan='2'>予算平均</th>
        </tr>
        <tr>
            <th class="text-center">日</th>
            <th class="text-center">曜</th>
            <?php foreach ($stores as $store): ?>
                <th><?=h($store->name)?></th>
            <?php endforeach; ?>
            <th>合計</th>
        </tr>
    </thead>
    <tbody>
        <?php while($day <= strtotime('last day of this month', $date)) : ?>
            <tr>
                <td class="text-center"><?=date('d',$day)?></td>
                <td class="text-center"><?=$week_name[date('w',$day)]?></td>
            </tr>
            <?php $day = strtotime('+1 day', $day); ?>
        <?php endwhile; ?>
        <tr class="pink">
            <td>合計</td>
        </tr>
        <tr class="pink">
            <td>差異</td>
        </tr>
        <tr class="blue">
            <td>平均</td>
        </tr>
        <tr class="blue">
            <td>差異</td>
        </tr>
        <tr class="green">
            <td>達成率%</td>
        </tr>
    </tbody>
</table>
