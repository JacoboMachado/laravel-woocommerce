<?php

namespace Codexshaper\WooCommerce;

use Automattic\WooCommerce\Client;
use Codexshaper\WooCommerce\Models\Sites;
use Codexshaper\WooCommerce\Traits\WooCommerceTrait;

class WooCommerceApi
{
    use WooCommerceTrait;

    /**
     *@var \Automattic\WooCommerce\Client
     */
    protected $client;

    /**
     *@var array
     */
    protected $headers = [];

    /**
     * @var Models\Sites
     */
    protected $site;

    /**
     * Build Woocommerce connection.
     *
     * @return void
     */
    public function __construct(Site $site)
    {
        try {
            $this->headers = [
                'header_total'       => config('woocommerce.header_total') ?? 'X-WP-Total',
                'header_total_pages' => config('woocommerce.header_total_pages') ?? 'X-WP-TotalPages',
            ];


            $this->client = new Client(
                $site->url ?? config('woocommerce.store_url'),
                $site->key ?? config('woocommerce.consumer_key'),
                $site->secret ?? config('woocommerce.consumer_secret'),
                [
                    'version'           => 'wc/'.config('woocommerce.api_version'),
                    'wp_api'            => config('woocommerce.wp_api_integration'),
                    'verify_ssl'        => config('woocommerce.verify_ssl'),
                    'query_string_auth' => config('woocommerce.query_string_auth'),
                    'timeout'           => config('woocommerce.timeout'),
                ]
            );
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage(), 1);
        }
    }
}
