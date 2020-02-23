<?php

namespace Paginator;

interface Pagination
{

  /** @return pages **/
  public function paginateElements(iterable $feed, int $elementsPerPage): array;

  /** @return iterable */
  public function elements(): iterable;

  /** @return int */
  public function currentPage(): int;

  /** @return int[] */
  public function pages(): array;

  /** @return int */
  public function totalElements(): int;

  /** @return int */
  public function totalElementsOnCurrentPage(): int;

  /** @return int */
  public function totalElementsPerPage(): int;

  /** @return bool */
  public function setPage(int $pageNumber): bool;
}
