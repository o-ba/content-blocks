<?php

declare(strict_types=1);

/*
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */

namespace TYPO3\CMS\ContentBlocks\Utility;

use TYPO3\CMS\ContentBlocks\Definition\ContentType\ContentType;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * @internal Not part of TYPO3's public API.
 */
class ContentBlockPathUtility
{
    public static function getContentBlockExtPath(string $extensionKey, string $contentBlockFolderName, ContentType $contentType): string
    {
        $contentTypeFolder = match ($contentType) {
            ContentType::CONTENT_ELEMENT => self::getRelativeContentElementsPath(),
            ContentType::PAGE_TYPE => self::getRelativePageTypesPath(),
            ContentType::RECORD_TYPE => self::getRelativeRecordTypesPath(),
        };
        return 'EXT:' . $extensionKey . '/' . $contentTypeFolder . '/' . $contentBlockFolderName;
    }

    public static function getContentBlockDefinitionFileName(): string
    {
        return 'EditorInterface.yaml';
    }

    public static function getBackendPreviewFileName(): string
    {
        return 'EditorPreview.html';
    }

    public static function getBackendPreviewFileNameWithoutExtension(): string
    {
        return substr(self::getBackendPreviewFileName(), 0, -5);
    }

    public static function getBackendPreviewPath(): string
    {
        return self::getPrivateFolder() . '/' . self::getBackendPreviewFileName();
    }

    public static function getFrontendTemplateFileName(): string
    {
        return 'Frontend.html';
    }

    public static function getFrontendTemplateFileNameWithoutExtension(): string
    {
        return substr(self::getFrontendTemplateFileName(), 0, -5);
    }

    public static function getFrontendTemplatePath(): string
    {
        return self::getPrivateFolder() . '/' . self::getFrontendTemplateFileName();
    }

    public static function getLanguageFolderPath(): string
    {
        return self::getPrivateFolder() . '/Language';
    }

    public static function getLanguageFilePath(): string
    {
        return self::getLanguageFolderPath() . '/Labels.xlf';
    }

    public static function getIconNameWithoutFileExtension(): string
    {
        return 'Icon';
    }

    public static function getIconHideInMenuNameWithoutFileExtension(): string
    {
        return 'IconHideInMenu';
    }

    public static function getIconRootNameWithoutFileExtension(): string
    {
        return 'IconRoot';
    }

    public static function getIconPathWithoutFileExtension(): string
    {
        return self::getPublicFolder() . '/' . self::getIconNameWithoutFileExtension();
    }

    public static function getHideInMenuIconPathWithoutFileExtension(): string
    {
        return self::getPublicFolder() . '/' . self::getIconHideInMenuNameWithoutFileExtension();
    }

    public static function getRelativeContentElementsPath(): string
    {
        return self::getSubDirectoryName() . '/' . self::getContentElementsFolder();
    }

    public static function getRelativePageTypesPath(): string
    {
        return self::getSubDirectoryName() . '/' . self::getPageTypesFolder();
    }

    public static function getRelativeRecordTypesPath(): string
    {
        return self::getSubDirectoryName() . '/' . self::getRecordTypesFolder();
    }

    public static function getSubDirectoryName(): string
    {
        return 'ContentBlocks';
    }

    public static function getContentElementsFolder(): string
    {
        return 'ContentElements';
    }

    public static function getPageTypesFolder(): string
    {
        return 'PageTypes';
    }

    public static function getRecordTypesFolder(): string
    {
        return 'RecordTypes';
    }

    public static function getPublicFolder(): string
    {
        return 'Assets';
    }

    public static function getPrivateFolder(): string
    {
        return 'Source';
    }

    public static function getHostExtPublicContentBlockBasePath(string $hostExtension): string
    {
        return 'EXT:' . $hostExtension . '/Resources/Public/ContentBlocks';
    }

    public static function getHostExtPublicContentBlockPath(string $hostExtension, string $name): string
    {
        $extPathBase = self::getHostExtPublicContentBlockBasePath($hostExtension);
        return $extPathBase . '/' . $name;
    }

    public static function getHostAbsolutePublicContentBlockBasePath(string $hostExtension): string
    {
        $extPath = self::getHostExtPublicContentBlockBasePath($hostExtension);
        $assetsPath = GeneralUtility::getFileAbsFileName($extPath);
        return $assetsPath;
    }

    public static function getHostAbsolutePublicContentBlockPath(string $hostExtension, string $name): string
    {
        $assetsPath = self::getHostAbsolutePublicContentBlockBasePath($hostExtension);
        $assetsPath .= '/' . $name;
        return $assetsPath;
    }

    public static function getBasicsFolder(): string
    {
        return 'Basics';
    }

    public static function getRelativeBasicsPath(): string
    {
        return self::getSubDirectoryName() . '/' . self::getBasicsFolder();
    }
}
