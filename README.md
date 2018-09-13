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

Include PageTS
----------------------

The extension ships TSConfig too:

1. Switch to your root page
2. Edit the page
3. Switch to Resources
4. Include **Foundation Zurb - BackendLayouts (foundation_zurb_framework)**
5. Include **Foundation Zurb - PageTS (foundation_zurb_framework)**
6. Save

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


Attention
------------------

For the foundation Button, the **expanded** classes are not yet implemeted with the Foundation Zurb 6.4.3 so if you really want to use it you should include the following CSS to your project:

https://gist.github.com/rafibomb/2497ca75ceedfa3f5ccf3ba146eae295


Include a navigation menu
------------------

The version 1.0.6 brings the Foundation Zurb responsive navigation. How you can use it:

