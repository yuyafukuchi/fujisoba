<header class="row">
    <div class="col-sm-8">
        <h2><?= $data['name']?>　現金出納表　<?= $date[0].'年'.$date[1].'月度'?></h2>
    </div>
    <div class="col-sm-4">
        <?= $this->Form->create(null, ['class' => 'form-inline pull-right'])?>
        <?= $this->Form->input("transaction_month", [
            "label" => false,
            "type" => "datetime",
            "dateformat" => "YM",
            "monthNames" => false,
            "separator" => "/",
            "templates" => [ "dateWidget" => '{{year}} 年 {{month}} 月' ],
            "minYear" => date("Y" ) - 70,
            "maxYear" => date("Y"),
            "default" => $date[0] . '-' . $date[1],
        ])?>
        <div style="display: inline-block;"><?= $this->Form->submit('検索', ['name' => 'button']) ?></div>
        <?= $this->Form->end()?>
    </div>
</header>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>日付</th>
            <?php $key_array = array_keys($accounts->toArray());?>
            <?php foreach ($accounts as $account) : ?>
            <th><?=h($account)?></th>
            <?php endforeach ; ?>
        </tr>
    </thead>

    <tbody>
        <?php $array_sum = array_fill(0,count($key_array),0); $day_cache = 0;?>
        <?php $midPrinted = false; foreach ($cashAccountTrans as $cashAccountTran): ?>
        <?php if(intval($cashAccountTran->transaction_date->i18nFormat('dd')) >= 16 && !$midPrinted) : ?>
            <tr>
                <th>中間計</th>
                <?php for($j = 0 ; $j < count($key_array) ; $j++) :?>
                        <th><?=number_format($array_sum[$j])?></th>
                <?php endfor;  ?>
            </tr>
        <?php $midPrinted = true ; endif; ?>
        <tr>
            <?php if($day_cache == intval($cashAccountTran->transaction_date->i18nFormat('dd'))) : ?>
                <th></th>
            <?php else : ?>
                <th><?= $cashAccountTran->transaction_date->i18nFormat('dd') ?></th>
                <?php $day_cache = intval($cashAccountTran->transaction_date->i18nFormat('dd')); ?>
            <?php endif; ?>
            <?php $account_id = $cashAccountTran->cash_account_id; ?>
                <?php for($i = 0 ; $i < count($key_array) ; $i++) :?>
                    <?php if($key_array[$i] == $account_id) :?>
                        <?php $array_sum[$i] += strval($cashAccountTran->amount); ?>
                        <th><?=h(number_format($cashAccountTran->amount))?></th>
                    <?php else : ?>
                        <th></th>
                    <?php endif; ?>
                <?php endfor;  ?>
        </tr>
        <tr>
            <th></th>
            <?php $account_id = $cashAccountTran->cash_account_id; ?>
                <?php for($i = 0 ; $i < count($key_array) ; $i++) :?>
                    <?php if($key_array[$i] == $account_id) :?>
                        <th><?=h($cashAccountTran->note)?></th>
                    <?php else : ?>
                        <th></th>
                    <?php endif; ?>
                <?php endfor;  ?>
        </tr>
        <?php endforeach; ?>
        <tr class="pink">
            <th>合計</th>
            <?php for($j = 0 ; $j < count($key_array) ; $j++) :?>
                    <th><?=number_format($array_sum[$j])?></th>

            <?php endfor;  ?>
        </tr>
    </tbody>
</table>
