<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SalesDataInterfacesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SalesDataInterfacesTable Test Case
 */
class SalesDataInterfacesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\SalesDataInterfacesTable
     */
    public $SalesDataInterfaces;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.sales_data_interfaces'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('SalesDataInterfaces') ? [] : ['className' => 'App\Model\Table\SalesDataInterfacesTable'];
        $this->SalesDataInterfaces = TableRegistry::get('SalesDataInterfaces', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->SalesDataInterfaces);

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
}
