<?php
namespace App\Test\TestCase\Controller;

use App\Controller\SalesTransactionsController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\SalesTransactionsController Test Case
 */
class SalesTransactionsControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.sales_transactions',
        'app.stores',
        'app.companies',
        'app.employees',
        'app.time_cards',
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
        'app.store_menu_histories',
        'app.menus',
        'app.menu_histories',
        'app.sales_item_assign_histories',
        'app.sales_items',
        'app.sales_item_histories',
        'app.sales_item_transactions'
    ];

    /**
     * Test index method
     *
     * @return void
     */
    public function testIndex()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test view method
     *
     * @return void
     */
    public function testView()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test add method
     *
     * @return void
     */
    public function testAdd()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test edit method
     *
     * @return void
     */
    public function testEdit()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test delete method
     *
     * @return void
     */
    public function testDelete()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
