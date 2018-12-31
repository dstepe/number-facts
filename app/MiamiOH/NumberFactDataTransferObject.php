<?php
/**
 * Created by PhpStorm.
 * User: tepeds
 * Date: 2018-12-31
 * Time: 11:52
 */

namespace App\MiamiOH;

class NumberFactDataTransferObject
{
    /**
     * @var string
     */
    private $text;
    /**
     * @var float
     */
    private $number;
    /**
     * @var bool
     */
    private $found;
    /**
     * @var string
     */
    private $type;

    public function __construct(string $text, float $number, bool $found, string $type)
    {
        $this->text = $text;
        $this->number = $number;
        $this->found = $found;
        $this->type = $type;
    }

    public static function fromArray(array $data): self
    {
        $text = $data['text'] ?? '';
        $number = $data['number'] ?? null;
        $found = $data['found'] ?? false;
        $type = $data['type'] ?? '';

        return new self($text, $number, $found, $type);
    }

    public function text(): string
    {
        return $this->text;
    }

    public function number(): float
    {
        return $this->number;
    }

    public function found(): bool
    {
        return $this->found;
    }

    public function type(): string
    {
        return $this->type;
    }
}
