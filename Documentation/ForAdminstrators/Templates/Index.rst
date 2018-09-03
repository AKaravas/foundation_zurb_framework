
.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../Includes.txt


.. _templates:

General configuration
============
You do not have to configure anything other the templates. 

TypoScript
^^^^^^^^^^

Including the Foundation Framework
---------------------

The extension does not ship the Foundation Zurb CSS/JS files. This way, you can choose the version you would like to have.

**JS**

.. code-block:: typoscript 

	page.includeJSFooterlibs {
		jQuery = EXT:yourExtenstion/Resources/Public/JavaScript/Vendor/jquery.min.js
		jQuery {
       		allWrap = <!--[if gte IE 9]><!-->|<!--<![endif]-->
        	forceOnTop = 1
    	}
		jqueryUI = EXT:yourExtenstion/Resources/Public/Vendor/jquery-ui.js
		foundationCore = EXT:yourExtenstion/Resources/Public/Vendor/foundation.min.js
		 # load older jQuery version for older browsers < IE9
	    jQueryOld = EXT:yourExtenstion/Resources/Public/JavaScript/Vendor/jquery-1.12.0.min.js
	    jQueryOld {
	        allWrap = <!--[if lt IE 9]>|<![endif]-->
	        forceOnTop = 1
	    }
	}
	page.includeJSFooter {
		motionUi = EXT:yourExtenstion/Resources/Public/JavaScript/Vendor/motion-ui.min.js
	}

**CSS**

	.. code-block:: typoscript 

		page.includeCSS {
			foundationCss = EXT:yourExtenstion/Resources/Public/Css/foundation.min.css
			motionUi = EXT:yourExtenstion/Resources/Public/Css/motion-ui.min.css
		}

You can find the Motion-UI library here: https://zurb.com/playground/motion-ui

Changing paths of the template. 
---------------------

Define on your TypoScript file the path that your templates are located.

.. code-block:: typoscript

   	tt_content {
      	foundation_reveal {
			templateRootPaths.500 = EXT:yourExtention/Resources/Private/Templates/
			partialRootPaths.500 = EXT:yourExtention/Resources/Private/Partials/
			templateName = Reveal.html
		}
   	}



