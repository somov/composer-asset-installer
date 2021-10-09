<?php

namespace Somov\Installer;

use Composer\Installer\LibraryInstaller;
use Composer\Package\PackageInterface;


/**
 * Class Installer
 * @package Somov\Installer
 */
class Installer extends LibraryInstaller
{
    protected static $TYPE = 'composer-asset';

    protected static $ASSET_TYPE_NPM = 'npm';
    protected static $ASSET_TYPE_BOWER = 'bower';
    protected static $EXTRA_ASSET_TYPE = 'installer-asset-type';
    protected static $EXTRA_ASSET_NAME = 'installer-asset-name';
    protected static $EXTRA_ASSET_SUFFIX = 'installer-asset-suffix';


    /**
     * {@inheritDoc}
     */
    public function getInstallPath(PackageInterface $package)
    {
        $extra = $package->getExtra();
        $this->initializeVendorDir();
        $basePath = ($this->vendorDir ? $this->vendorDir.'/' : '');

        $type = $this->getExtraValue(self::$EXTRA_ASSET_TYPE, $extra, self::$ASSET_TYPE_NPM);

        if ( ($type !== self::$ASSET_TYPE_NPM) && ($type !== self::$ASSET_TYPE_BOWER)) {
            throw  new \RuntimeException('Invalid asset type '.$type);
        }

        $type .= $this->getExtraValue(self::$EXTRA_ASSET_SUFFIX, $extra, '-asset') ;
        $name = $this->getExtraValue(self::$EXTRA_ASSET_NAME, $extra, $package->getPrettyName());

        return $basePath . $type . DIRECTORY_SEPARATOR . $name;
    }

    /**
     * {@inheritDoc}
     */
    public function supports($packageType)
    {
        return self::$TYPE === $packageType;
    }

    /**
     * @param string $name
     * @param array $extra
     * @param string $default
     * @return string
     */
    private function getExtraValue($name, $extra, $default){

        if (isset($extra[$name]) && false === empty($name) ) {
            return $extra[$name];
        }
        return $default;
    }
}
