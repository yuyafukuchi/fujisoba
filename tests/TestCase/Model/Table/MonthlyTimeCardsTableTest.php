<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\MonthlyTimeCardsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\MonthlyTimeCardsTable Test Case
 */
class MonthlyTimeCardsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\MonthlyTimeCardsTable
     */
    public $MonthlyTimeCards;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.monthly_time_cards',
        'app.employees',
        'app.companies',
        'app.stores',
        'app.cash_account_trans',
        'app.cash_accounts',
        'app.inventory_purchase_transactions',
        'app.inventory_items',
        'app.inventory_item_histories',
        'app.store_inventory_item_histories',
        'app.sales_transactions',
        'app.menus',
        'app.sales_item_transactions',
        'app.sales_items',
        'app.sales_item_assign_histories',
        'app.menu_items',
        'app.sales_item_histories',
        'app.store_account_infos',
        'app.accounts',
        'app.debit_categories',
        'app.credit_categories',
        'app.store_menu_histories',
        'app.time_cards',
        'app.users'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('MonthlyTimeCards') ? [] : ['className' => MonthlyTimeCardsTable::class];
        $this->MonthlyTimeCards = TableRegistry::get('MonthlyTimeCards', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->MonthlyTimeCards);

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
