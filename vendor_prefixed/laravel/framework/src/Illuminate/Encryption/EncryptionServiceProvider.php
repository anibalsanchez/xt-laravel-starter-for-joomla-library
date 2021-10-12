<?php
/* This file has been prefixed by <PHP-Prefixer> for "XT Laravel Starter for Joomla" */

namespace Extly\Illuminate\Encryption;

use Extly\Illuminate\Support\ServiceProvider;
use Extly\Illuminate\Support\Str;
use Extly\Laravel\SerializableClosure\SerializableClosure;
use Extly\Opis\Closure\SerializableClosure as OpisSerializableClosure;

class EncryptionServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerEncrypter();
        $this->registerOpisSecurityKey();
        $this->registerSerializableClosureSecurityKey();
    }

    /**
     * Register the encrypter.
     *
     * @return void
     */
    protected function registerEncrypter()
    {
        $this->app->singleton('encrypter', function ($app) {
            $config = $app->make('config')->get('app');

            return new Encrypter($this->parseKey($config), $config['cipher']);
        });
    }

    /**
     * Configure Opis Closure signing for security.
     *
     * @return void
     *
     * @deprecated Will be removed in a future Laravel version.
     */
    protected function registerOpisSecurityKey()
    {
        if (\PHP_VERSION_ID < 80100) {
            $config = $this->app->make('config')->get('app');

            if (! class_exists(OpisSerializableClosure::class) || empty($config['key'])) {
                return;
            }

            OpisSerializableClosure::setSecretKey($this->parseKey($config));
        }
    }

    /**
     * Configure Serializable Closure signing for security.
     *
     * @return void
     */
    protected function registerSerializableClosureSecurityKey()
    {
        $config = $this->app->make('config')->get('app');

        if (! class_exists(SerializableClosure::class) || empty($config['key'])) {
            return;
        }

        SerializableClosure::setSecretKey($this->parseKey($config));
    }

    /**
     * Parse the encryption key.
     *
     * @param  array  $config
     * @return string
     */
    protected function parseKey(array $config)
    {
        if (Str::startsWith($key = $this->key($config), $prefix = 'base64:')) {
            $key = base64_decode(Str::after($key, $prefix));
        }

        return $key;
    }

    /**
     * Extract the encryption key from the given configuration.
     *
     * @param  array  $config
     * @return string
     *
     * @throws \Illuminate\Encryption\MissingAppKeyException
     */
    protected function key(array $config)
    {
        return XT_tap($config['key'], function ($key) {
            if (empty($key)) {
                throw new MissingAppKeyException;
            }
        });
    }
}
