<?php
use Migrations\AbstractMigration;

class AddMonthlyTimeCards extends AbstractMigration
{

    public function up()
    {

        $this->table('store_inventory_item_histories')
            ->changeColumn('cost', 'decimal', [
                'default' => null,
                'limit' => 3,
                'null' => true,
            ])
            ->update();
    }

    public function down()
    {

        $this->table('store_inventory_item_histories')
            ->changeColumn('cost', 'decimal', [
                'comment' => '在庫アイテムの原価',
                'default' => null,
                'null' => true,
                'precision' => 2,
                'scale' => 1,
            ])
            ->update();
    }
}

