<?php

function dv_bootstrap_breadcrumbs($nodes, $divider = '/') {
  $html = '<ul class="breadcrumb">';
  $last = count($nodes) - 1;
  for($i=0;$i<count($nodes);$i++) {
    $isLast = ($i == $last);

    $node = $nodes[$i];
    $text = $node['text'];
    if (isset($node['url'])) {
      $url = $node['url'];
    } else {
      $routeParams = isset($node['route_params']) ? $node['route_params'] : array();
      $url = url_for($node['route'], $routeParams);
    }
    if (!$isLast) {
      $html .= '<li><a href="'.$url.'">'.$text.'</a> <span class="divider">'.$divider.'</span></li>';
    } else {
      $html .= '<li class="active">'.$text.'</li>';
    }
  }
  $html .= '</ul>';
  return $html;
}

function render_bootstrap_menu(ioMenuItem $menu, $depth = null, $renderAsChild = false) {
    if (!$menu->hasChildren() || $depth === 0 || !$menu->showChildren())
    {
      return;
    }
    
    $attributes = $menu->getAttributes();
    if (!isset($attributes['class'])) {
        if ($renderAsChild) {
            $attributes['class'] = 'dropdown-menu';
        } else {
            $attributes['class'] = 'nav';
        }
    }
    
    $html = '<ul'._tag_options($attributes).'>';
    $childDepth = ($depth === null) ? null : ($depth - 1);
    $html .= _render_bootstrap_menu_children($menu, $childDepth);
    $html .= '</ul>';
    
    return $html;
}

function _render_bootstrap_menu_children(ioMenuItem $item, $depth = null) {
    
    $html = '';
    foreach ($item->getChildren() as $child)
    {
      $html .= _render_bootstrap_menu_child($child, $depth);
    }
    return $html;
    
}

function _render_bootstrap_menu_child(ioMenuItem $item, $depth = null) {
    
    // if we don't have access or this item is marked to not be shown
    if (!$item->shouldBeRendered())
    {
      return; 
    }

    // explode the class string into an array of classes
    $class = ($item->getAttribute('class')) ? explode(' ', $item->getAttribute('class')) : array();

    if ($item->isCurrent())
    {
      $class[] = 'active';
    }
    elseif ($item->isCurrentAncestor($depth))
    {
      $class[] = 'current_ancestor';
    }

    if ($item->actsLikeFirst())
    {
      $class[] = 'first';
    }
    if ($item->actsLikeLast())
    {
      $class[] = 'last';
    }
    
    // retrieve the attributes and put the final class string back on it
    $attributes = $item->getAttributes();
    
    if ($item->hasChildren()) {
        $item->setLinkOptions(array('class' => 'dropdown-toggle'));
        $class[] = 'dropdown';
        $attributes['data-dropdown'] = 'dropdown';  
    }

    if (count($class) > 0)
    {
      $attributes['class'] = implode(' ', $class);
    }

    // opening li tag
    $html = '<li'._tag_options($attributes).'>';

    // render the text/link inside the li tag
    $html .= (null !== $item->getRoute()) ? $item->renderLink() : $item->renderLabel();

    // renders the embedded ul if there are visible children
    $html .= render_bootstrap_menu($item, $depth, true);

    // closing li tag
    $html .= '</li>';

    return $html;
    
}