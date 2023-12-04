<?php

namespace Hbgl\Barcode\Adapters;

trait AdapterTrait
{
    /** @var self|null */
    private static $instance;

    /**
     * Define empty parameter constructor to skip default initialization.
     * We'll handle initialization by ourselves because we only need
     * some properties to be set.
     */
    public function __construct()
    {
    }

    /**
     * @return self
     */
    protected static function getInstance()
    {
        if (self::$instance === null) {
            // Call constructor defined in this trait. See comment above.
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Encode text as Code 128 values.
     *
     * @param string $text
     * @return int[] Array of Code 128 values.
     */
    public static function getEncodedValues($text)
    {
        // Work around the OOP interface with a singleton.
        $instance = self::getInstance();
        $instance->code = $text;
        $values = $instance->getCodeData();
        $instance->code = '';
        return $values;
    }
}
