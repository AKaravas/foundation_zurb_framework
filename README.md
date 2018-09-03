# Foundation Zurb Framework, TYPO3 Extension

Create Foundation content elements in TYPO3

For adminstrators
------------------
The extension needs to be installed as any other extension of TYPO3 CMS:
	1. Switch on the **Extensions** module
	2. On the upper left corner select the **"Get Extensions"** from the select menu
	3. On the search bar, type: **foundation_zurb_framework**
	4. Click on the cloud icon and download the extension

Preparation: Include static TypoScript
----------------------

The extension ships some TypoScript code which needs to be included.

1. Switch on the **Template module**
2. Go to your root page
3. Switch to the **Edit the whole template record**
4. Switch to the **Includes** tab
5. Choose the **Include Foundation Zurb** static template
6. Save and close your settings

Include your version of Foundation Zurb
----------------------

https://github.com/AKaravas/foundation_zurb_framework/blob/master/Documentation/ForAdminstrators/Templates/Index.rst

Apply your own templates
----------------------

Define on your TypoScript file the path that your templates are located.

   	tt_content {
      	foundation_reveal {
			templateRootPaths.500 = EXT:yourExtention/Resources/Private/Templates/
			partialRootPaths.500 = EXT:yourExtention/Resources/Private/Partials/
			templateName = Reveal.html
		}
   	}

For editors
------------------

1. Switch on the **Page** module
2. Choose the page on the Pagetree that you would like the content element to be placed
3. Click on the content button to create a new content element
4. Switch to **Foundation Zurb Elements**
5. Choose your content element