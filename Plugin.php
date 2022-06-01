<?php

namespace WebApps\Plugin;

use App\Models\Plugin;

class UsefulLinks_Plugin extends Plugin
{
    public $name;
    public $icon;
    public $version;
    public $author;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $plugin = json_decode(file_get_contents(__DIR__ . '/plugin.json'), true);
        $this->name = $plugin['name'];
        $this->icon = $plugin['icon'];
        $this->version = $plugin['version'];
        $this->author = $plugin['author'];
    }

    public $options = [
        'items' => [
            'type' => 'repeater',
            'label' => 'Link',
            'ref' => 'linkName',
            'options' => [
                'linkName' => [
                    'type' => 'text',
                    'label' => 'Enter the name of the link',
                    'maxLength' => 255,
                    'required' => true,
                ],
                'linkDesc' => [
                    'type' => 'text',
                    'label' => 'Enter the description of the link',
                    'maxLength' => 255,
                    'required' => false,
                ],
                'linkURL' => [
                    'type' => 'text',
                    'label' => 'Enter the full URL of the link',
                    'maxLength' => 255,
                    'required' => true,
                ],
                'linkIcon' => [
                    'type' => 'select',
                    'label' => 'Choose the icon to display',
                    'options' => [
                        '' => 'Default',
                        'docx' => 'Word',
                        'xlsx' => 'Excel',
                        'pptx' => 'Powerpoint',
                        'pdf' => 'PDF',
                        'audio' => 'Audio',
                        'gdocs' => 'Google Docs',
                        'gsheets' => 'Google Sheets',
                        'gslides' => 'Google Slides',
                    ]
                ]
            ]
        ]
    ];

    public $new = [
        'items' => [['linkName' => '', 'linkDesc' => '', 'linkURL' => '', 'linkIcon' => '']]
    ];

    public $preview = [
        'items' => [
            'each' => '<a id="item{index}" href="{value.linkURL}" target="_blank" 
                            class="relative block hover:bg-gray-50 dark:hover:bg-gray-700 {value.linkIcon}">
                        <h5 class="font-semibold text-lg" data-val="value.linkName"></h5>
                        <p class="mb-1" data-val="value.linkDesc"></p>
                       </a>'
        ]
    ];

    public function output($edit = false)
    {
        $this->edit = $edit;
        ob_start();
        require(__DIR__.'/include/_html.php');
        $html = str_replace(["\r", "\n", "\t"], '', trim(ob_get_clean()));
        $html = preg_replace('/(\s){2,}/s', '', $html);
        return $html;
    }

    public function style()
    {
        return file_get_contents(__DIR__.'/include/_style.css');
    }

    public function scripts($edit = false)
    {
        return '';
    }
}
