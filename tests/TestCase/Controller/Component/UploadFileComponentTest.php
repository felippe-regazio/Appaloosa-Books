<?php
namespace App\Test\TestCase\Controller\Component;

use App\Controller\Component\UploadFileComponent;
use Cake\Controller\ComponentRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\Component\UploadFileComponent Test Case
 */
class UploadFileComponentTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Controller\Component\UploadFileComponent
     */
    public $UploadFile;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $registry = new ComponentRegistry();
        $this->UploadFile = new UploadFileComponent($registry);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->UploadFile);

        parent::tearDown();
    }

    /**
     * Test initial setup
     *
     * @return void
     */
    public function testInitialization()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
