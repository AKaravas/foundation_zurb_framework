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

You first need some small TypoScript. The TypoScript after the dataProcessing has to be identical. A simple example:

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
                  100 = TYPO3\CMS\Frontend\DataProcessing\MenuProcessor
                  100 {
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
              }
          }
      }

.. _menuTemplate:

Copying the template:
----------------------

Copy the **foundation_zurb_framework/Resources/Private/Partials/Menu/ResponsiveNavigation.html** on your extenstion
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


IMPORTANT
----------------------

On the **Foundation Tab** you will find some magellan settings. They are not yet implemented. They will be soon though.
   
