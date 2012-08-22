silverstripe-uploaldify-jcrop
=============================

Adds jQuery Jcrop functionality to images in the SilverStripe CMS.
Supports constraining Image Crop Area to an Aspect Ratio.
Built on Jcrop version 0.9.10 (http://deepliquid.com/content/Jcrop.html)

## Requirements

* SilverStripe 2.4+
* Uploadify ( https://github.com/unclecheese/Uploadify )

## Basic Usage

Implement JcropImageUploadField (which in term extends Uploadify's ImageUploadField)

	class Spotlight extends DataObject {
		static $media_upload_folder	= 'spotlights';
		
		static $db = array(
			'Title'				=> 'Varchar',
		//	....
		);
		
		static $has_one = array(
			'Graphic'			=> 'Image'
		);
		
		public function getCMSFields($params = null){
			$fields = parent::getCMSFields($params);
			
			$field = new JcropImageUploadField('Graphic');
			$field->uploadFolder = self::$media_upload_folder;
			$field->setAspectRatio(16/9);
			
			$fields->replaceField('Graphic',$field);
			
			// ...
			
			return $fields;
		}
		
		
	}



## Maintainer Contacts

* Brice Burgess <brice@digome.com>


## License

This module is licensed under the BSD license at http://silverstripe.org/BSD-license

## Project Links
* [GitHub Project Page](https://github.com/briceburg/silverstripe-uploaldify-jcrop)
* [Issue Tracker](https://github.com/briceburg/silverstripe-uploaldify-jcrop/issues)
