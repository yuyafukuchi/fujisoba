<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TimeCardsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TimeCardsTable Test Case
 */
class TimeCardsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\TimeCardsTable
     */
    public $TimeCards;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.time_cards',
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
        'app.users',
        'app.attendance_stores'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('TimeCards') ? [] : ['className' => 'App\Model\Table\TimeCardsTable'];
        $this->TimeCards = TableRegistry::get('TimeCards', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->TimeCards);

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
