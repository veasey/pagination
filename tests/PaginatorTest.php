<?php

namespace Paginator;

use Paginator\Paginator;

class PaginatorTest extends \PHPUnit\Framework\TestCase
{
    protected $testList;
    public $paginator;

    protected function setUp()
    {
      $this->paginator = new Paginator();
      $this->testList = ['eggs', 'milk', 'newspaper', 'sugar', 'beans'];
    }

    // test loading arrays and collections
    public function testFeeds()
    {
      $shoppingArray = $this->testList;
      $shoppingCollection = new \ArrayObject(['eggs', 'milk', 'newspaper']);
      $paginator = $this->paginator;
      $this->assertNotEmpty($paginator->paginateElements($shoppingArray));
      $this->assertNotEmpty($paginator->paginateElements($shoppingCollection));
    }

    public function testCount() {
      $paginator = $this->paginator;
      $paginator->paginateElements($this->testList);
      $this->assertEquals(5, $paginator->totalElements());
    }

    public function testSetPageFeedback() {
      // should return false if out of range
      $paginator = $this->paginator;
      $paginator->paginateElements($this->testList);
      $this->assertEmpty($paginator->setPage(99));
      $this->assertNotEmpty($paginator->setPage(2));
    }

    public function correctElementsOnPage() {
      $paginator = $this->paginator;
      $paginator->paginateElements($this->testList);

      // first page
      $this->assertEquals(3, $paginator->elementsPerPage());

      // second page, not full
      $paginator->setPage(2);
      $this->assertEquals(2, $paginator->elementsPerPage());
    }

}
