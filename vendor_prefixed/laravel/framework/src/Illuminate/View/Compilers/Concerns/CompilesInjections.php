<?php
/* This file has been prefixed by <PHP-Prefixer> for "XT Laravel Starter for Joomla" */

namespace Extly\Illuminate\View\Compilers\Concerns;

trait CompilesInjections
{
    /**
     * Compile the inject statements into valid PHP.
     *
     * @param  string  $expression
     * @return string
     */
    protected function compileInject($expression)
    {
        $segments = explode(',', preg_replace("/[\(\)]/", '', $expression));

        $variable = trim($segments[0], " '\"");

        $service = trim($segments[1]);

        return "<?php \${$variable} = app({$service}); ?>";
    }
}
