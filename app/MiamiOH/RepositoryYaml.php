<?php
/**
 * Created by PhpStorm.
 * User: tepeds
 * Date: 2018-12-31
 * Time: 12:04
 */

namespace App\MiamiOH;

class RepositoryYaml implements Repository
{
    /**
     * @var string
     */
    private $dataDirectory;

    private $facts = [];

    public function __construct(string $dataDirectory)
    {
        $this->dataDirectory = $dataDirectory;

        $this->facts = $this->loadFromFile();
    }

    public function lookupNumberMathFact(int $number): NumberFactDataTransferObject
    {
        $data = [
            'text' => '',
            'number' => $number,
            'found' => false,
            'type' => 'math',
        ];

        if (!empty($this->facts['math'][$number])) {
            $data['found'] = true;
            $data['text'] = $this->facts['math'][$number];
        }

        return NumberFactDataTransferObject::fromArray($data);
    }

    public function lookupDateFact(int $day, int $month): NumberFactDataTransferObject
    {
        $dateKey = date('z', mktime(0, 0, 0, $month, $day, date('Y'))) + 1;

        $data = [
            'text' => '',
            'number' => $dateKey,
            'found' => false,
            'type' => 'date',
        ];

        if (!empty($this->facts['date'][$dateKey])) {
            $data['found'] = true;
            $data['text'] = $this->facts['date'][$dateKey];
        }

        return NumberFactDataTransferObject::fromArray($data);
    }

    private function loadFromFile(): array
    {
        $file = implode(DIRECTORY_SEPARATOR, [$this->dataDirectory, 'facts.yml']);

        if (!file_exists($file)) {
            throw new \InvalidArgumentException('Data file not found: ' . $file);
        }

        return yaml_parse_file($file);
    }
}
