<?php
declare(strict_types=1);
namespace In2code\Migration\Command;

use In2code\Migration\Migration\Exception\ConfigurationException;
use Symfony\Component\Console\Command\Command;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Class AbstractPortCommand to deliver a basic configuration for Export- and ImportCommand
 */
abstract class AbstractPortCommand extends Command
{
    const CONFIGURATION_PATH = 'EXT:migration/Configuration/Port.php';

    /**
     * @param string $configurationPath
     * @return array
     * @throws ConfigurationException
     */
    protected function getCompleteConfiguration(string $configurationPath): array
    {
        $path = GeneralUtility::getFileAbsFileName($configurationPath);
        if (is_file($path) === false) {
            throw new ConfigurationException('File not found on ' . $path, 1569837808);
        }
        /** @noinspection PhpIncludeInspection */
        $configuration = require_once $path;
        return $configuration;
    }
}