<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ReviewersTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ReviewersTable Test Case
 */
class ReviewersTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ReviewersTable
     */
    public $Reviewers;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.reviewers',
        'app.books'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Reviewers') ? [] : ['className' => ReviewersTable::class];
        $this->Reviewers = TableRegistry::get('Reviewers', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Reviewers);

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
