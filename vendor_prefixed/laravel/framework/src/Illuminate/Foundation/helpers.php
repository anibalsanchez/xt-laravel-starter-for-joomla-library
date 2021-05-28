<?php
/* This file has been prefixed by <PHP-Prefixer> for "XT Laravel Starter for Joomla" */

use Extly\Illuminate\Container\Container;
use Extly\Illuminate\Contracts\Auth\Access\Gate;
use Extly\Illuminate\Contracts\Auth\Factory as AuthFactory;
use Extly\Illuminate\Contracts\Broadcasting\Factory as BroadcastFactory;
use Extly\Illuminate\Contracts\Bus\Dispatcher;
use Extly\Illuminate\Contracts\Cookie\Factory as CookieFactory;
use Extly\Illuminate\Contracts\Debug\ExceptionHandler;
use Extly\Illuminate\Contracts\Routing\ResponseFactory;
use Extly\Illuminate\Contracts\Routing\UrlGenerator;
use Extly\Illuminate\Contracts\Support\Responsable;
use Extly\Illuminate\Contracts\Validation\Factory as ValidationFactory;
use Extly\Illuminate\Contracts\View\Factory as ViewFactory;
use Extly\Illuminate\Foundation\Bus\PendingClosureDispatch;
use Extly\Illuminate\Foundation\Bus\PendingDispatch;
use Extly\Illuminate\Foundation\Mix;
use Extly\Illuminate\Http\Exceptions\HttpResponseException;
use Extly\Illuminate\Queue\CallQueuedClosure;
use Extly\Illuminate\Support\Facades\Date;
use Extly\Illuminate\Support\HtmlString;
use Extly\Symfony\Component\HttpFoundation\Response;

if (! function_exists('XT_abort')) {
    /**
     * Throw an HttpException with the given data.
     *
     * @param  \Symfony\Component\HttpFoundation\Response|\Illuminate\Contracts\Support\Responsable|int  $code
     * @param  string  $message
     * @param  array  $headers
     * @return void
     *
     * @throws \Symfony\Component\HttpKernel\Exception\HttpException
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     */
    function XT_abort($code, $message = '', array $headers = [])
    {
        if ($code instanceof Response) {
            throw new HttpResponseException($code);
        } elseif ($code instanceof Responsable) {
            throw new HttpResponseException($code->toResponse(XT_request()));
        }

        XT_app()->abort($code, $message, $headers);
    }
}

if (! function_exists('XT_abort_if')) {
    /**
     * Throw an HttpException with the given data if the given condition is true.
     *
     * @param  bool  $boolean
     * @param  \Symfony\Component\HttpFoundation\Response|\Illuminate\Contracts\Support\Responsable|int  $code
     * @param  string  $message
     * @param  array  $headers
     * @return void
     *
     * @throws \Symfony\Component\HttpKernel\Exception\HttpException
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     */
    function XT_abort_if($boolean, $code, $message = '', array $headers = [])
    {
        if ($boolean) {
            XT_abort($code, $message, $headers);
        }
    }
}

if (! function_exists('XT_abort_unless')) {
    /**
     * Throw an HttpException with the given data unless the given condition is true.
     *
     * @param  bool  $boolean
     * @param  \Symfony\Component\HttpFoundation\Response|\Illuminate\Contracts\Support\Responsable|int  $code
     * @param  string  $message
     * @param  array  $headers
     * @return void
     *
     * @throws \Symfony\Component\HttpKernel\Exception\HttpException
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     */
    function XT_abort_unless($boolean, $code, $message = '', array $headers = [])
    {
        if (! $boolean) {
            XT_abort($code, $message, $headers);
        }
    }
}

if (! function_exists('XT_action')) {
    /**
     * Generate the URL to a controller action.
     *
     * @param  string|array  $name
     * @param  mixed  $parameters
     * @param  bool  $absolute
     * @return string
     */
    function XT_action($name, $parameters = [], $absolute = true)
    {
        return XT_app('url')->action($name, $parameters, $absolute);
    }
}

if (! function_exists('XT_app')) {
    /**
     * Get the available container instance.
     *
     * @param  string|null  $abstract
     * @param  array  $parameters
     * @return mixed|\Illuminate\Contracts\Foundation\Application
     */
    function XT_app($abstract = null, array $parameters = [])
    {
        if (is_null($abstract)) {
            return Container::getInstance();
        }

        return Container::getInstance()->make($abstract, $parameters);
    }
}

if (! function_exists('XT_app_path')) {
    /**
     * Get the path to the application folder.
     *
     * @param  string  $path
     * @return string
     */
    function XT_app_path($path = '')
    {
        return XT_app()->path($path);
    }
}

if (! function_exists('XT_asset')) {
    /**
     * Generate an asset path for the application.
     *
     * @param  string  $path
     * @param  bool|null  $secure
     * @return string
     */
    function XT_asset($path, $secure = null)
    {
        return XT_app('url')->asset($path, $secure);
    }
}

if (! function_exists('XT_auth')) {
    /**
     * Get the available auth instance.
     *
     * @param  string|null  $guard
     * @return \Illuminate\Contracts\Auth\Factory|\Illuminate\Contracts\Auth\Guard|\Illuminate\Contracts\Auth\StatefulGuard
     */
    function XT_auth($guard = null)
    {
        if (is_null($guard)) {
            return XT_app(AuthFactory::class);
        }

        return XT_app(AuthFactory::class)->guard($guard);
    }
}

if (! function_exists('XT_back')) {
    /**
     * Create a new redirect response to the previous location.
     *
     * @param  int  $status
     * @param  array  $headers
     * @param  mixed  $fallback
     * @return \Illuminate\Http\RedirectResponse
     */
    function XT_back($status = 302, $headers = [], $fallback = false)
    {
        return XT_app('XT_redirect')->back($status, $headers, $fallback);
    }
}

if (! function_exists('XT_base_path')) {
    /**
     * Get the path to the base of the install.
     *
     * @param  string  $path
     * @return string
     */
    function XT_base_path($path = '')
    {
        return XT_app()->basePath($path);
    }
}

if (! function_exists('XT_bcrypt')) {
    /**
     * Hash the given value against the bcrypt algorithm.
     *
     * @param  string  $value
     * @param  array  $options
     * @return string
     */
    function XT_bcrypt($value, $options = [])
    {
        return XT_app('hash')->driver('bcrypt')->make($value, $options);
    }
}

if (! function_exists('XT_broadcast')) {
    /**
     * Begin broadcasting an event.
     *
     * @param  mixed|null  $event
     * @return \Illuminate\Broadcasting\PendingBroadcast
     */
    function XT_broadcast($event = null)
    {
        return XT_app(BroadcastFactory::class)->event($event);
    }
}

if (! function_exists('XT_cache')) {
    /**
     * Get / set the specified cache value.
     *
     * If an array is passed, we'll assume you want to put to the cache.
     *
     * @param  dynamic  key|key,default|data,expiration|null
     * @return mixed|\Illuminate\Cache\CacheManager
     *
     * @throws \Exception
     */
    function XT_cache()
    {
        $arguments = func_get_args();

        if (empty($arguments)) {
            return XT_app('cache');
        }

        if (is_string($arguments[0])) {
            return XT_app('cache')->get(...$arguments);
        }

        if (! is_array($arguments[0])) {
            throw new Exception(
                'When setting a value in the cache, you must pass an array of key / value pairs.'
            );
        }

        return XT_app('cache')->put(key($arguments[0]), reset($arguments[0]), $arguments[1] ?? null);
    }
}

if (! function_exists('XT_config')) {
    /**
     * Get / set the specified configuration value.
     *
     * If an array is passed as the key, we will assume you want to set an array of values.
     *
     * @param  array|string|null  $key
     * @param  mixed  $default
     * @return mixed|\Illuminate\Config\Repository
     */
    function XT_config($key = null, $default = null)
    {
        if (is_null($key)) {
            return XT_app('config');
        }

        if (is_array($key)) {
            return XT_app('config')->set($key);
        }

        return XT_app('config')->get($key, $default);
    }
}

if (! function_exists('XT_config_path')) {
    /**
     * Get the configuration path.
     *
     * @param  string  $path
     * @return string
     */
    function XT_config_path($path = '')
    {
        return XT_app()->configPath($path);
    }
}

if (! function_exists('XT_cookie')) {
    /**
     * Create a new cookie instance.
     *
     * @param  string|null  $name
     * @param  string|null  $value
     * @param  int  $minutes
     * @param  string|null  $path
     * @param  string|null  $domain
     * @param  bool|null  $secure
     * @param  bool  $httpOnly
     * @param  bool  $raw
     * @param  string|null  $sameSite
     * @return \Illuminate\Cookie\CookieJar|\Symfony\Component\HttpFoundation\Cookie
     */
    function XT_cookie($name = null, $value = null, $minutes = 0, $path = null, $domain = null, $secure = null, $httpOnly = true, $raw = false, $sameSite = null)
    {
        $cookie = XT_app(CookieFactory::class);

        if (is_null($name)) {
            return $cookie;
        }

        return $cookie->make($name, $value, $minutes, $path, $domain, $secure, $httpOnly, $raw, $sameSite);
    }
}

if (! function_exists('XT_csrf_field')) {
    /**
     * Generate a CSRF token form field.
     *
     * @return \Illuminate\Support\HtmlString
     */
    function XT_csrf_field()
    {
        return new HtmlString('<input type="hidden" name="_token" value="'.XT_csrf_token().'">');
    }
}

if (! function_exists('XT_csrf_token')) {
    /**
     * Get the CSRF token value.
     *
     * @return string
     *
     * @throws \RuntimeException
     */
    function XT_csrf_token()
    {
        $session = XT_app('session');

        if (isset($session)) {
            return $session->token();
        }

        throw new RuntimeException('Application session store not set.');
    }
}

if (! function_exists('XT_database_path')) {
    /**
     * Get the database path.
     *
     * @param  string  $path
     * @return string
     */
    function XT_database_path($path = '')
    {
        return XT_app()->databasePath($path);
    }
}

if (! function_exists('XT_decrypt')) {
    /**
     * Decrypt the given value.
     *
     * @param  string  $value
     * @param  bool  $unserialize
     * @return mixed
     */
    function XT_decrypt($value, $unserialize = true)
    {
        return XT_app('encrypter')->decrypt($value, $unserialize);
    }
}

if (! function_exists('dispatch')) {
    /**
     * Dispatch a job to its appropriate handler.
     *
     * @param  mixed  $job
     * @return \Illuminate\Foundation\Bus\PendingDispatch
     */
    function dispatch($job)
    {
        return $job instanceof Closure
                ? new PendingClosureDispatch(CallQueuedClosure::create($job))
                : new PendingDispatch($job);
    }
}

if (! function_exists('XT_dispatch_sync')) {
    /**
     * Dispatch a command to its appropriate handler in the current process.
     *
     * Queueable jobs will be dispatched to the "sync" queue.
     *
     * @param  mixed  $job
     * @param  mixed  $handler
     * @return mixed
     */
    function XT_dispatch_sync($job, $handler = null)
    {
        return XT_app(Dispatcher::class)->dispatchSync($job, $handler);
    }
}

if (! function_exists('XT_dispatch_now')) {
    /**
     * Dispatch a command to its appropriate handler in the current process.
     *
     * @param  mixed  $job
     * @param  mixed  $handler
     * @return mixed
     *
     * @deprecated Will be removed in a future Laravel version.
     */
    function XT_dispatch_now($job, $handler = null)
    {
        return XT_app(Dispatcher::class)->dispatchNow($job, $handler);
    }
}

if (! function_exists('XT_encrypt')) {
    /**
     * Encrypt the given value.
     *
     * @param  mixed  $value
     * @param  bool  $serialize
     * @return string
     */
    function XT_encrypt($value, $serialize = true)
    {
        return XT_app('encrypter')->encrypt($value, $serialize);
    }
}

if (! function_exists('XT_event')) {
    /**
     * Dispatch an event and call the listeners.
     *
     * @param  string|object  $event
     * @param  mixed  $payload
     * @param  bool  $halt
     * @return array|null
     */
    function XT_event(...$args)
    {
        return XT_app('events')->dispatch(...$args);
    }
}

if (! function_exists('XT_info')) {
    /**
     * Write some information to the log.
     *
     * @param  string  $message
     * @param  array  $context
     * @return void
     */
    function XT_info($message, $context = [])
    {
        XT_app('log')->info($message, $context);
    }
}

if (! function_exists('XT_logger')) {
    /**
     * Log a debug message to the logs.
     *
     * @param  string|null  $message
     * @param  array  $context
     * @return \Illuminate\Log\LogManager|null
     */
    function XT_logger($message = null, array $context = [])
    {
        if (is_null($message)) {
            return XT_app('log');
        }

        return XT_app('log')->debug($message, $context);
    }
}

if (! function_exists('XT_logs')) {
    /**
     * Get a log driver instance.
     *
     * @param  string|null  $driver
     * @return \Illuminate\Log\LogManager|\Psr\Log\LoggerInterface
     */
    function XT_logs($driver = null)
    {
        return $driver ? XT_app('log')->driver($driver) : XT_app('log');
    }
}

if (! function_exists('XT_method_field')) {
    /**
     * Generate a form field to spoof the HTTP verb used by forms.
     *
     * @param  string  $method
     * @return \Illuminate\Support\HtmlString
     */
    function XT_method_field($method)
    {
        return new HtmlString('<input type="hidden" name="_method" value="'.$method.'">');
    }
}

if (! function_exists('XT_mix')) {
    /**
     * Get the path to a versioned Mix file.
     *
     * @param  string  $path
     * @param  string  $manifestDirectory
     * @return \Illuminate\Support\HtmlString|string
     *
     * @throws \Exception
     */
    function XT_mix($path, $manifestDirectory = '')
    {
        return XT_app(Mix::class)(...func_get_args());
    }
}

if (! function_exists('XT_now')) {
    /**
     * Create a new Carbon instance for the current time.
     *
     * @param  \DateTimeZone|string|null  $tz
     * @return \Illuminate\Support\Carbon
     */
    function XT_now($tz = null)
    {
        return Date::now($tz);
    }
}

if (! function_exists('XT_old')) {
    /**
     * Retrieve an old input item.
     *
     * @param  string|null  $key
     * @param  mixed  $default
     * @return mixed
     */
    function XT_old($key = null, $default = null)
    {
        return XT_app('XT_request')->old($key, $default);
    }
}

if (! function_exists('XT_policy')) {
    /**
     * Get a policy instance for a given class.
     *
     * @param  object|string  $class
     * @return mixed
     *
     * @throws \InvalidArgumentException
     */
    function XT_policy($class)
    {
        return XT_app(Gate::class)->getPolicyFor($class);
    }
}

if (! function_exists('XT_public_path')) {
    /**
     * Get the path to the public folder.
     *
     * @param  string  $path
     * @return string
     */
    function XT_public_path($path = '')
    {
        return XT_app()->make('path.public').($path ? DIRECTORY_SEPARATOR.ltrim($path, DIRECTORY_SEPARATOR) : $path);
    }
}

if (! function_exists('XT_redirect')) {
    /**
     * Get an instance of the redirector.
     *
     * @param  string|null  $to
     * @param  int  $status
     * @param  array  $headers
     * @param  bool|null  $secure
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    function XT_redirect($to = null, $status = 302, $headers = [], $secure = null)
    {
        if (is_null($to)) {
            return XT_app('XT_redirect');
        }

        return XT_app('XT_redirect')->to($to, $status, $headers, $secure);
    }
}

if (! function_exists('XT_report')) {
    /**
     * Report an exception.
     *
     * @param  \Throwable|string  $exception
     * @return void
     */
    function XT_report($exception)
    {
        if (is_string($exception)) {
            $exception = new Exception($exception);
        }

        XT_app(ExceptionHandler::class)->report($exception);
    }
}

if (! function_exists('XT_request')) {
    /**
     * Get an instance of the current request or an input item from the request.
     *
     * @param  array|string|null  $key
     * @param  mixed  $default
     * @return \Illuminate\Http\Request|string|array|null
     */
    function XT_request($key = null, $default = null)
    {
        if (is_null($key)) {
            return XT_app('XT_request');
        }

        if (is_array($key)) {
            return XT_app('XT_request')->only($key);
        }

        $value = XT_app('XT_request')->__get($key);

        return is_null($value) ? XT_value($default) : $value;
    }
}

if (! function_exists('XT_rescue')) {
    /**
     * Catch a potential exception and return a default value.
     *
     * @param  callable  $callback
     * @param  mixed  $rescue
     * @param  bool  $report
     * @return mixed
     */
    function XT_rescue(callable $callback, $rescue = null, $report = true)
    {
        try {
            return $callback();
        } catch (Throwable $e) {
            if ($report) {
                XT_report($e);
            }

            return XT_value($rescue, $e);
        }
    }
}

if (! function_exists('XT_resolve')) {
    /**
     * Resolve a service from the container.
     *
     * @param  string  $name
     * @param  array  $parameters
     * @return mixed
     */
    function XT_resolve($name, array $parameters = [])
    {
        return XT_app($name, $parameters);
    }
}

if (! function_exists('XT_resource_path')) {
    /**
     * Get the path to the resources folder.
     *
     * @param  string  $path
     * @return string
     */
    function XT_resource_path($path = '')
    {
        return XT_app()->resourcePath($path);
    }
}

if (! function_exists('XT_response')) {
    /**
     * Return a new response from the application.
     *
     * @param  \Illuminate\Contracts\View\View|string|array|null  $content
     * @param  int  $status
     * @param  array  $headers
     * @return \Illuminate\Http\Response|\Illuminate\Contracts\Routing\ResponseFactory
     */
    function XT_response($content = '', $status = 200, array $headers = [])
    {
        $factory = XT_app(ResponseFactory::class);

        if (func_num_args() === 0) {
            return $factory;
        }

        return $factory->make($content, $status, $headers);
    }
}

if (! function_exists('XT_route')) {
    /**
     * Generate the URL to a named route.
     *
     * @param  array|string  $name
     * @param  mixed  $parameters
     * @param  bool  $absolute
     * @return string
     */
    function XT_route($name, $parameters = [], $absolute = true)
    {
        return XT_app('url')->route($name, $parameters, $absolute);
    }
}

if (! function_exists('XT_secure_asset')) {
    /**
     * Generate an asset path for the application.
     *
     * @param  string  $path
     * @return string
     */
    function XT_secure_asset($path)
    {
        return XT_asset($path, true);
    }
}

if (! function_exists('XT_secure_url')) {
    /**
     * Generate a HTTPS url for the application.
     *
     * @param  string  $path
     * @param  mixed  $parameters
     * @return string
     */
    function XT_secure_url($path, $parameters = [])
    {
        return XT_url($path, $parameters, true);
    }
}

if (! function_exists('session')) {
    /**
     * Get / set the specified session value.
     *
     * If an array is passed as the key, we will assume you want to set an array of values.
     *
     * @param  array|string|null  $key
     * @param  mixed  $default
     * @return mixed|\Illuminate\Session\Store|\Illuminate\Session\SessionManager
     */
    function session($key = null, $default = null)
    {
        if (is_null($key)) {
            return XT_app('session');
        }

        if (is_array($key)) {
            return XT_app('session')->put($key);
        }

        return XT_app('session')->get($key, $default);
    }
}

if (! function_exists('XT_storage_path')) {
    /**
     * Get the path to the storage folder.
     *
     * @param  string  $path
     * @return string
     */
    function XT_storage_path($path = '')
    {
        return XT_app('path.storage').($path ? DIRECTORY_SEPARATOR.$path : $path);
    }
}

if (! function_exists('XT_today')) {
    /**
     * Create a new Carbon instance for the current date.
     *
     * @param  \DateTimeZone|string|null  $tz
     * @return \Illuminate\Support\Carbon
     */
    function XT_today($tz = null)
    {
        return Date::today($tz);
    }
}

if (! function_exists('XT_trans')) {
    /**
     * Translate the given message.
     *
     * @param  string|null  $key
     * @param  array  $replace
     * @param  string|null  $locale
     * @return \Illuminate\Contracts\Translation\Translator|string|array|null
     */
    function XT_trans($key = null, $replace = [], $locale = null)
    {
        if (is_null($key)) {
            return XT_app('translator');
        }

        return XT_app('translator')->get($key, $replace, $locale);
    }
}

if (! function_exists('XT_trans_choice')) {
    /**
     * Translates the given message based on a count.
     *
     * @param  string  $key
     * @param  \Countable|int|array  $number
     * @param  array  $replace
     * @param  string|null  $locale
     * @return string
     */
    function XT_trans_choice($key, $number, array $replace = [], $locale = null)
    {
        return XT_app('translator')->choice($key, $number, $replace, $locale);
    }
}

if (! function_exists('__')) {
    /**
     * Translate the given message.
     *
     * @param  string|null  $key
     * @param  array  $replace
     * @param  string|null  $locale
     * @return string|array|null
     */
    function __($key = null, $replace = [], $locale = null)
    {
        if (is_null($key)) {
            return $key;
        }

        return XT_trans($key, $replace, $locale);
    }
}

if (! function_exists('XT_url')) {
    /**
     * Generate a url for the application.
     *
     * @param  string|null  $path
     * @param  mixed  $parameters
     * @param  bool|null  $secure
     * @return \Illuminate\Contracts\Routing\UrlGenerator|string
     */
    function XT_url($path = null, $parameters = [], $secure = null)
    {
        if (is_null($path)) {
            return XT_app(UrlGenerator::class);
        }

        return XT_app(UrlGenerator::class)->to($path, $parameters, $secure);
    }
}

if (! function_exists('XT_validator')) {
    /**
     * Create a new Validator instance.
     *
     * @param  array  $data
     * @param  array  $rules
     * @param  array  $messages
     * @param  array  $customAttributes
     * @return \Illuminate\Contracts\Validation\Validator|\Illuminate\Contracts\Validation\Factory
     */
    function XT_validator(array $data = [], array $rules = [], array $messages = [], array $customAttributes = [])
    {
        $factory = XT_app(ValidationFactory::class);

        if (func_num_args() === 0) {
            return $factory;
        }

        return $factory->make($data, $rules, $messages, $customAttributes);
    }
}

if (! function_exists('XT_view')) {
    /**
     * Get the evaluated view contents for the given view.
     *
     * @param  string|null  $view
     * @param  \Illuminate\Contracts\Support\Arrayable|array  $data
     * @param  array  $mergeData
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    function XT_view($view = null, $data = [], $mergeData = [])
    {
        $factory = XT_app(ViewFactory::class);

        if (func_num_args() === 0) {
            return $factory;
        }

        return $factory->make($view, $data, $mergeData);
    }
}
