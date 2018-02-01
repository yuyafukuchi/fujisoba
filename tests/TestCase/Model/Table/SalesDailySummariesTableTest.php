<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SalesDailySummariesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SalesDailySummariesTable Test Case
 */
class SalesDailySummariesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\SalesDailySummariesTable
     */
    public $SalesDailySummaries;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.sales_daily_summaries',
        'app.stores',
        'app.companies',
        'app.employees',
        'app.time_cards',
        'app.monthly_time_cards',
        'app.users',
        'app.cash_account_trans',
        'app.accounts',
        'app.store_account_infos',
        'app.debit_categories',
        'app.credit_categories',
        'app.inventory_purchase_transactions',
        'app.inventory_items',
        'app.inventory_item_histories',
        'app.store_inventory_item_histories',
        'app.sales_transactions',
        'app.menus',
        'app.sales_item_assign_histories',
        'app.sales_items',
        'app.sales_item_histories',
        'app.sales_item_transactions',
        'app.store_menu_histories',
        'app.menu_histories'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('SalesDailySummaries') ? [] : ['className' => SalesDailySummariesTable::class];
        $this->SalesDailySummaries = TableRegistry::get('SalesDailySummaries', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->SalesDailySummaries);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
