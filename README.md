# Google API Client Symfony BUndle

This project provides a simple symfony bundle to provide a configurable [Google
API Client](https://github.com/googleapis/google-api-php-client) as symfony
service.

## Usage

### Installation

Include this project in your Composer installation.

```sh
composer require double-star-systems/google-api-bundle
```

### Configuration

The module will work without singificant configuration. At minimum, you must
atleast create the google api `credentials.json`. This can either be placed in
the default location of `config/google_api_bundle/credentials.json` or in a
custom location, which will need to be configured in the application.

The following custom configuration can be added to your application.

```yaml
# config/packages/google_api.yaml

google_api:
    scopes:
        - https://www.googleapis.com/auth/drive
    credential_file: `path/to/your/credentials.json`
    application_name: 'Your Awesome App Name!'
```

### Using the Service

To use the serivce in your app, you can simply use the standard google api class
within your project, and have a fully configured base api client isntance.

```php

use Google\Client;

class ExampleController extends AbstractController
{
    #[Route('/example, 'example')]
    public function example(Client $client)
    {
        // use the $client instance as normal.
    }
}
```

## Requirements

This project is cofigured to be compatible with Symfony 4+ and the Google PHP
API Client library 2.0.

## Support

This project is developed by [Double Star Systems](//doublestarsystems.com/).
For questions about project support or to report bugs, please [open an issue on
GitHub](https://github.com/Double-Star-Systems/google-api-bundle/issues)
