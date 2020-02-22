<?php

namespace Paginator;

class Paginator implements Pagination
{

   private  $elements;
   private  $elementsPerPage;
   private  $pages;
   public   $currentPage = 1;

   public function elements(): iterable {
     return $this->elements;
   }

   public function currentPage(): int {
     return $this->currentPage;
   }

   public function pages(): array {
     return $this->pages;
   }

   public function totalElements(): int {
     return count($this->elements());
   }

   public function totalElementsOnCurrentPage(): int {
     $pages = $this->pages();
     $currentPage = $pages[$this->currentPage()-1];
     return count($currentPage);
   }

   public function totalElementsPerPage(): int {
     return $this->elementsPerPage;
   }

   public function setPage(int $pageNumber): bool {
     if ($pageNumber < 1) {
       $this->currentPage = 1;
       return false;
     }

     $totalPages = count($this->pages);
     if ($pageNumber > $totalPages) {
       $this->currentPage = $totalPages;
       return false;
     }

     $this->currentPage = $pageNumber;
     return true;
   }

   public function paginateElements(iterable $feed, int $elementsPerPage = 3): array {

     // save arguments for later
     $this->elements = $feed;
     $this->elementsPerPage = $elementsPerPage;

     // make iterable an array
     $items = [];
     foreach ($feed as $item) {
       $items[] = $item;
     }

     $pages = array_chunk($items, $elementsPerPage);
     $this->pages = $pages;
     return $pages;
   }

   public function setPageNumber(int $pageNumber): bool {
     $this->currentPage = $pageNumber;
     return true;
   }
}
