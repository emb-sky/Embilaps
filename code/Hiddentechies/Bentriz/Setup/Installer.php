<?php

/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Hiddentechies\Bentriz\Setup;

use Magento\Framework\Setup;

class Installer implements Setup\SampleData\InstallerInterface
{

    /**
     * @var \Magento\CmsSampleData\Model\Page
     */
    private $page;

    /**
     * @var \Magento\CmsSampleData\Model\Block
     */
    private $block;

    /**
     * @param \Hiddentechies\Bentriz\Model\Page $page
     * @param \Hiddentechies\Bentriz\Model\Block $block
     */
    public function __construct(
        \Hiddentechies\Bentriz\Model\Page $page,
        \Hiddentechies\Bentriz\Model\Block $block
    ) {
        $this->page = $page;
        $this->block = $block;
    }

    /**
     * {@inheritdoc}
     */
    public function install()
    {

        //$this->page->install(['Hiddentechies_Bentriz::fixtures/pages/pages.csv']);
        $this->page->install(
            [

                    'Hiddentechies_Bentriz::DemoPages/pages.csv',
                ]
        );
        $this->block->install(
            [

                    'Hiddentechies_Bentriz::DemoBlocks/blocks.csv',
                ]
        );
    }
}
