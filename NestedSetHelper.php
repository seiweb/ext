<?php

namespace seiweb\ext;
use yii\helpers\BaseArrayHelper;

/**
 * Created by PhpStorm.
 * User: developer
 * Date: 23.02.2017
 * Time: 23:17
 */
class NestedSetHelper extends BaseArrayHelper
{
	/**
	 * Конвертирует упорядоченную структуру NestedSet в многомерный массив дл посороения меню
	 * @param $collection
	 * @return array
	 */
	public static function toHierarchy($collection,$urlAttribute='full_slug',$main_page_slug = '/')
	{
		// Trees mapped
		$trees = array();
		$l = 0;

		if (count($collection) > 0) {
			// Node Stack. Used to help building the hierarchy
			$stack = array();

			foreach ($collection as $node) {
				$item = [
					'label'=>$node['title'],
					'depth'=>$node['depth'],
					'url'=>$node['is_main']==1?$main_page_slug:'/'.$node[$urlAttribute]
				];
				$item['items'] = array();

				// Number of stack items
				$l = count($stack);

				// Check if we're dealing with different levels
				while($l > 0 && $stack[$l - 1]['depth'] >= $item['depth']) {
					array_pop($stack);
					$l--;
				}

				// Stack is empty (we are inspecting the root)
				if ($l == 0) {
					// Assigning the root node
					$i = count($trees);
					$trees[$i] = $item;
					$stack[] = & $trees[$i];
				} else {
					// Add node to parent
					$i = count($stack[$l - 1]['items']);
					$stack[$l - 1]['items'][$i] = $item;
					$stack[] = & $stack[$l - 1]['items'][$i];
				}
			}
		}

		return $trees;
	}
}