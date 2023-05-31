<?php
// Generate test for API key value object...

use Maplerad\Laravel\ValueObjects\Transporter\BaseUri;

it('returns a valid base url', function () {
    $apiKey = BaseUri::from('foo');

    expect($apiKey->toString())->toBe('https://foo/');
});

it('does not equal', function () {
    $apiKey = BaseUri::from('https://foo/');

    expect($apiKey->toString())->not->toBe('foo');
});