.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../Includes.txt

.. _navigationSection:

Include a menu
============
This walkthrough will help you to implement a menu on your website

.. only:: html

.. contents::
        :local:
        :depth: 1

.. _typoscript:

TypoScript
------------------

You first need some small TypoScript. The TypoScript after the dataProcessing has to be identical (except the 7000 etc). A simple example:

  .. code-block:: typoscript 

      page = PAGE
      page {
        10 = FLUIDTEMPLATE
        10 {
          template = FILE
          template.file = EXT:yourExtension/Resources/Private/Templates/index.html
          partialRootPath = EXT:yourExtension/Resources/Private/Partials/
          layoutRootPath =  EXT:yourExtension/Resources/Private/Layouts/
          variables {
              ContentElement10 < styles.content.get
              ContentElement10.select.where = colPos=10
          }
          dataProcessing {
            7000 = TYPO3\CMS\Frontend\DataProcessing\MenuProcessor
            7000 {
                levels = 3
                includeSpacer = 1
                as = mainnavigation
                entryLevel = 0
                dataProcessing {
                    10 = TYPO3\CMS\Frontend\DataProcessing\FilesProcessor
                    10 {
                        references.fieldName = nav_image
                    }
                }
            }
            7010 = TYPO3\CMS\Frontend\DataProcessing\MenuProcessor
            7010 {
              special = rootline
              special.range = 0|-1
              includeNotInMenu = 1
              as = menuBreadcrumb
            }
          }
        }
      }

.. _menuTemplate:

Copying the template:
----------------------

**Foundation Zurb responsive navigation menu**

Copy the **foundation_zurb_framework/Resources/Private/Partials/Menu/ResponsiveNavigation.html** on your extenstion
and include it on your template. You can edited however you want.

**Foundation Zurb magellan navigation menu**

Copy the **foundation_zurb_framework/Resources/Private/Partials/Menu/MagellanNavigation.html** on your extenstion
and include it on your template. You can edited however you want.


.. _icons:

Including Icons:
----------------------

If you want to use the **fontawesome** library or any other library, include first the appropriate CSS/JS/Fonts on your TypoScript
When the configuration and the copying is done:

1. Switch on the **Page** module
2. On the upper middle section select the **"Edit page properties"** from the select menu
3. Switch on the **Foundation** tab
4. On the icon field, insert the full class of your element. (Example: fab fa-apple)


Magellan Settings
----------------------

1. Create the pages on the tree page.
2. Once this is done, switch to the **page properties**
3. On the **Foundation** tab you ll find the **Magellan Settings** and in the **magellan ID** put the archor name that it links to.
4. If you are on the **root** page you can configure the rest of the magellan settings. **These settings will not be applied if they are configured on pages other than the root**
   
