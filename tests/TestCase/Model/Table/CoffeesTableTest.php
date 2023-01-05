<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CoffeesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CoffeesTable Test Case
 */
class CoffeesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\CoffeesTable
     */
    protected $Coffees;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Coffees',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Coffees') ? [] : ['className' => CoffeesTable::class];
        $this->Coffees = $this->getTableLocator()->get('Coffees', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Coffees);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\CoffeesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
