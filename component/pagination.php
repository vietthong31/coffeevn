<?php
function pagination($totalPage, $currentPage, $link)
{
  $list_items = "";
  for ($pageNumber = 1; $pageNumber <= $totalPage; $pageNumber++) {
    $active = ($pageNumber == $currentPage) ? "active" : "";
    $element = "<li class='page-item $active'><a class='page-link' href='$link$pageNumber'>$pageNumber</a></li>";
    $list_items .= $element;
  }

  return "
  <nav aria-label=\"product pagination\">
    <ul class=\"pagination\">
      $list_items
    </ul>
  </nav>
  ";
}
