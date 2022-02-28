<?php

namespace DoubleStarSystems\Bundle\GoogleApiBundle;

use Google\Client;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class ClientFactory
{
  protected array $configuration;

  public function __construct(array $configuration) {
      var_export($configuration);
    $this->configuration = $configuration;
  }

  /**
   * Create a new Google API Client Instance.
   *
   * The new client instance will be initialized with settings from the apps
   * configuration.
   *
   * @return Client
   *   The new client instance.
   */
  public function createClient(): Client {
    $client = new Client();
    $client->setApplicationName($this->configuration['application_name']);
    $client->setScopes($this->configuration['scopes']);
    $client->setAccessType('offline');
    $client->setAuthConfig($this->configuration['credentials_file']);
    $client->setPrompt('select_account consent');

    $tokenPath = $this->configuration['token_file'];
    if (file_exists($tokenPath)) {
        $accessToken = json_decode(file_get_contents($tokenPath), true);
        $client->setAccessToken($accessToken);
    }
    
    // If there is no previous token or it's expired.
    if ($client->isAccessTokenExpired()) {
        // Refresh the token if possible, else fetch a new one.
        if ($client->getRefreshToken()) {
            $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
        }
    }

    return $client;
  }
}
