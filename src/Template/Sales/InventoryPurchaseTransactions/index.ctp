<header class="row">
    <div class="col-sm-8">
        <h2><?= $data['name']?>　仕入在庫入力　<?= date('Y年m月d日', $date) ?></h2>
    </div>
    <div class="col-sm-4">
        <?= $this->Form->create(null, ['class' => 'form-inline pull-right'])?>
        <?= $this->Form->input('date', ['label' => ' 計算日(仕入・残取した日): ', 'type'=>'text', 'class' => 'datepicker', 'default' => date('Y-m-d', $date)])?>
        <div style="display: inline-block;"><?= $this->Form->submit('設定', ['name' => 'button']) ?></div>
        <?= $this->Form->end()?>
    </div>
</header>

<?= $this->Form->create(null, ['url' => ['action' => 'register'], 'class' => 'form-inline']) ?>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>品名</th>
                <th>前日残高</th>
                <th>仕入数</th>
                <th>ロス数</th>
                <th>残取数</th>
                <th>売上高</th>
                <th>金額</th>
                <th>合計</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 0; foreach ($storeInventoryItemHistories as $storeInventoryItemHistory): ?>
                <?php $previousDayCount = !empty($previousDayCountArray[$storeInventoryItemHistory->inventory_item_id]) ? (int)$previousDayCountArray[$storeInventoryItemHistory->inventory_item_id] : 0; ?>
                <tr>
                    <td><?=h($i + 1)?></td>
                    <td><?=h($storeInventoryItemHistory->inventory_item->inventory_item_histories[0]->item_name)?></td>
                    <td class="text-right previous_day_count"><?= $this->Number->format($previousDayCount)?></td>
                    <?php if (array_key_exists($storeInventoryItemHistory->inventory_item_id,$idArray)): ?>
                        <!--edit-->
                        <?php $inventoryPurchaseTransaction = $inventoryPurchaseTransactions->skip($idArray[$storeInventoryItemHistory->inventory_item_id])->first(); ?>
                        <?php $salesCountSum = $previousDayCount + intval($inventoryPurchaseTransaction->hoge); ?>

                        <?=$this->Form->hidden( 'edit['.$i.'][inventory_item_id]' ,['value' => $storeInventoryItemHistory->inventory_item_id]) ?>
                        <?=$this->Form->hidden( 'edit['.$i.'][store_id]' ,['value' => $storeId]) ?>
                        <?=$this->Form->hidden( 'edit['.$i.'][transaction_date]' ,['value' => date('Y-m-d 00:00:00', $date)]) ?>
                        <?=$this->Form->hidden( 'edit['.$i.'][id]' ,['value' => $inventoryPurchaseTransaction->id]) ?>

                        <td class="text-right green" style="width: 1em;"><?= $this->Form->control('edit['.$i.'][purchase_qty]',
                            ['label' => false,'type'=>'number','default' => $inventoryPurchaseTransaction->purchase_qty, 'class' => 'purchase_qty'])?></td>
                        <td class="text-right green" style="width: 1em;"><?= $this->Form->control('edit['.$i.'][loss_qty]',
                            ['label' => false,'type'=>'number', 'default' => $inventoryPurchaseTransaction->loss_qty, 'class' => 'loss_qty'])?></td>
                        <td class="text-right green" style="width: 1em;"><?= $this->Form->control('edit['.$i.'][count_qty]',
                            ['label' => false,'type'=>'number', 'default' => $inventoryPurchaseTransaction->count_qty, 'class' => 'count_qty'])?></td>
                        <td class="text-right sales_amount"><?= $this->Number->format($salesCountSum) ?></td>
                        <td class="text-right price"><?php $price = $storeInventoryItemHistory->price; ?><?= $this->Number->format($price) ?></td>
                        <td class="text-right total"><?= $this->Number->format($salesCountSum * $price); ?></td>
                    <?php else: ?>
                        <!-- add -->
                        <?=$this->Form->hidden( 'add['.$i.'][inventory_item_id]' ,['value' => $storeInventoryItemHistory->inventory_item_id]) ?>
                        <?=$this->Form->hidden( 'add['.$i.'][store_id]' ,['value' => $storeId]) ?>
                        <?=$this->Form->hidden( 'add['.$i.'][transaction_date]' ,['value' => date('Y-m-d 00:00:00', $date)]) ?>

                        <td class="text-right green" style="width: 1em;"><?= $this->Form->control('add['.$i.'][purchase_qty]',['label' => false,'type'=>'number', 'class' => 'purchase_qty'])?></td>
                        <td class="text-right green" style="width: 1em;"><?= $this->Form->control('add['.$i.'][loss_qty]',['label' => false,'type'=>'number', 'class' => 'loss_qty'])?></td>
                        <td class="text-right green" style="width: 1em;"><?= $this->Form->control('add['.$i.'][count_qty]',['label' => false,'type'=>'number', 'class' => 'count_qty'])?></td>
                        <td class="text-right sales_amount"></td>
                        <td class="text-right price"><?= $this->Number->format($storeInventoryItemHistory->price) ?></td>
                        <td class="text-right total"></td>
                    <?php endif; ?>
                </tr>
            <?php $i ++; endforeach; ?>
        </tbody>
    </table>

    <hr style="margin-bottom: 10px;">

    <p class="text-right" style="font-weight: bold; margin: 0 0 20px;">
        合計&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <span class="salesSum">0</span>
    </p>

    <p><?= $this->Form->submit('登録', ['name' => 'button', 'class' => 'btn btn-default btn-lg pull-right']);?></p>
<?= $this->Form->end() ?>

<script>
jQuery(function($){
    /**
     * 警告メッセージ
     *
     * 仕入、ロス数、残取数のどれかに値を入れた場合は、そのレコードの仕入、ロス、残取数とも入力必須として、
     * 入力漏れがある場合はメッセージで「仕入、ロス、残取数のどれかに値を入力した場合は、全ての項目に入力が必須です」と表示。
     */
    $(document).on('change', '.green input.form-control', function(){
        var $parent = $(this).closest('tr'),
            $isEmpty = true;

        $('input.form-control', $parent).each(function(){
            if ($(this).val().length > 0) {
                $isEmpty = false;
            }
        });

        if ($isEmpty) {
            $('input.form-control', $parent).removeAttr('required');
        } else {
            $('input.form-control', $parent).prop('required', true);
        }
    });

    /**
     * 売上高、合計、全体の合計の表示
     *
     * 仕入数フィールドに数値を入力し、他のフィールドに移動したタイミングで
     * 売上高と合計、全体の合計の数値を計算して表示。
     * （ロス数、残取り数フィールドも同様の動き）
     *
     * 売上高 = 前日残高＋仕入数ーロス数ー残取数（図のNo1の売上高は間違い、正しくは63）
     * 合計 = 売上高×金額
     */
     $(document).on('change', '.green input.form-control', function(){
        var $parent = $(this).closest('tr'),
            /* 前日残高 */ $previous_day_count = parseInt($parent.find('.previous_day_count').text()),
            /*  仕入数  */ $qty = parseInt($parent.find('.purchase_qty').val()),
            /*  ロス数  */ $loss_qty = parseInt($parent.find('.loss_qty').val()),
            /*  残取数  */ $count_qty = parseInt($parent.find('.count_qty').val().replace(/[^0-9]/g, '')),
            /*   金額   */ $price = parseInt($parent.find('.price').text().replace(/[^0-9]/g, '')),
            /*  売上高  */ $sales_amount = $parent.find('.sales_amount'),
            /*   合計   */ $total = $parent.find('.total');

        // 売上高を更新
        var $salesAmount = null;
            $salesAmount = $previous_day_count + $qty - $loss_qty - $count_qty;
            $salesAmount = isNaN($salesAmount) ? null : $salesAmount;
        $sales_amount.text(Number($salesAmount).toLocaleString());

        // 合計を更新
        var $totalAmount = null;
        if ($salesAmount != null) {
            $totalAmount = parseInt($salesAmount) * parseInt($price);
            $totalAmount = isNaN($totalAmount) ? null : $totalAmount;
        }
        $total.text(Number($totalAmount).toLocaleString());

        // 全体の合計値を更新
        calcSum();
     });

     /**
      * 全体の合計値を計算
      */
     function calcSum() {
         var $salesSum = 0;

         $('td.total').each(function(){
             var $increment = parseInt($(this).text().replace(/[^0-9]/g, ''));

             if (!isNaN($increment)) {
                $salesSum += $increment;
             }
         });

         $('.salesSum').text(Number($salesSum).toLocaleString());
     }
     calcSum();
});
</script>