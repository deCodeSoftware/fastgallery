<?php

namespace deCode\FastGallery\ViewHelpers;

use TYPO3\CMS\Core\Utility\GeneralUtility;

class FastGalleryPaginatorViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper {
	/**
	 * Render everything
	 *
	 * @param Array $images the array containing the images
	 * @param string $as name of property which holds the images
	 * @param integer $currentPage Selected page
	 * @param Array $settings settings that come from the extension
	 * @return string
	 */
	public function render( Array $images, $as, $currentPage, Array $settings) {

		$numberOfPages = ceil(count($images)/$settings['imagesPerPage']);

		$index1 = 0;
		for( $index = 0; $index < count($images); $index++) {
			if( $index%$settings['imagesPerPage'] == 0 ) {
				$index1++;
			}
			$pages[$index1][] = $images[$index];
		}

		if( $numberOfPages == 1 ) {
			$result = $pages;
		} else {
			$currentPage = (int)$currentPage;
			if( $currentPage < 1 ) {
				$currentPage = 1;
			} elseif( $currentPage > $numberOfPages ) {
				$currentPage = $numberOfPages;
			}
			$result = $pages[$currentPage];
		}

		$pages_list = array();
		for ($i = 1; $i <= $numberOfPages; $i ++) {
			$pages_list[] = array('number' => $i, 'isCurrent' => ($i === $currentPage));
		}

		$pagination = array(
			'pages' => $pages,
			'pages_list' => $pages_list,
			'numberOfPages' => $numberOfPages,
			'current' => $currentPage
		);

		if ($currentPage < $numberOfPages) {
			$pagination['nextPage'] = $currentPage + 1;
		}
		if ($currentPage > 1) {
			$pagination['previousPage'] = $currentPage - 1;
		}

		$this->templateVariableContainer->add($as, $result);
		$this->templateVariableContainer->add('pagination', $pagination);

		return $this->renderChildren();
	}
}