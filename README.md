# Reportei Asaas SDK

Instalação
----------

<!-- Adicione os seguintes códigos no seu `composer.json`:

```json
{
    "repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/reportei/asaas"
        }
    ],
    "require": {
        "reportei/asaas": "dev-main"
    }
}
``` -->

Rode os seguintes comandos:

```bash
composer require reportei-asaas/php-asaas
```

```bash
composer dump-autoload
```


Timeout e opções HTTP
---------------------

Por padrão as requisições não têm timeout (padrão do Guzzle). Para limitar, passe opções do Guzzle no construtor ou use `withTimeout()` no fluxo que precisa:

```php
$asaas = new Asaas($token, $sandbox, ['timeout' => 30, 'connect_timeout' => 10]);

$asaas->withTimeout(15, 5)->payment()->create($data);
```

`withTimeout()` e `withHttpOptions()` devolvem uma cópia; a instância original não muda. O timeout vale por requisição HTTP, então métodos paginados (`getAll`, `getAllPayments`) podem levar várias vezes esse valor.
