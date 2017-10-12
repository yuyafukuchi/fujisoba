<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PermitPcsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PermitPcsTable Test Case
 */
class PermitPcsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\PermitPcsTable
     */
    public $PermitPcs;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.permit_pcs'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('PermitPcs') ? [] : ['className' => 'App\Model\Table\PermitPcsTable'];
        $this->PermitPcs = TableRegistry::get('PermitPcs', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->PermitPcs);

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
