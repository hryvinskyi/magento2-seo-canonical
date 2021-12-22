<?php
/**
 * Copyright (c) 2021. All rights reserved.
 * @author: Volodymyr Hryvinskyi <mailto:volodymyr@hryvinskyi.com>
 */

declare(strict_types=1);

namespace Hryvinskyi\SeoCanonical\Model;

use Hryvinskyi\Logger\Model\DebugConfigInterface;
use Hryvinskyi\SeoCanonicalApi\Api\ConfigInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;
use Magento\Store\Model\Store;

class Config implements ConfigInterface, DebugConfigInterface
{
    /**
     * Configuration paths
     */
    public const XML_CONF_ENABLED = 'hryvinskyi_seo/canonical/enabled';
    public const XML_CONF_DEBUG = 'hryvinskyi_seo/canonical/debug';
    public const XML_CONF_CANONICAL_IGNORE_URL = 'hryvinskyi_seo/canonical/canonical_ignore_url';
    public const XML_CONF_CANONICAL_STORE_WITHOUT_STORE_CODE = 'hryvinskyi_seo/canonical/canonical_store_without_store_code';
    public const XML_CONF_CROSSDOMAIN = 'hryvinskyi_seo/canonical/crossdomain';
    public const XML_CONF_CROSSDOMAIN_PREFER_HTTPS = 'hryvinskyi_seo/canonical/crossdomain_prefer_https';
    public const XML_CONF_PAGINATED_CANONICAL = 'hryvinskyi_seo/canonical/paginated_canonical';

    /**
     * @var ScopeConfigInterface
     */
    private $scopeConfig;

    /**
     * Config constructor.
     *
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(ScopeConfigInterface $scopeConfig)
    {
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * @inheritDoc
     */
    public function isEnabled($scopeCode = null, string $scopeType = ScopeInterface::SCOPE_STORE): bool
    {
        return $this->scopeConfig->isSetFlag(self::XML_CONF_ENABLED, $scopeType, $scopeCode);
    }

    /**
     * @inheritDoc
     */
    public function getIgnoreUrls($scopeCode = null, string $scopeType = ScopeInterface::SCOPE_STORE): string
    {
        return (string)$this->scopeConfig->getValue(self::XML_CONF_CANONICAL_IGNORE_URL, $scopeType, $scopeCode);
    }

    /**
     * @inheritDoc
     */
    public function isCanonicalStoreWithoutStoreCode(
        $scopeCode = null,
        string $scopeType = ScopeInterface::SCOPE_STORE
    ): bool {
        return $this->scopeConfig->isSetFlag(self::XML_CONF_CANONICAL_STORE_WITHOUT_STORE_CODE, $scopeType, $scopeCode);
    }

    /**
     * @inheritDoc
     */
    public function getCrossdomain($scopeCode = null, string $scopeType = ScopeInterface::SCOPE_STORE): int
    {
        return (int)$this->scopeConfig->getValue(
            self::XML_CONF_CROSSDOMAIN,
            $scopeType,
            $scopeCode
        );
    }

    /**
     * @inheritDoc
     */
    public function isCrossdomainPreferHttps($scopeCode = null, string $scopeType = ScopeInterface::SCOPE_STORE): bool
    {
        return $this->scopeConfig->isSetFlag(self::XML_CONF_CROSSDOMAIN_PREFER_HTTPS, $scopeType, $scopeCode);
    }

    /**
     * @inheritDoc
     */
    public function isPaginatedCanonical($scopeCode = null, string $scopeType = ScopeInterface::SCOPE_STORE): bool
    {
        return $this->scopeConfig->isSetFlag(self::XML_CONF_PAGINATED_CANONICAL, $scopeType, $scopeCode);
    }

    /**
     * @inheritDoc
     */
    public function isAddStoreCodeToUrlsEnabled(): bool
    {
        return $this->scopeConfig->isSetFlag(Store::XML_PATH_STORE_IN_URL);
    }

    /**
     * @inheritDoc
     */
    public function isDebug(): bool
    {
        return $this->scopeConfig->isSetFlag(self::XML_CONF_DEBUG);
    }
}
