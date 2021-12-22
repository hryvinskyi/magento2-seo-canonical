<?php
/**
 * Copyright (c) 2021. All rights reserved.
 * @author: Volodymyr Hryvinskyi <mailto:volodymyr@hryvinskyi.com>
 */

declare(strict_types=1);

namespace Hryvinskyi\SeoCanonical\Model;

use Hryvinskyi\SeoCanonicalApi\Api\DeleteDoubleSlashInterface;

class DeleteDoubleSlash implements DeleteDoubleSlashInterface
{
    /**
     * @inheritDoc
     */
    public function execute(string $url): string
    {
        return str_replace(['://', '//', '[http]'], ['[http]', '/', '://'], $url);
    }
}
