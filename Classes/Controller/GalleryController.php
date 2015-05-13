<?php
namespace deCode\FastGallery\Controller;
/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2015 Adrian Mot <adi@decode.ro>, deCode
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/
/**
 * GalleryController
 */
class GalleryController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {
	
	/**
	 * action list
	 *
	 * @return void
	 */
	public function listAction() {

		$galleryPath = PATH_site.trim($this->settings['galleryPath']);
		if ( substr($galleryPath, -1)!='/' ) {
			$galleryPath .= '/';
		}
		
		$filesArr = \TYPO3\CMS\Core\Utility\GeneralUtility::getFilesInDir($galleryPath, $this->settings['extensions'], TRUE);
		
		$images = array();
		foreach ($filesArr as $file) {
			$falInstance = \TYPO3\CMS\Core\Resource\ResourceFactory::getInstance()->retrieveFileOrFolderObject($file);
			if ($falInstance) {
				$images[] = $falInstance->getUid();
			}
		}
		$this->view->assignMultiple(
			array(
				'images' => $images,
				'settings' => $this->settings,
				'currentPage' => ($this->request->hasArgument('currentPage') ? $this->request->getArgument('currentPage') : 1)
			)
		);
	}
}