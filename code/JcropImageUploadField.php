<?php

/**
 * @author Brice Burgess
 */


class JcropImageUploadField extends ImageUploadField
{
	// e.g. $field->setAspectRatio(16/9);
	public $aspectRatio = 0;
	
	/**
	 * Force the object to accept only images.
	 *
	 * @return UploadifyField
	 */
	public function FieldHolder() {
		Requirements::javascript(UPLOADIFY_JCROP_DIRECTORY . '/thirdparty/jcrop/js/jquery.Jcrop.min.js');
		Requirements::javascript(UPLOADIFY_JCROP_DIRECTORY . '/thirdparty/jqModal.js');
		Requirements::css(UPLOADIFY_JCROP_DIRECTORY . '/thirdparty/jcrop/css/jquery.Jcrop.min.css');
		
		Requirements::css(UPLOADIFY_JCROP_DIRECTORY . '/css/uploadify-jcrop.css');
		Requirements::javascript(UPLOADIFY_JCROP_DIRECTORY . '/js/uploadify-jcrop.js');
		
		return parent::FieldHolder();
	}
	
	
	public function setAspectRatio($ratio) {
		$this->aspectRatio = $ratio;
	}
	
	
	public function AspectRatio() { return $this->aspectRatio; }
	
	
	public function cropfile(){
		if(!Permission::check("CMS_ACCESS_CMSMain"))
			return;
		
		if(isset($_REQUEST['FileID']) && is_numeric($_REQUEST['FileID'])) {
			if($file = DataObject::get_by_id($this->baseFileClass, $_REQUEST['FileID'])) {
				// crop the image
				
				$gd = new GD(Director::baseFolder()."/" . $file->Filename);
				if($gd->hasGD()){
					
					$gd
						->crop($_REQUEST['y'], $_REQUEST['x'], $_REQUEST['w'], $_REQUEST['h'])
						->writeTo(Director::baseFolder()."/" . $file->Filename);
					
					$file->deleteFormattedImages();
				}
			}
		}
		
	}
	
	
}